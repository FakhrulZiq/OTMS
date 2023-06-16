<?php

namespace App\Http\Controllers;

use App\Models\Headmasters;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HeadmasterController extends Controller
{
    //show edit registration form
    public function edit(Headmasters $headmaster) {
        return view('headmasters.editHeadmaster', ['headmaster' => $headmaster]);
    }

    public function update(Request $request, $id) {
        // Find the headmaster record
        $headmaster = Headmasters::find($id);

        // Update the headmaster's details
        $headmaster->FullName = $request->input('FullName');
        $headmaster->ICno = $request->input('ICno');
        $headmaster->Address1 = $request->input('Address1');
        $headmaster->Address2 = $request->input('Address2');
        $headmaster->Poscode = $request->input('Poscode');
        $headmaster->City = $request->input('City');
        $headmaster->State = $request->input('State');
        $headmaster->PhoneNo = $request->input('PhoneNo');
        $headmaster->Nationality = $request->input('Nationality');

        if ($request->hasFile('ProfileImage')) {
            // Remove old profile image if exists
            if ($headmaster->ProfileImage && $headmaster->ProfileImage !== 'no-image.jpg') {
                $oldImagePath = public_path('profileImages/') . $headmaster->ProfileImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload new profile image
            $file = $request->file('ProfileImage');
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profileImages/'), $filename);

            // Update the headmaster record with the new profile image
            $headmaster->ProfileImage = $filename;
        }

        // Save the updated headmaster record
        $headmaster->save();

        return redirect()->back() ->with('success','Headmasters details updated successfully!');
    }

    public function editProfile(Headmasters $headmaster) {
        return view('Headmasters.editheadmasterProfile', ['headmaster' => $headmaster]);
    }
    
    public function uploadPhoto(Request $request, $id) {
        // Find the headmaster record
        $headmaster = Headmasters::find($id);

        if ($request->hasFile('ProfileImage')) {
            // Remove old profile image if exists
            if ($headmaster->ProfileImage && $headmaster->ProfileImage != 'no-image.jpg') {
                $oldImagePath = public_path('profileImages/') . $headmaster->ProfileImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload new profile image
            $file = $request->file('ProfileImage');
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profileImages/'), $filename);

            // Update the headmaster record with the new profile image
            $headmaster->ProfileImage = $filename;
            $headmaster->save();
        }

        return redirect()->back()->with('success', 'Profile image updated!');
    }

    //delete studenet details
    public function destroy($id) {
        Headmasters::destroy($id);

        return redirect()->back() ->with('info','Headmasters details deleted successfully!');
    }
}

