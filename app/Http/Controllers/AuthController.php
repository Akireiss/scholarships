<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Add accounts here

        public function register()
        {
            return view('admin/settings/register');
        }


        public function registerSave(Request $request)
        {
          Validator::make($request->all(),
            [
                'name' => 'required|string|max:255',
                'username' => 'required|string|unique:users|max:255',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|in:0,1,2'
            ])->validate();

            User::create
            ([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request['password']),
                'role' => $request->role,
            ]);

            // redirect to dashboard
                return back()->with('message', 'Successfully created an account');
            // ends
        }


        // log in here

        public function login()
        {
            return view('auth.login');
        }



        public function loginAction(Request $request)
        {

            $validatedData = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user->role == 1 ) {
                    return redirect()->route('admin.dashboard')->with('message', 'Welcome');
                } else if ($user->role == 0) {
                    // Redirect to a different dashboard or homepage for users with roles other than 1
                    return redirect()->route('staff.dashboardStaff')->with('message', 'Successfully logged in');
                } else {
                    return redirect()->route('campus-NLUC.dashboardCamp')->with('message', 'Successfully logged in');
                }
            }

            return redirect()->back()->withErrors(['login' => 'Invalid credentials'])->withInput();
        }

// log out here

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login')->with('message', 'You have been logged out successfully.');
}

        public function dashboard()
        {
            $user = Auth::user(); // Retrieve the authenticated user

            return view('admin.dashboard', compact('user'));
        }
        public function dashboardStaff()
        {
            $user = Auth::user(); // Retrieve the authenticated user

            return view('staff.dashboardStaff', compact('user'));
        }
        public function dashboardCamp()
        {
            $user = Auth::user(); // Retrieve the authenticated user

            return view('campus-NLUC.dashboardCamp', compact('user'));
        }
// ends here


// staff here
// ends here

// campus here
// ends here
}
