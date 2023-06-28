<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Parents;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create() {
        return view('users.register');
    }

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'Username' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8']
        ]);
    
        $fullName = $formFields['Username'];
        unset($formFields['Username']);
    
        $user = User::create([
            'name' => $fullName,
            'email' => $formFields['email'],
            'password' => bcrypt($formFields['password']),
            'type' => 'Parent'
        ]);

        $parent = Parents::create([
            'User_ID' => $user->id,
            'FullName' => $request->input('Username'),
            'ICno' => $request->input('ICno'),
            'Address1' => $request->input('Address1'),
            'Address2' => $request->input('Address2'),
            'Poscode' => $request->input('Poscode'),
            'City' => $request->input('City'),
            'State' => $request->input('State'),
            'PhoneNo' => $request->input('PhoneNo'),
            'Nationality' => $request->input('Nationality'),
            'Job' => $request->input('Job'),
            'Income' => $request->input('Income'),
            'OfficeAddress1' => $request->input('OfficeAddress1'),
            'OfficeAddress2' => $request->input('OfficeAddress2'),
            'OfficePoscode' => $request->input('OfficePoscode'),
            'OfficeCity' => $request->input('OfficeCity'),
            'OfficeState' => $request->input('OfficeState')
        ]);

        auth()->login($user);
    
        return redirect('/parents/'.$parent->id.'/edit-user-profile')->with('success', 'User created and logged in');
    }

    // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->forget('email');

        return redirect('/login')->with('message', 'You have been logged out!');

    }

    // Show Login Form
    public function login(Request $request) {
        // Check if the user session already exists
        if ($request->session()->has('email')) {
            $userType = auth()->user()->type;

            if ($userType === 'Teacher') {
                return redirect('/students/learning-progress-list')->with('success', 'You are already logged in!');
            } elseif ($userType === 'Headmaster') {
                return redirect('/staffs/list')->with('success', 'You are already logged in!');
            } elseif ($userType === 'Parent') {
                // Get the authenticated user's parent
                $parent = auth()->user()->parent;

                // Check if ICno is empty
                if ($parent->ICno === 'empty') {
                    return redirect()->route('parents.edit-profile', ['parent' => $parent])->with('warning', 'Please complete your profile!');
                }
                else {
                    $student = auth()->user()->parent->student;
                    return redirect()->route('students.approval', ['student' => $student])->with('success', 'You are already logged in!');
                }
            } elseif ($userType === 'Staff') {
                return redirect('/students/approval')->with('success', 'You are already logged in!');
            }
        }

        return view('users.login');
    }

    

    public function authenticate(Request $request) {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($data)) {
            // Authentication successful
            $user = auth()->user();
            $request->session()->put('email', $user);
        
            // Redirect users based on user type
            $userType = $user->type;
        
            if ($userType === 'Teacher') {
                return redirect('/students/learning-progress-list')->with('success', 'You are now logged in!');
            } elseif ($userType === 'Headmaster') {
                return redirect('/staffs/list')->with('success', 'You are now logged in!');
            } elseif ($userType === 'Parent') {
                // Get the authenticated user's parent
                $parent = auth()->user()->parent;

                // Check if ICno is empty
                if ($parent->ICno === 'empty') {
                    return redirect()->route('parents.edit-profile', ['parent' => $parent])->with('warning', 'Please complete your profile!');
                }
                else {
                    $student = auth()->user()->parent->student;
                    return redirect()->route('students.approval', ['student' => $student])->with('success', 'You are already logged in!');
                }
            } elseif ($userType === 'Staff') {
                return redirect('/students/approval')->with('success', 'You are now logged in!');
            }
        }

        return back()->withErrors(['error' => 'Invalid credentials'])->withInput();
    }

    public function updatePassword(Request $request, $id) {
        // Find the user record
        $user = User::findOrFail($id);

        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('new_password');
        $confirmPassword = $request->input('confirm_password');

        // Validate if current password matches the password in the database
        if (!Hash::check($currentPassword, $user->password)) {
            return redirect()->back()->with(['error' => 'Invalid current password'])->onlyInput('current_password');
        }

        // Validate if new password and confirm password match
        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->with(['error' => 'New password and confirm password must match'])->onlyInput('new_password', 'confirm_password');
        }

        // Update the user's password
        $user->password = Hash::make($newPassword);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully');
    }

}
