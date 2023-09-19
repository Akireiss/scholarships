<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit($id)
    {
         // Retrieve the user by the provided ID and display settings
         $user = User::findOrFail($id);
        // Add your edit logic here
        return view('admin.settings.edit', compact('user'));
    }

    public function view($id)
    {

          // Retrieve the user by the provided ID and display settings
            $user = User::findOrFail($id);

        // Add your view logic here
        return view('admin.settings.view', compact('user'));
    }

    public function update($id, Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'string',
            'username' => 'string|unique:users,username,' . $id,
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'confirmed',
        ]);

        // Update the user
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

           // Record audit trail for user registration
    AuditLog::create([
        'user_id' => $user->id,
        'action' => 'Update an account',
        'data' => json_encode($user),
    ]);
        // Return a success response
        return redirect()->route('admin.settings.accountSettings', $user->id)->with('message', 'User information updated successfully!');
    }


}
