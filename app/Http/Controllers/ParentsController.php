<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Alert;

class ParentsController extends Controller
{
    //show all parent
    public function index() {
        if (Auth::user()->type !== 'Headmaster') {
            abort(403, 'Unauthorized');
        }

        return view('Parents.indexParent', [
            // 'Parents' => Parents::latest()->filter(request(['Status', 'search']))->paginate(10)
            'parents' => Parents::latest()->paginate(10)
        ]);
    }
    //show parent detail profile 
    public function show(Parents $parent){
        if (Auth::user()->type !== 'Headmaster') {
            abort(403, 'Unauthorized');
        }
        
        return view ('Parents.showParent', [
            'parent' => $parent
        ]);
    }

    //show edit registration form
    public function edit(Parents $parent) {
        if (Auth::user()->type !== 'Headmaster') {
            abort(403, 'Unauthorized');
        }
        
        return view('parents.editParent', ['parent' => $parent]);
    }

    public function update(Request $request, $id) {
        // Update the parent's details
        $parent = Parents::find($id);
        $parent->FullName = $request->input('FullName');
        $parent->ICno = $request->input('ICno');
        $parent->Address1 = $request->input('Address1');
        $parent->Address2 = $request->input('Address2');
        $parent->Poscode = $request->input('Poscode');
        $parent->City = $request->input('City');
        $parent->State = $request->input('State');
        $parent->PhoneNo = $request->input('PhoneNo');
        $parent->Nationality = $request->input('Nationality');
        $parent->Job = $request->input('Job');
        $parent->Income = $request->input('Income');
        $parent->OfficeAddress1 = $request->input('OfficeAddress1');
        $parent->OfficeAddress2 = $request->input('OfficeAddress2');
        $parent->OfficePoscode = $request->input('OfficePoscode');
        $parent->OfficeCity = $request->input('OfficeCity');
        $parent->OfficeState = $request->input('OfficeState');

        if ($request->hasFile('ProfileImage')) {
            // Remove old profile image if exists
            if ($parent->ProfileImage && $parent->ProfileImage != 'no-image.jpg') {
                $oldImagePath = public_path('profileImages/') . $parent->ProfileImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload new profile image
            $file = $request->file('ProfileImage');
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profileImages/'), $filename);

            // Update the parent record with the new profile image
            $parent->ProfileImage = $filename;
        }

        // Save the updated parent record
        $parent->update();

        return redirect()->back()->with('success', 'Parent details updated!');
    }


    public function editProfile(Parents $parent) {
        return view('parents.editParentProfile', ['parent' => $parent]);
    }

    public function uploadPhoto(Request $request, $id) {
        // Find the parent record
        $parent = Parents::find($id);

        if ($request->hasFile('ProfileImage')) {
            // Remove old profile image if exists
            if ($parent->ProfileImage && $parent->ProfileImage != 'no-image.jpg') {
                $oldImagePath = public_path('profileImages/') . $parent->ProfileImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload new profile image
            $file = $request->file('ProfileImage');
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profileImages/'), $filename);

            // Update the parent record with the new profile image
            $parent->ProfileImage = $filename;
            $parent->save();
        }

        return redirect()->back()->with('success', 'Profile image updated!');
    }

    //delete studenet details
    public function destroy($id) {
        Parents::destroy($id);

        return redirect()->back() ->with('info','Parents details deleted successfully!');
    }
}
