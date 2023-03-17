<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $user->password = $request->password;

        if ($request->hasFile('image')) {
            $destination_path = 'public/images/users';
            $photo = $request->file('image');
            $photo_name = date("YmdHis").$photo->getClientOriginalName();
            $photo->storeAs($destination_path, $photo_name);
        }

        $user->image = $photo_name;
        $user->save();

        return redirect()->route('users')->with('success', 'User added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
            'email' => 'required|unique:users',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        if ($request->hasFile('image')) {
            $destination_path = 'public/images/users';
            $photo = $request->file('image');
            $photo_name = date("YmdHis").$photo->getClientOriginalName();
            $photo->storeAs($destination_path, $photo_name);
        }

        $user->image = $photo_name;
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
}
