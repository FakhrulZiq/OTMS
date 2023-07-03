@extends('layout')

@section('content')
@php
    $userId = auth()->id();
@endphp

<style>
    .custom-button {
        display: inline-block;
        padding: 5px 5px;
        font-size: 1.5rem;
        font-weight: 400;
        line-height: 1.5;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        border: 1px solid transparent;
        border-radius: 0.5rem;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
    }

    .custom-button:hover {
        background-color: #013872;
        color: #fff;
    }

</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container bootstrap snippet">
    <h3 class="text-center">Student Registration Form</h3>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" id="student-tab" href="#student">Student</a></li>
        <li><a data-toggle="tab" id="parent-tab" href="#parent">Parent</a></li>
        <li><a data-toggle="tab" id="classes-tab" href="#classes">Class</a></li>
        <li><a data-toggle="tab" id="disclaimer-tab" href="#disclaimer">Confession</a></li>
    </ul>

    <form method="POST" action="/students" enctype="multipart/form-data">
        @csrf

        <div class="tab-content">
            <div class="tab-pane active" id="student">
                <div class="col-sm-12">
                    <h1> </h1>
                </div>

                <div class="col-sm-12 form-group">
                    <label for="fname"><h4>Full Name</h4></label>
                    <input type="text" class="form-control" name="FullName" id="FullName" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" placeholder="Full Name" value="{{ old('FullName') }}">
                    @error('FullName')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="noSuratBeranak"><h4>Birth Certificate No.</h4></label>
                    <input type="text" class="form-control" name="birthCertificateNO" id="birthCertificateNO" placeholder="Birth Certificate No" value="{{ old('birthCertificateNO') }}">
                    @error('birthCertificateNO')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="noMykid"><h4>MyKid</h4></label>
                    <input type="tel " class="form-control" name="MyKid" id="MyKid" placeholder="000000-00-0000" value="{{ old('MyKid') }}">
                    @error('MyKid')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-1"><h4>Address-1</h4></label>
                    <input type="text" class="form-control" name="Address1" id="Address1" placeholder="Address-1" value="{{ old('Address1') }}">
                    @error('Address1')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-2"><h4>Address-2</h4></label>
                    <input type="text" class="form-control" name="Address2" id="Address2" placeholder="Address-2" value="{{ old('Address2') }}">
                    @error('Address2')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-3 form-group">
                    <label for="State"><h4>Poscode</h4></label>
                    <input type="number" class="form-control" name="Poscode" id="Poscode" placeholder="Poscode" value="{{ old('Poscode') }}">
                    @error('Poscode')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-3 form-group">
                    <label for="city"><h4>City</h4></label>
                    <input type="text" class="form-control" name="City" id="City" placeholder="City" value="{{ old('City') }}">
                    @error('City')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="state"><h4>State</h4></label>
                    <select class="form-control custom-select browser-default" name="State" id="State">
                        <option value="">--Choose--</option>
                        <option value="Johor" {{ old('State') == 'Johor' ? 'selected' : '' }}>Johor</option>
                        <option value="Kedah" {{ old('State') == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                        <option value="Kelantan" {{ old('State') == 'Kelantan' ? 'selected' : '' }}>Kelantan</option>
                        <option value="Melaka" {{ old('State') == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                        <option value="Negeri Sembilan" {{ old('State') == 'Negeri Sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
                        <option value="Pahang" {{ old('State') == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                        <option value="Perak" {{ old('State') == 'Perak' ? 'selected' : '' }}>Perak</option>
                        <option value="Perlis" {{ old('State') == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                        <option value="Pulau Pinang" {{ old('State') == 'Pulau Pinang' ? 'selected' : '' }}>Pulau Pinang</option>
                        <option value="Sabah" {{ old('State') == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                        <option value="Sarawak" {{ old('State') == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                        <option value="Selangor" {{ old('State') == 'Selangor' ? 'selected' : '' }}>Selangor</option>
                        <option value="Terengganu" {{ old('State') == 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
                        <option value="Wilayah Persekutuan Kuala Lumpur" {{ old('State') == 'Wilayah Persekutuan Kuala Lumpur' ? 'selected' : '' }}>Wilayah Persekutuan Kuala Lumpur</option>
                        <option value="Wilayah Persekutuan Kuala Labuan" {{ old('State') == 'Wilayah Persekutuan Labuan' ? 'selected' : '' }}>Wilayah Persekutuan Labuan</option>
                        <option value="Wilayah Persekutuan Kuala Putrajaya" {{ old('State') == 'Wilayah Persekutuan Putrajaya' ? 'selected' : '' }}>Wilayah Persekutuan Putrajaya</option>
                    </select>
                    @error('State')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="Date"><h4>Birth Date</h4></label>
                    <input type="Date" name="DOB" class="form-control" id="DOB" placeholder="" value="{{ old('DOB') }}">
                    @error('DOB')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="sex"><h4>Gender</h4></label>
                    <select id="sex" class="form-control browser-default custom-select" name="Sex" id="Sex" value="{{ old('Sex') }}">
                        <option value="">--Choose--</option>
                        <option value="Male" {{ old('Sex') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('Sex') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('Sex')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="tel"><h4>Phone No.</h4></label>
                    <input type="tel" name="PhoneNo" class="form-control" id="PhoneNo" placeholder="000-00000000" value="{{ old('PhoneNo') }}">
                    @error('PhoneNo')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="pass"><h4>Nationality</h4></label>
                    <select id="warganeagara" class="form-control browser-default custom-select" name="Nationality" id="Nationality">
                        <option value="">--Choose--</option>
                        <option value="Malaysian" {{ old('Nationality') == 'Malaysian' ? 'selected' : '' }}>Malaysian</option>
                        <option value="Non-Malaysian" {{ old('Nationality') == 'Non-Malaysian' ? 'selected' : '' }}>Non-Malaysian</option>
                    </select>
                    @error('Nationality')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="cod"><h4>Disability (if yes state any)</h4></label>
                    <input type="text" class="form-control" name="Disability" id="Disability" placeholder="State if any" value="{{ old('Disability') }}">
                    @error('Disability')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-3 form-group">
                    <label for="cod"><h4>Bill of Sibling</h4></label>
                    <input type="number" class="form-control" name="BillSibling" id="BillSibling" placeholder="Bill of Sibling" value="{{ old('BillSibling') }}">
                    @error('BillSibling')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-3 form-group">
                    <label for="cod"><h4>Child No.</h4></label>
                    <input type="number" class="form-control" name="AnakKe" id="AnakKe" placeholder="Child No.?" value="{{ old('AnakKe') }}">
                    @error('AnakKe')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-3 form-group">
                    <label class="custom-file-label" for="ProfileImage"><h4>Choose Profile Image</h4></label>
                    <input type="file" class="custom-file-input" id="ProfileImage" name="ProfileImage">
                </div>
                <div class="col-sm-9 form-group">
                    <label for="cod"><h4>School Name</h4></label>
                    <input type="text" class="form-control" name="SchoolName" id="SchoolName" placeholder="School Name" value="{{ old('SchoolName') }}">
                    <input type="hidden" class="form-control" name="Status" id="Status" value="Pending">
                    @error('SchoolName')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <input type="hidden" id="hidden-field-2" name="percentage" value="0">
                <input type="hidden" id="hidden-field-3" name="juzuk" value="0">
                <input type="hidden" id="hidden-field-4" name="page" value="0">
                <div class="col-sm-12">
                    <h1> </h1>
                    <br>
                    <br>
                </div>
                <div class="col-sm-11">
                    <h1></h1>
                </div>
                <div class="col-sm-1">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link custom-button" href="#" onclick="openParentTab()">Next</a>
                        </li>
                    </ul>
                </div>                         
                <div class="col-sm-12">
                    <h1> </h1>
                </div>       
            </div>
            <div class="tab-pane" id="parent">
                <div class="col-sm-12">
                    <h1> </h1>
                </div>
                <div class="col-sm-12">
                    <input type="checkbox" id="fillParentInfo" onchange="fillParentData()">
                    <label for="fillParentInfo"><h4>I am the parent</h4></label>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="fname"><h4>Full Name</h4></label>
                    <input type="text" class="form-control" name="ParentFullName" id="ParentFullName" onkeyup=" var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" placeholder="Parent Full Name" value="{{ old('ParentFullName') }}">
                    @error('ParentFullName')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="noMykid"><h4>IC Number</h4></label>
                    <input type="tel" class="form-control" name="ParentICno" id="ParentICno" placeholder="000000-00-0000" value="{{ old('ParentICno') }}">
                    @error('ParentICno')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-1"><h4>Address-1</h4></label>
                    <input type="text" class="form-control" name="ParentAddress1" id="ParentAddress1" placeholder="Address-1" value="{{ old('ParentAddress1') }}">
                    @error('ParentAddress1')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-2"><h4>Address-2</h4></label>
                    <input type="text" class="form-control" name="ParentAddress2" id="ParentAddress2" placeholder="Address-2" value="{{ old('ParentAddress2') }}">
                    @error('ParentAddress2')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-3 form-group">
                    <label for="Poscode"><h4>Posscode</h4></label>
                    <input type="number" class="form-control" name="ParentPoscode" id="ParentPoscode" placeholder="Poscode" value="{{ old('ParentPoscode') }}">
                    @error('ParentPoscode')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-3 form-group">
                    <label for="city"><h4>City</h4></label>
                    <input type="text" class="form-control" name="ParentCity" id="ParentCity" placeholder="CIty" value="{{ old('ParentCity') }}">
                    @error('ParentCity')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="state"><h4>State</h4></label>
                    <select class="form-control custom-select browser-default" name="ParentState" id="ParentState">
                        <option value="">--Choose--</option>
                        <option value="Johor" {{ old('ParentState') == 'Johor' ? 'selected' : '' }}>Johor</option>
                        <option value="Kedah" {{ old('ParentState') == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                        <option value="Kelantan" {{ old('ParentState') == 'Kelantan' ? 'selected' : '' }}>Kelantan</option>
                        <option value="Melaka" {{ old('ParentState') == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                        <option value="Negeri Sembilan" {{ old('ParentState') == 'Negeri Sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
                        <option value="Pahang" {{ old('ParentState') == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                        <option value="Perak" {{ old('ParentState') == 'Perak' ? 'selected' : '' }}>Perak</option>
                        <option value="Perlis" {{ old('ParentState') == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                        <option value="Pulau Pinang" {{ old('ParentState') == 'Pulau Pinang' ? 'selected' : '' }}>Pulau Pinang</option>
                        <option value="Sabah" {{ old('ParentState') == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                        <option value="Sarawak" {{ old('ParentState') == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                        <option value="Selangor" {{ old('ParentState') == 'Selangor' ? 'selected' : '' }}>Selangor</option>
                        <option value="Terengganu" {{ old('ParentState') == 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
                        <option value="Wilayah Persekutuan Kuala Lumpur" {{ old('ParentState') == 'Wilayah Persekutuan Kuala Lumpur' ? 'selected' : '' }}>Wilayah Persekutuan Kuala Lumpur</option>
                        <option value="Wilayah Persekutuan Kuala Labuan" {{ old('ParentState') == 'Wilayah Persekutuan Labuan' ? 'selected' : '' }}>Wilayah Persekutuan Labuan</option>
                        <option value="Wilayah Persekutuan Kuala Putrajaya" {{ old('ParentState') == 'Wilayah Persekutuan Putrajaya' ? 'selected' : '' }}>Wilayah Persekutuan Putrajaya</option>
                    </select>
                    @error('ParentState')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="tel"><h4>Phone Number</h4></label>
                    <input type="tel" name="ParentPhoneNo" class="form-control" id="ParentPhoneNo" placeholder="000-00000000" value="{{ old('ParentPhoneNo') }}">
                    @error('ParentPhoneNo')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="pass"><h4>Nationality</h4></label>
                    <select id="warganeagara" class="form-control browser-default custom-select" name="ParentNationality" id="ParentNationality">
                        <option value="">--Choose--</option>
                        <option value="Malaysian" {{ old('ParentNationality') == 'Malaysian' ? 'selected' : '' }}>Malaysian</option>
                        <option value="Non-Malaysian" {{ old('ParentNationality') == 'Non-Malaysian' ? 'selected' : '' }}>Non-Malaysian</option>
                    </select>
                    @error('ParentNationality')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="cod"><h4>Job</h4></label>
                    <input type="text" class="form-control" name="ParentJob" id="ParentJob" placeholder="Job/ Position" value="{{ old('ParentJob') }}">
                    @error('ParentJob')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="cod"><h4>Income</h4></label>
                    <input type="number" class="form-control" name="ParentIncome" id="ParentIncome" placeholder="RM " value="{{ old('ParentIncome') }}">
                    @error('ParentIncome')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-1"><h4>Office Address-1</h4></label>
                    <input type="text" class="form-control" name="OfficeAddress1" id="OfficeAddress1" placeholder="Address-1" value="{{ old('OfficeAddress1') }}">
                    @error('OfficeAddress1')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-2"><h4>Office Address-2</h4></label>
                    <input type="text" class="form-control" name="OfficeAddress2" id="OfficeAddress2" placeholder="Address-2" value="{{ old('OfficeAddress2') }}">
                    @error('OfficeAddress2')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-2 form-group">
                    <label for="poscode"><h4>Office Posscode</h4></label>
                    <input type="number" class="form-control" name="OfficePoscode" id="OfficePoscode" placeholder="Poscode" value="{{ old('OfficePoscode') }}">
                    @error('OfficePoscode')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-4 form-group">
                    <label for="city"><h4>Office City</h4></label>
                    <input type="text" class="form-control" name="OfficeCity" id="OfficeCity" placeholder="City" value="{{ old('OfficeCity') }}">
                    @error('OfficeCity')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="state"><h4>Office State</h4></label>
                    <select class="form-control custom-select browser-default" name="OfficeState" id="OfficeState">
                        <option value="">--Choose--</option>
                        <option value="Johor" {{ old('OfficeState') == 'Johor' ? 'selected' : '' }}>Johor</option>
                        <option value="Kedah" {{ old('OfficeState') == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                        <option value="Kelantan" {{ old('OfficeState') == 'Kelantan' ? 'selected' : '' }}>Kelantan</option>
                        <option value="Melaka" {{ old('OfficeState') == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                        <option value="Negeri Sembilan" {{ old('OfficeState') == 'Negeri Sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
                        <option value="Pahang" {{ old('OfficeState') == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                        <option value="Perak" {{ old('OfficeState') == 'Perak' ? 'selected' : '' }}>Perak</option>
                        <option value="Perlis" {{ old('OfficeState') == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                        <option value="Pulau Pinang" {{ old('OfficeState') == 'Pulau Pinang' ? 'selected' : '' }}>Pulau Pinang</option>
                        <option value="Sabah" {{ old('OfficeState') == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                        <option value="Sarawak" {{ old('OfficeState') == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                        <option value="Selangor" {{ old('OfficeState') == 'Selangor' ? 'selected' : '' }}>Selangor</option>
                        <option value="Terengganu" {{ old('OfficeState') == 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
                        <option value="Wilayah Persekutuan Kuala Lumpur" {{ old('OfficeState') == 'Wilayah Persekutuan Kuala Lumpur' ? 'selected' : '' }}>Wilayah Persekutuan Kuala Lumpur</option>
                        <option value="Wilayah Persekutuan Kuala Labuan" {{ old('OfficeState') == 'Wilayah Persekutuan Labuan' ? 'selected' : '' }}>Wilayah Persekutuan Labuan</option>
                        <option value="Wilayah Persekutuan Kuala Putrajaya" {{ old('OfficeState') == 'Wilayah Persekutuan Putrajaya' ? 'selected' : '' }}>Wilayah Persekutuan Putrajaya</option>
                    </select>
                    @error('OfficeState')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-12">
                    <h1> </h1>
                    <br>
                    <br>
                </div>
                <div class="col-sm-1">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link custom-button" href="#" onclick="openStudentTab()">Back</a>
                        </li>
                    </ul>
                </div>  
                <div class="col-sm-10">
                    <h1></h1>
                </div>
                <div class="col-sm-1">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link custom-button" href="#" onclick="openClassesTab()">Next</a>
                        </li>
                    </ul>
                </div>      
                <div class="col-sm-12">
                    <h1> </h1>
                </div>  
            </div>
            <div class="tab-pane" id="classes">
                <div class="row">
                    <div class="col-sm-12">
                        <br>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="Class"><h4>Class</h4></label>
                        <select class="form-control custom-select browser-default" name="Class_id" id="Class_id">
                            <option value="">--Choose--</option>
                            <option value="1" {{ old('Class_id') == '1' ? 'selected' : '' }}>LEVEL 1 - IQRA (Session 1 - Morning)</option>
                            <option value="2" {{ old('Class_id') == '2' ? 'selected' : '' }}>LEVEL 1 - IQRA (Session 2 - Morning)</option>
                            <option value="3" {{ old('Class_id') == '3' ? 'selected' : '' }}>LEVEL 1 - IQRA (Session 2 - Night)</option>
                            <option value="4" {{ old('Class_id') == '4' ? 'selected' : '' }}>LEVEL 1 - IQRA (Session 2 - Night)</option>
                            <option value="5" {{ old('Class_id') == '5' ? 'selected' : '' }}>LEVEL 2 - TALAQI BACAAN (Session 1 - Morning)</option>
                            <option value="6" {{ old('Class_id') == '6' ? 'selected' : '' }}>LEVEL 2 - TALAQI BACAAN (Session 2 - Morning)</option>
                            <option value="7" {{ old('Class_id') == '7' ? 'selected' : '' }}>LEVEL 2 - TALAQI BACAAN (Session 1 - Night)</option>
                            <option value="8" {{ old('Class_id') == '8' ? 'selected' : '' }}>LEVEL 2 - TALAQI BACAAN (Session 2 - Night)</option>
                            <option value="9" {{ old('Class_id') == '9' ? 'selected' : '' }}>LEVEL 3 - TALAQI & HAFAZAN (Session 1 - Morning)</option>
                            <option value="10" {{ old('Class_id') == '10' ? 'selected' : '' }}>LEVEL 3 - TALAQI & HAFAZAN (Session 2 - Morning)</option>
                            <option value="11" {{ old('Class_id') == '11' ? 'selected' : '' }}>LEVEL 3 - TALAQI & HAFAZAN (Session 1 - Night)</option>
                            <option value="12" {{ old('Class_id') == '12' ? 'selected' : '' }}>LEVEL 3 - TALAQI & HAFAZAN (Session 2 - Night)</option>
                        </select>
                        @error('Class_id')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <h1> </h1>
                        <br>
                        <br>
                    </div>
                    <div class="col-sm-1">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link custom-button" href="#" onclick="openParentTab()">Back</a>
                            </li>
                        </ul>
                    </div>  
                    <div class="col-sm-10">
                        <h1></h1>
                    </div>
                    <div class="col-sm-1">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link custom-button" href="#" onclick="openDisclaimerTab()">Next</a>
                            </li>
                        </ul>
                    </div>      
                    <div class="col-sm-12">
                        <h1> </h1>
                    </div>  
                </div>
            </div>
            <div class="tab-pane" id="disclaimer">
                <div class="col-sm-12">
                    <h1> </h1>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="checkbox" class="form-check d-inline" id="chb" >
                        <label for="chb" class="form-check-label">&nbsp;<h4>Saya mengaku segala keterangan yang dinyatakan dalam borang ini adalah betul dan benar.</h4> </label>
                    </div>
                    <div class="col-sm-1">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link custom-button" href="#" onclick="openClassesTab()">Back</a>
                            </li>
                        </ul>
                    </div> 
                    <div class="col-sm-10">
                        <h1></h1>
                    </div>
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                    <div class="col-sm-12">
                        <h1> </h1>
                    </div>
                    @if ($errors->any())
						<div class="alert alert-danger">
							{{ $errors->first() }}
						</div>
					@endif
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function openStudentTab() {
      // Get the element representing the "message" tab
      var messageTab = document.getElementById("student-tab");
    
      // Activate the "message" tab
      messageTab.click();
    }
</script>
<script>
    function openParentTab() {
      // Get the element representing the "message" tab
      var messageTab = document.getElementById("parent-tab");
    
      // Activate the "message" tab
      messageTab.click();
    }
</script>
<script>
    function openClassesTab() {
      // Get the element representing the "message" tab
      var messageTab = document.getElementById("classes-tab");
    
      // Activate the "message" tab
      messageTab.click();
    }
</script>
<script>
    function openDisclaimerTab() {
      // Get the element representing the "message" tab
      var messageTab = document.getElementById("disclaimer-tab");
    
      // Activate the "message" tab
      messageTab.click();
    }
</script>
<script>
    function fillParentData() {
    // Check if the checkbox is checked
    if ($('#fillParentInfo').is(':checked')) {
        // Fill in the parent information from the parent table
        $('#ParentFullName').val('{{ $parent->FullName }}');
        $('#ParentICno').val('{{ $parent->ICno }}');
        $('#ParentAddress1').val('{{ $parent->Address1 }}');
        $('#ParentAddress2').val('{{ $parent->Address2 }}');
        $('#ParentPoscode').val('{{ $parent->Poscode }}');
        $('#ParentCity').val('{{ $parent->City }}');
        $('#ParentState').val('{{ $parent->State }}');
        $('#ParentPhoneNo').val('{{ $parent->PhoneNo }}');
        $('#ParentNationality').val('{{ $parent->Nationality }}');
        $('#ParentJob').val('{{ $parent->Job }}');
        $('#ParentIncome').val('{{ $parent->Income }}');
        $('#OfficeAddress1').val('{{ $parent->OfficeAddress1 }}');
        $('#OfficeAddress2').val('{{ $parent->OfficeAddress2 }}');
        $('#OfficePoscode').val('{{ $parent->OfficePoscode }}');
        $('#OfficeCity').val('{{ $parent->OfficeCity }}');
        $('#OfficeState').val('{{ $parent->OfficeState }}');
    } else {
        // Clear the parent information
        $('#ParentFullName').val('');
        $('#ParentICno').val('');
        $('#ParentAddress1').val('');
        $('#ParentAddress2').val('');
        $('#ParentPoscode').val('');
        $('#ParentCity').val('');
        $('#ParentState').val('');
        $('#ParentPhoneNo').val('');
        $('#ParentNationality').val('');
        $('#ParentJob').val('');
        $('#ParentIncome').val('');
        $('#OfficeAddress1').val('');
        $('#OfficeAddress2').val('');
        $('#OfficePoscode').val('');
        $('#OfficeCity').val('');
        $('#OfficeState').val('');
    }
}
</script>
@endsection
