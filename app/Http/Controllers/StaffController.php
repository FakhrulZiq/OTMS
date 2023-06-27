<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staffs;
use App\Models\Students;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        if (Auth::user()->user_type !== 'headmaster') {
            abort(403, 'Unauthorized');
        }
        
        staffs::destroy($id);

        return redirect()->back() ->with('info','staffs details deleted successfully!');
    }
}
