@extends('layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .image-container {
        width: 260px; /* Set the desired width of the image container */
        height: 260px; /* Set the desired height of the image container, to make it a perfect circle */
        overflow: hidden; /* Hide any overflow from the image */
        border-radius: 50%; /* Set the border radius to 50% to make it a circle */
        border: 2px solid #ffffff; /* Set the border size and color */
        box-sizing: border-box; /* Include the border in the total size of the container */
        display: flex; /* Enable flexbox layout to center the image */
        justify-content: center; /* Center the image horizontally */
        align-items: center; /* Center the image vertically */
    }

    .image-container img {
        width: 100%; /* Make the image fill the container width */
        height: 100%; /* Make the image fill the container height */
        object-fit: cover; /* Maintain aspect ratio and cover the container */
        border-radius: 50%; /* Set the border radius to 50% to make it a circle */
    }
</style>
<div class="container bootstrap snippet">
    
    <div class="row">
        <h4><a href="/students/list"><i class="fa fa-angle-double-left" style="font-size:25px;"></i> Back</a></h4>
        <div class="col-sm-10"><h1>Student Profile</h1></div>
    </div>
    <div class="row">
        <!--left col-->
        <div class="col-sm-3">
            <form class="form" action="/students/{{$student->id}}" method="POST" id="registrationForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="text-center">
                <div class="image-container">
                    <img src="{{$student->ProfileImage ? asset('/profileImages/' .$student->ProfileImage) : asset('/images/no-image.jpg')}}">
                </div>
                <h6>Upload a different photo...</h6>
                <input type="file" class="text-center center-block file-upload" name="ProfileImage" id="ProfileImage">
            </div><br>
            <div class="panel panel-default">
                <div class="panel-heading">Teacher <i class="fa fa-address-card-o"></i></div>
                <div class="panel-body">{{$teacher->FullName}}</div>
        </div>
        
        <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Date Registration</strong></span> {{ date('d-m-Y', strtotime($student->created_at)) }}</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Juzuk</strong></span> {{$learningProgress->juzuk}}</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Page</strong></span> {{$learningProgress->page}}</li>
        </ul> 
        
        <h1 style="padding-bottom: 10%"></h1>

        </div><!--/col-3-->
        <div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Student</a></li>
                <li><a data-toggle="tab" href="#messages">Parent</a></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="first_name"><h4>Full name</h4></label>
                                <input type="text" class="form-control" name="FullName" id="FullName" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" value="{{$student->FullName}}" required>
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-xs-6">
                                <label for="last_name"><h4>IC Number</h4></label>
                                <input type="tel " class="form-control" name="MyKid" id="MyKid" pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" value="{{$student->MyKid}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="phone"><h4>Birth Certificate No.</h4></label>
                                <input type="text" class="form-control" name="birthCertificateNO" id="birthCertificateNO" value="{{$student->birthCertificateNO}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="mobile"><h4>Birth Date</h4></label>
                                <input type="text" name="DOB" class="form-control" id="DOB" value="{{$student->DOB}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-1"><h4>Address-1</h4></label>
                                <input type="text" class="form-control" name="Address1" id="Address1" value="{{$student->Address1}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-2"><h4>Address-2</h4></label>
                                <input type="text" class="form-control" name="Address2" id="Address2" value="{{$student->Address2}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="State"><h4>Poscode</h4></label>
                                <input type="number" class="form-control" name="Poscode" id="Poscode" value="{{$student->Poscode}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4">
                                <label for="city"><h4>City</h4></label>
                                <input type="text" class="form-control" name="City" id="City" value="{{$student->City}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="state"><h4>State</h4></label>
                                <input type="text" class="form-control" name="State" id="State" value="{{$student->State}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="state"><h4>Gender</h4></label>
                                {{-- <input type="text" class="form-control" name="Sex" id="Sex" value="{{$student->Sex}}" required> --}}
                                <select id="sex" class="form-control browser-default custom-select" name="Sex" id="Sex">
                                    <option value="Male" {{$student->Sex == "Male"? 'selected' : ''}}>Male</option>
                                    <option value="Female" {{$student->Sex == "Female"? 'selected' : ''}}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Phone No.</h4></label>
                                <input type="text" class="form-control" name="PhoneNo" id="PhoneNo" value="{{$student->PhoneNo}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Nationality</h4></label>
                                <input type="text" class="form-control" name="Nationality" id="Nationality" value="{{$student->Nationality}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Disability</h4></label>
                                <input type="text" class="form-control" name="Disability" id="Disability" value="{{$student->Disability}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-3">
                                <label for="city"><h4>Bill Sibling</h4></label>
                                <input type="text" class="form-control" name="BillSibling" id="BillSibling" value="{{$student->BillSibling}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-3">
                                <label for="city"><h4>No. Child</h4></label>
                                <input type="text" class="form-control" name="AnakKe" id="AnakKe" value="{{$student->AnakKe}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>School Name</h4></label>
                                <input type="text" class="form-control"name="SchoolName" id="SchoolName" value="{{$student->SchoolName}}" required>
                            </div>
                        </div>
                        
                        {{-- <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <a class="btn btn-lg btn-success" data-toggle="tab"><i class="glyphicon glyphicon-ok-sign"></i> Save</a>
                                <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                            </div>
                        </div>
                    </form> --}}
                    <hr>
                </div>
                
                <!--/tab-pane-->
                <div class="tab-pane" id="messages">
                    <hr>
                    {{-- <form class="form" action="/students/{{$student->id}}_editParent" method="POST" id="registrationForm">
                        @csrf
                        @method('PUT') --}}
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="first_name"><h4>Parent Name</h4></label>
                                <input type="text" class="form-control" name="ParentFullName" id="ParentFullName" style="text-transform:uppercase" value="{{$student->ParentFullName}}" required>
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-xs-6">
                                <label for="last_name"><h4>IC Number</h4></label>
                                <input type="tel " class="form-control" name="ParentICno" id="ParentICno" pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" value="{{$student->ParentICno}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-1"><h4>Address-1</h4></label>
                                <input type="text" class="form-control" name="ParentAddress1" id="ParentAddress1" value="{{$student->ParentAddress1}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-2"><h4>Address-2</h4></label>
                                <input type="text" class="form-control" name="ParentAddress2" id="ParentAddress2" value="{{$student->ParentAddress2}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="State"><h4>Poscode</h4></label>
                                <input type="number" class="form-control" name="ParentPoscode" id="ParentPoscode" value="{{$student->ParentPoscode}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4">
                                <label for="city"><h4>City</h4></label>
                                <input type="text" class="form-control" name="ParentCity" id="ParentCity" value="{{$student->ParentCity}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="state"><h4>State</h4></label>
                                <input type="text" class="form-control" name="ParentState" id="ParentState" value="{{$student->ParentState}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Phone No.</h4></label>
                                <input type="text" class="form-control" name="ParentPhoneNo" id="ParentPhoneNo" value="{{$student->ParentPhoneNo}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Nationality</h4></label>
                                {{-- <input type="text" class="form-control" name="ParentNationality" id="ParentNationality"value="{{$student->ParentNationality}}" required> --}}
                                <select id="warganeagara" class="form-control browser-default custom-select" name="ParentNationality" id="ParentNationality">
                                    <option value="Warganegara" {{$student->ParentNationality == "Warganegara"? 'selected' : ''}}>Warganegara</option>
                                    <option value="Bukan Warganegara" {{$student->ParentNationality == "Bukan Warganegara"? 'selected' : ''}}>Bukan Warganegara</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Job</h4></label>
                                <input type="text" class="form-control" name="ParentJob" id="ParentJob" value="{{$student->ParentJob}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Income</h4></label>
                                <input type="text" class="form-control" name="ParentIncome" id="ParentIncome" value="{{$student->ParentIncome}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-1"><h4>Address-1 (Office)</h4></label>
                                <input type="text" class="form-control" name="OfficeAddress1" id="OfficeAddress1" value="{{$student->ParentAddress1}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-2"><h4>Address-2 (Office)</h4></label>
                                <input type="text" class="form-control" name="OfficeAddress2" id="OfficeAddress2" value="{{$student->ParentAddress2}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="State"><h4>Poscode</h4></label>
                                <input type="number" class="form-control" name="OfficePoscode" id="OfficePoscode" value="{{$student->ParentPoscode}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4">
                                <label for="city"><h4>City (Office)</h4></label>
                                <input type="text" class="form-control" name="OfficeCity" id="OfficeCity" value="{{$student->ParentCity}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="state"><h4>State (Office)</h4></label>
                                <input type="text" class="form-control" name="OfficeState" id="OfficeState" value="{{$student->ParentState}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2">
                                    <br>
                                    <button class="btn btn-lg btn-success" style="position: relative; left: 71rem;" type="submit" onclick="confirm('Are you sure?')"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                    {{-- <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button> --}}
                                </div>
                        </div>
                    </form>
                </div>
            </div><!--/tab-pane-->
        </div><!--/tab-content-->
    </div><!--/col-9-->
</div><!--/row-->

@endsection