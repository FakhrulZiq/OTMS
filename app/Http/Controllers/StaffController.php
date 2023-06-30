<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staffs;
use App\Models\Students;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    //show all staff
    public function index() {
        if (!in_array(Auth::user()->type, ['Headmaster'])) {
            abort(403, 'Unauthorized');
        }

        $staffs = Staffs::latest()->paginate(10);

        // Get total count of user type 'staff'
        $totalStaffs = User::where('type', 'staff')->count();

        // Get total count of user type 'teacher'
        $totalTeachers = User::where('type', 'teacher')->count();

        // Get total count of students
        $totalStudents = Students::count();

        Session::put('staffs', $staffs);

        return view('staffs.indexStaff', compact('staffs', 'totalStaffs', 'totalTeachers', 'totalStudents'));
    }


    //show staff detail profile 
    public function show(Staffs $staff){
        if (Auth::user()->type !== 'Headmaster') {
            abort(403, 'Unauthorized');
        }

        return view ('staffs.showStaff', [
            'staff' => $staff
        ]);
    }

    // Create - Staff registration form
    public function create() {
        return view('staffs.registerStaff');
    }

    public function store(Request $request) {
        // Validate the form data for teacher
        $validatedStaffData = $request->validate([
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
        $user->type = 'Staff';

        // Save the user data to the database
        $user->save();

        // Create a new Teacher instance and assign the form data
        $staff = new Staffs;
        $staff->FullName = $user->name;
        $staff->ICno = $validatedStaffData['ICno'];
        $staff->Address1 = $validatedStaffData['Address1'];
        $staff->Address2 = $validatedStaffData['Address2'];
        $staff->Poscode = $validatedStaffData['Poscode'];
        $staff->City = $validatedStaffData['City'];
        $staff->State = $validatedStaffData['State'];
        $staff->PhoneNo = $validatedStaffData['PhoneNo'];
        $staff->Nationality = $validatedStaffData['Nationality'];
        $staff->Position = 'Staff';

        // Assign the User_ID with the user's ID
        $staff->User_ID = $user->id;

        // Save the teacher data to the database
        $staff->save();

        // Redirect to a success page or perform any other desired actions
        return redirect()->route('staffs.indexStaff')->with('success', 'Staff registered successfully.');
    }

    //show edit registration form
    public function edit(staffs $staff) {
        if (Auth::user()->type !== 'Headmaster') {
            abort(403, 'Unauthorized');
        }

        return view('staffs.editstaff', ['staff' => $staff]);
    }

    public function update(Request $request, $id) {
        if (!in_array(Auth::user()->type, ['Headmaster'])) {
            abort(403, 'Unauthorized');
        }

        // Find the staff record
        $staff = staffs::find($id);

        // Update the staff's details
        $staff->FullName = $request->input('FullName');
        $staff->ICno = $request->input('ICno');
        $staff->Address1 = $request->input('Address1');
        $staff->Address2 = $request->input('Address2');
        $staff->Poscode = $request->input('Poscode');
        $staff->City = $request->input('City');
        $staff->State = $request->input('State');
        $staff->PhoneNo = $request->input('PhoneNo');
        $staff->Nationality = $request->input('Nationality');

        if ($request->hasFile('ProfileImage')) {
            // Remove old profile image if exists
            if ($staff->ProfileImage && $staff->ProfileImage !== 'no-image.jpg') {
                $oldImagePath = public_path('profileImages/') . $staff->ProfileImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload new profile image
            $file = $request->file('ProfileImage');
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profileImages/'), $filename);

            // Update the staff record with the new profile image
            $staff->ProfileImage = $filename;
        }

        // Save the updated staff record
        $staff->save();

        return redirect()->back() ->with('success','staffs details updated successfully!');
    }

    public function editProfile(Staffs $staff) {
        return view('staffs.editstaffProfile', ['staff' => $staff]);
    }    
    
    public function uploadPhoto(Request $request, $id) {
        // Find the staff record
        $staff = staffs::find($id);

        if ($request->hasFile('ProfileImage')) {
            // Remove old profile image if exists
            if ($staff->ProfileImage && $staff->ProfileImage != 'no-image.jpg') {
                $oldImagePath = public_path('profileImages/') . $staff->ProfileImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload new profile image
            $file = $request->file('ProfileImage');
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profileImages/'), $filename);

            // Update the staff record with the new profile image
            $staff->ProfileImage = $filename;
            $staff->save();
        }

        return redirect()->back()->with('success', 'Profile image updated!');
    }

    //delete studenet details
    public function destroy($id) {
        if (!in_array(Auth::user()->type, ['Headmaster'])) {
            abort(403, 'Unauthorized');
        }
        
        // Find the staff record by ID
        $staff = staffs::findOrFail($id);

        // Retrieve the associated user ID
        $userId = $staff->User_ID;

        // Delete the staff record
        $staff->delete();

        // Delete the associated user record
        User::destroy($userId);

        return redirect()->back()->with('info', 'Staff details and user record deleted successfully!');
    }
}
