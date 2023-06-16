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
                    <input type="text" class="form-control" name="FullName" id="FullName" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" placeholder="Full Name"required>
                    @error('FullName')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="noSuratBeranak"><h4>Birth Certificate No.</h4></label>
                    <input type="text" class="form-control" name="birthCertificateNO" id="birthCertificateNO" placeholder="Birth Certificate No" required>
                    @error('birthCertificateNO')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="noMykid"><h4>MyKid</h4></label>
                    <input type="tel " class="form-control" name="MyKid" id="MyKid" pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" placeholder="000000-00-0000" required>
                    @error('MyKid')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-1"><h4>Address-1</h4></label>
                    <input type="text" class="form-control" name="Address1" id="Address1" placeholder="Address-1" required>
                    @error('Address1')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-2"><h4>Address-2</h4></label>
                    <input type="text" class="form-control" name="Address2" id="Address2" placeholder="Address-2" required>
                    @error('Address2')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-2 form-group">
                    <label for="State"><h4>Poscode</h4></label>
                    <input type="number" class="form-control" name="Poscode" id="Poscode" placeholder="Poscode" required>
                    @error('Poscode')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-4 form-group">
                    <label for="city"><h4>City</h4></label>
                    <input type="text" class="form-control" name="City" id="City" placeholder="City" required>
                    @error('City')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="state"><h4>State</h4></label>
                    <select class="form-control custom-select browser-default" name="State" id="State">
                        <option value="">--Pilih--</option>
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Melaka">Melaka</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Pulau Pinang">Pulau Pinang</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                        <option value="Wilayah Persekutuan Kuala Lumpur">Wilayah Persekutuan Kuala Lumpur</option>
                        <option value="Wilayah Persekutuan Kuala Labuan">Wilayah Persekutuan Labuan</option>
                        <option value="Wilayah Persekutuan Kuala Putrajaya">Wilayah Persekutuan Putrajaya</option>
                    </select>
                    @error('State')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="Date"><h4>Birth Date</h4></label>
                    <input type="Date" name="DOB" class="form-control" id="DOB" placeholder="" required>
                    @error('DOB')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="sex"><h4>Gender</h4></label>
                    <select id="sex" class="form-control browser-default custom-select" name="Sex" id="Sex">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @error('Sex')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="tel"><h4>Phone No.</h4></label>
                    <input type="tel" name="PhoneNo" class="form-control" id="PhoneNo" pattern="[0-9]{3}-[0-9]{8}" placeholder="000-00000000" required>
                    @error('PhoneNo')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="pass"><h4>Nationality</h4></label>
                    <select id="warganeagara" class="form-control browser-default custom-select" name="Nationality" id="Nationality">
                        <option value="Malaysian">Malaysian</option>
                        <option value="Non-Malaysian">Non-Malaysian</option>
                    </select>
                    @error('Nationality')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="cod"><h4>Disability</h4></label>
                    <input type="text" class="form-control" name="Disability" id="Disability" value="None" placeholder="State if any" required>
                    @error('Disability')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-3 form-group">
                    <label for="cod"><h4>Bill of Sibling</h4></label>
                    <input type="number" class="form-control" name="BillSibling" id="BillSibling" placeholder="Bill of Sibling" required>
                    @error('BillSibling')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-3 form-group">
                    <label for="cod"><h4>Child No.</h4></label>
                    <input type="number" class="form-control" name="AnakKe" id="AnakKe" placeholder="Child No.?" required>
                    @error('AnakKe')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-3 form-group">
                    <label class="custom-file-label" for="ProfileImage"><h4>Choose Profile Image</h4></label>
                    <input type="file" class="custom-file-input" id="ProfileImage" name="ProfileImage" required>
                </div>
                <div class="col-sm-9 form-group">
                    <label for="cod"><h4>School Name</h4></label>
                    <input type="text" class="form-control" name="SchoolName" id="SchoolName" placeholder="School Name" required>
                    <input type="hidden" class="form-control" name="Status" id="Status" value="Pending">
                    @error('SchoolName')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <input type="hidden" id="hidden-field" name="class_id" value="1">
                <input type="hidden" id="hidden-field" name="percentage" value="0">
                <input type="hidden" id="hidden-field" name="juzuk" value="1">
                <input type="hidden" id="hidden-field" name="page" value="1">
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
                <div class="col-sm-6 form-group">
                    <label for="fname"><h4>Full Name</h4></label>
                    <input type="text" class="form-control" name="ParentFullName" id="ParentFullName" onkeyup=" var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" placeholder="Nama penuh penjaga" required>
                    @error('ParentFullName')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="noMykid"><h4>IC Number</h4></label>
                    <input type="tel" class="form-control" name="ParentICno" id="ParentICno" pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" placeholder="000000-00-0000" required>
                    @error('ParentICno')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-1"><h4>Address-1</h4></label>
                    <input type="text" class="form-control" name="ParentAddress1" id="ParentAddress1" placeholder="Alamat-1" required>
                    @error('ParentAddress1')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-2"><h4>Address-2</h4></label>
                    <input type="text" class="form-control" name="ParentAddress2" id="ParentAddress2" placeholder="Alamat-2" required>
                    @error('ParentAddress2')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-2 form-group">
                    <label for="Poscode"><h4>Posscode</h4></label>
                    <input type="number" class="form-control" name="ParentPoscode" id="ParentPoscode" placeholder="Poskod" required>
                    @error('ParentPoscode')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-4 form-group">
                    <label for="city"><h4>City</h4></label>
                    <input type="text" class="form-control" name="ParentCity" id="ParentCity" placeholder="Bandar" required>
                    @error('ParentCity')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="state"><h4>State</h4></label>
                    <select class="form-control custom-select browser-default" name="ParentState" id="ParentState">
                        <option value="">--Choose--</option>
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Melaka">Melaka</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Pulau Pinang">Pulau Pinang</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                        <option value="Wilayah Persekutuan Kuala Lumpur">Wilayah Persekutuan Kuala Lumpur</option>
                        <option value="Wilayah Persekutuan Kuala Labua">Wilayah Persekutuan Labuan</option>
                        <option value="Wilayah Persekutuan Kuala Putrajaya">Wilayah Persekutuan Putrajaya</option>
                    </select>
                    @error('ParentState')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="tel"><h4>Phone Number</h4></label>
                    <input type="tel" name="ParentPhoneNo" class="form-control" id="ParentPhoneNo" pattern="[0-9]{3}-[0-9]{8}" placeholder="00-00000000" required>
                    @error('ParentPhoneNo')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="pass"><h4>Nationality</h4></label>
                    <select id="warganeagara" class="form-control browser-default custom-select" name="ParentNationality" id="ParentNationality">
                        <option value="Warganegara">Warganegara</option>
                        <option value="Bukan Warganegara">Bukan Warganegara</option>
                    </select>
                    @error('ParentNationality')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="cod"><h4>Job</h4></label>
                    <input type="text" class="form-control" name="ParentJob" id="ParentJob" placeholder="Pekerjaan/ Jawatan" required>
                    @error('ParentJob')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="cod"><h4>Income</h4></label>
                    <input type="number" class="form-control" name="ParentIncome" id="ParentIncome" placeholder="RM " required>
                    @error('ParentIncome')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-1"><h4>Office Address-1</h4></label>
                    <input type="text" class="form-control" name="OfficeAddress1" id="OfficeAddress1" placeholder="Alamat-1" required>
                    @error('OfficeAddress1')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-2"><h4>Office Address-2</h4></label>
                    <input type="text" class="form-control" name="OfficeAddress2" id="OfficeAddress2" placeholder="Alamat-2" required>
                    @error('OfficeAddress2')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-2 form-group">
                    <label for="poscode"><h4>Office Posscode</h4></label>
                    <input type="number" class="form-control" name="OfficePoscode" id="OfficePoscode" placeholder="Poskod" required>
                    @error('OfficePoscode')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-4 form-group">
                    <label for="city"><h4>Office City</h4></label>
                    <input type="text" class="form-control" name="OfficeCity" id="OfficeCity" placeholder="Bandar" required>
                    @error('OfficeCity')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="state"><h4>Office State</h4></label>
                    <select class="form-control custom-select browser-default" name="OfficeState" id="OfficeState">
                        <option value="">--Choose--</option>
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Melaka">Melaka</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Pulau Pinang">Pulau Pinang</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                        <option value="Wilayah Persekutuan Kuala Lumpur">Wilayah Persekutuan Kuala Lumpur</option>
                        <option value="Wilayah Persekutuan Kuala Labua">Wilayah Persekutuan Labuan</option>
                        <option value="Wilayah Persekutuan Kuala Putrajaya">Wilayah Persekutuan Putrajaya</option>
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
                        <select class="form-control custom-select browser-default" name="Teacher_id" id="Teacher_id">
                            <option value="">--Choose--</option>
                            <option value="1">LEVEL 1 - IQRA (Session 1 - Morning)</option>
                            <option value="1">LEVEL 1 - IQRA (Session 2 - Morning)</option>
                            <option value="2">LEVEL 1 - IQRA (Session 2 - Night)</option>
                            <option value="2">LEVEL 1 - IQRA (Session 2 - Night)</option>
                            <option value="3">LEVEL 2 - TALAQI BACAAN (Session 1 - Morning)</option>
                            <option value="3">LEVEL 2 - TALAQI BACAAN (Session 2 - Morning)</option>
                            <option value="4">LEVEL 2 - TALAQI BACAAN (Session 1 - Night)</option>
                            <option value="4">LEVEL 2 - TALAQI BACAAN (Session 2 - Night)</option>
                            <option value="5">LEVEL 3 - TALAQI & HAFAZAN (Session 1 - Morning)</option>
                            <option value="5">LEVEL 3 - TALAQI & HAFAZAN (Session 2 - Morning)</option>
                            <option value="6">LEVEL 3 - TALAQI & HAFAZAN (Session 1 - Night)</option>
                            <option value="6">LEVEL 3 - TALAQI & HAFAZAN (Session 2 - Night)</option>
                        </select>
                        @error('ParentState')
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
                        <input type="checkbox" class="form-check d-inline" id="chb" required>
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
    
@endsection
