<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
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
        
        return view('teachers.indexTeacher', [
            // 'teachers' => teachers::latest()->filter(request(['Status', 'search']))->paginate(10)
            'teachers' => Teachers::latest()->paginate(10)
        ]);
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
        Teachers::destroy($id);

        return redirect()->back() ->with('info','Teachers details deleted successfully!');
    }
}
