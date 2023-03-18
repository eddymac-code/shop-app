<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();

        return view('user.data', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($request->hasFile('image')) {
            $destination_path = 'public/images/users';
            $photo = $request->file('image');
            $photo_name = date("YmdHis").$photo->getClientOriginalName();
            $photo->storeAs($destination_path, $photo_name);
            $user->image = $photo_name;
        }

        $user->save();

        return redirect()->route('users')->with('success', 'User added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($request->hasFile('image')) {
            $destination_path = 'public/images/users';
            $photo = $request->file('image');
            $photo_name = date("YmdHis").$photo->getClientOriginalName();
            $photo->storeAs($destination_path, $photo_name);
            $user->image = $photo_name;
        }

        $user->save();

        return redirect()->route('users')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id === '1') {
            return back()->with('error', 'This user cannot be removed!');
        }

        $user = User::find($id);
        $user->delete();

        return redirect()->route('users')->with('success', 'User deleted.');
    }

    public function assign_roles(User $user)
    {
        $data = Role::all();
        
        return view('user.assign_roles', [
            'data' => $data,
            'user' => $user,
        ]);
    }

    public function assign_roles_store(User $user, Request $request)
    {
        $this->assignRole($user, $request->role_id);

        return redirect()->route('show-user', $user)->with('success', "Roles updated successfully");
    }

    protected function assignRole($user, $role)
    {
        return $user->roles()->sync($role);
    }
}
