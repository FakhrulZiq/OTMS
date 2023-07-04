<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    //show all teacher
    public function index() {
        if (Auth::user()->type !== 'Headmaster') {
            abort(403, 'Unauthorized');
        }

        $teachers = Teachers::latest()->paginate(10);

        // Get total count of user type 'staff'
        $totalStaffs = User::where('type', 'staff')->count();

        // Get total count of user type 'teacher'
        $totalTeachers = User::where('type', 'teacher')->count();

        // Get total count of students
        $totalStudents = Students::count();

        return view('teachers.indexTeacher', compact('teachers', 'totalStaffs', 'totalTeachers', 'totalStudents'));
    }

    //show teacher detail profile 
    public function show(Teachers $teacher){
        if (Auth::user()->type !== 'Headmaster') {
            abort(403, 'Unauthorized');
        }
        
        return view ('teachers.showTeacher', [
            'teacher' => $teacher
        ]);
    }

    // Create - Teacher registration form
    public function create() {
        return view('teachers.registerTeacher');
    }

    public function store(Request $request) {
        // Validate the form data for teacher
        $validatedTeacherData = $request->validate([
            'FullName' => 'required',
            'ICno' => 'required',
            'Address1' => 'required',
            'Address2' => 'required',
            'Poscode' => 'required',
            'City' => 'required',
            'State' => 'required',
            'PhoneNo' => 'required',
            'Nationality' => 'required',
        ]);

        // Validate the form data for user login credentials
        $validatedLoginData = $request->validate([
            'Username' => ['required', 'min:3'],
            'Email' => ['required', 'email', Rule::unique('users', 'email')],
            'Password' => ['required', 'min:8']
        ]);

        // Create a new User instance and assign the form data
        $user = new User;
        $user->name = $validatedLoginData['Username'];
        $user->email = $validatedLoginData['Email'];
        $user->password = bcrypt($validatedLoginData['Password']);
        $user->type = 'Teacher';

        // Save the user data to the database
        $user->save();

        // Create a new Teacher instance and assign the form data
        $teacher = new Teachers;
        $teacher->FullName = $user->name;
        $teacher->ICno = $validatedTeacherData['ICno'];
        $teacher->Address1 = $validatedTeacherData['Address1'];
        $teacher->Address2 = $validatedTeacherData['Address2'];
        $teacher->Poscode = $validatedTeacherData['Poscode'];
        $teacher->City = $validatedTeacherData['City'];
        $teacher->State = $validatedTeacherData['State'];
        $teacher->PhoneNo = $validatedTeacherData['PhoneNo'];
        $teacher->Nationality = $validatedTeacherData['Nationality'];
        $teacher->Position = 'Teacher';
        $teacher->DateJoin = now()->format('Y-m-d');

        // Assign the User_ID with the user's ID
        $teacher->User_ID = $user->id;

        // Save the teacher data to the database
        $teacher->save();

        // Redirect to a success page or perform any other desired actions
        return redirect()->route('teachers.indexTeacher')->with('success', 'Teacher registered successfully.');
    }


    //show edit registration form
    public function edit(Teachers $teacher) {
        if (Auth::user()->type !== 'Headmaster') {
            abort(403, 'Unauthorized');
        }
        
        return view('teachers.editTeacher', ['teacher' => $teacher]);
    }

    public function update(Request $request, $id) {
        // Find the teacher record
        $teacher = Teachers::find($id);

        // Update the teacher's details
        $teacher->FullName = $request->input('FullName');
        $teacher->ICno = $request->input('ICno');
        $teacher->Address1 = $request->input('Address1');
        $teacher->Address2 = $request->input('Address2');
        $teacher->Poscode = $request->input('Poscode');
        $teacher->City = $request->input('City');
        $teacher->State = $request->input('State');
        $teacher->PhoneNo = $request->input('PhoneNo');
        $teacher->Nationality = $request->input('Nationality');

        if ($request->hasFile('ProfileImage')) {
            // Remove old profile image if exists
            if ($teacher->ProfileImage && $teacher->ProfileImage !== 'no-image.jpg') {
                $oldImagePath = public_path('profileImages/') . $teacher->ProfileImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload new profile image
            $file = $request->file('ProfileImage');
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profileImages/'), $filename);

            // Update the teacher record with the new profile image
            $teacher->ProfileImage = $filename;
        }

        // Save the updated teacher record
        $teacher->save();

        return redirect()->back() ->with('success','Teachers details updated successfully!');
    }

    public function editProfile(Teachers $teacher) {
        return view('Teachers.editTeacherProfile', ['teacher' => $teacher]);
    }
    
    public function uploadPhoto(Request $request, $id) {
        // Find the teacher record
        $teacher = Teachers::find($id);

        if ($request->hasFile('ProfileImage')) {
            // Remove old profile image if exists
            if ($teacher->ProfileImage && $teacher->ProfileImage != 'no-image.jpg') {
                $oldImagePath = public_path('profileImages/') . $teacher->ProfileImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload new profile image
            $file = $request->file('ProfileImage');
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profileImages/'), $filename);

            // Update the teacher record with the new profile image
            $teacher->ProfileImage = $filename;
            $teacher->save();
        }

        return redirect()->back()->with('success', 'Profile image updated!');
    }

    //delete studenet details
    public function destroy($id) {
        // Find the teacher record by ID
        $teacher = Teachers::findOrFail($id);

        // Retrieve the associated user ID
        $userId = $teacher->User_ID;

        // Delete the teacher record
        $teacher->delete();

        // Delete the associated user record
        User::destroy($userId);

        return redirect()->back()->with('info', 'Teacher details deleted successfully!');
    }

}
