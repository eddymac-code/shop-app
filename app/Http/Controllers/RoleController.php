<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;

class RoleController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::all();

        return view('user.role.data', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->slug = str()->snake($role->name);
        $role->save();

        return redirect()->route('roles')->with('success', 'Successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('user.role.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view ('user.role.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
            'slug' => str()->snake($request->name)
        ]);

        return redirect()->route('roles')->with('success', 'Role successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles')->with('success', 'Role successfully deleted');
    }

    /**
     * Assign permissions to specified resource
     */
    public function assign_permissions(Role $role)
    {
        $data = [];
        $permissions = Permission::where('parent_id', 0)->get();
        foreach ($permissions as $permission) {
            array_push($data, $permission);
            $sub_permissions = Permission::where('parent_id', $permission->id)->get();
            foreach ($sub_permissions as $value) {
                array_push($data, $value);
            }
        }
        
        return view('user.role.assign_permissions', [
            'role' => $role,
            'data' => $data,
        ]);
    }

    public function assign_permissions_store(Role $role, Request $request)
    {
        /* // This contains permissions to be detached(if they are already attached).
        $permissions = [];

        // Get role's permissions and check whether they exist in the request.
        // If not, push them to $permissions array
        foreach ($role->permissions as $permission) {
            if (!in_array($permission->id, $request->permission_id)) {
                array_push($permissions, $permission->id);
            }
        }

        // Now, do the actual detaching
        $this->dropPermission($role, $permissions); */

        // Attach the permissions from the request.
        $this->assignPermission($role, $request->permission_id);

        return redirect()->route('show-role', $role)->with('success', "Permissions updated successfully");
    }

    protected function assignPermission($role, $permission)
    {
        return $role->permissions()->sync($permission);
    }

    protected function dropPermission($role, $permission)
    {
        return $role->permissions()->detach($permission);
    }
}
