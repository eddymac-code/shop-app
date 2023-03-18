<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $permissions = Permission::where('parent_id', 0)->get();
        foreach ($permissions as $permission) {
            array_push($data, $permission);
            $subpermissions = Permission::where('parent_id', $permission->id)->get();
            foreach ($subpermissions as $sub) {
                array_push($data, $sub);
            }
        }
        
        return view('user.permission.data', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parent_permissions = Permission::where('parent_id', 0)->get();
        
        return view('user.permission.create', ['parent_permissions' => $parent_permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->parent_id = $request->type == 0 ? "0" : $request->parent_id;
        $permission->description = $request->description;
        $permission->slug = str()->snake($request->name);
        // str_slug($request->name, '_');
        $permission->save();

        $admin = Role::where('slug','super_admin')->first();
        if ($admin) {
            $this->assignPermission($admin, [$permission->id]);
        }

        return redirect()->route('permissions')->with('success', 'Added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $parent_permission = Permission::where('parent_id', 0)->get();
        
        if ($permission->parent_id == 0) {
            $selected = 0;
        } else {
            $selected = 1;
        }
        return view ('user.permission.edit', [
            'permission' => $permission,
            'parent_permission' => $parent_permission,
            'selected' => $selected
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $permission->update([
            'name' => $request->name,
            'parent_id' => $request->type == 0 ? "0" : $request->parent_id,
            'description' => $request->description,
            'slug' => str()->snake($request->name)
        ]);

        return redirect()->route('permissions')->with('success', 'Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions')->with('success', 'Successfully deleted.');
    }

    protected function assignPermission($role, $permission)
    {
        return $role->permissions()->syncWithoutDetaching($permission);
    }
}
