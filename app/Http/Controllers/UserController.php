<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(5);



        return view('user.showUser', compact('users'));
    }
    public function create()
    {
        return view('user.createUser');
    }

    public function edit(string $id)
    {

        $user = User::findOrFail($id);


        return view('user.editUser', compact('user'));
    }

    public function destroy($id)
    {

        $event = User::findOrFail($id);


        $event->delete();

        return redirect()->route('events.show')->with('success', 'Event deleted successfully.');
    }



    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|string|min:8',
            'profile_photo_path' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);


        $user = User::create([
            'name' => $request->name,
            'student_id' => $request->student_id,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);


        if ($request->hasFile('profile_photo_path')) {
            $user->updateProfilePhoto($request->file('profile_photo_path'));
        }


        $users = User::paginate(5);


        return view('user.showUser', compact('users'))->with('success', 'User created successfully.');
    }



    public function update(Request $request, string $id)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string',
            'password' => 'nullable|string|min:8',
            'profile_photo_path' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);


        $user = User::findOrFail($id);


        if ($request->hasFile('profile_photo_path')) {
            $user->updateProfilePhoto($request->file('profile_photo_path'));
        }


        $user->update([
            'name' => $data['name'],
            'student_id' => $data['student_id'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => $data['password'] ? bcrypt($data['password']) : $user->password, // Encrypt new password if provided
        ]);


        return redirect()->route('users')->with('success', 'User updated successfully!');
    }

}
