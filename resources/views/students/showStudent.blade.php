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
        <h4><a href="{{ url()->previous() }}"><i class="fa fa-angle-double-left" style="font-size:25px;"></i> Back</a></h4>
        <div class="col-sm-10"><h1>Student Profile</h1></div>
    </div>    
    <div class="row">
        <!--left col-->
        <div class="col-sm-3">
            <div class="text-center">
                <div class="image-container">
                    <img src="{{$student->ProfileImage ? asset('/profileImages/' .$student->ProfileImage) : asset('/images/no-image.jpg')}}">
                </div>
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

        </div><!--/col-3-->
        <div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Student</a></li>
                <li><a data-toggle="tab" href="#messages">Parent</a></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                    <form class="form" action="##" method="post" id="registrationForm">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="first_name"><h4>Full name</h4></label>
                                <input type="text" class="form-control" name="stud_fname" id="stud_fname" style="text-transform:uppercase" placeholder="{{$student->FullName}}" readonly>
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-xs-6">
                                <label for="last_name"><h4>IC Number</h4></label>
                                <input type="tel " class="form-control" name="stud_MyKid" id="stud_ICno" pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" placeholder="{{$student->MyKid}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="phone"><h4>Birth Certificate No.</h4></label>
                                <input type="text" class="form-control" name="stud_certificateNO" id="stud_certificateNO" placeholder="{{$student->birthCertificateNO}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="mobile"><h4>Birth Date</h4></label>
                                <input type="text" name="stud_dob" class="form-control" id="stud_dob" placeholder="{{$student->DOB}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-1"><h4>Address-1</h4></label>
                                <input type="text" class="form-control" name="stud_address1" id="stud_address1" placeholder="{{$student->Address1}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-2"><h4>Address-2</h4></label>
                                <input type="text" class="form-control" name="stud_address2" id="stud_address2" placeholder="{{$student->Address2}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="State"><h4>Poscode</h4></label>
                                <input type="number" class="form-control" name="stud_poscode" id="stud_poscode" placeholder="{{$student->Poscode}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4">
                                <label for="city"><h4>City</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->City}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="state"><h4>State</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->State}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="state"><h4>Gender</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->Sex}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Phone No.</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->PhoneNo}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Nationality</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->Nationality}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Disability</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->Disability}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-3">
                                <label for="city"><h4>Bill Sibling</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->BillSibling}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-3">
                                <label for="city"><h4>No. Child</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->AnakKe}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>School Name</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->SchoolName}}" readonly>
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
                
                <!--/tab-pane-->
                <div class="tab-pane" id="messages">
                    <hr>
                    <form class="form" action="##" method="post" id="registrationForm">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="first_name"><h4>Parent Name</h4></label>
                                <input type="text" class="form-control" name="stud_fname" id="stud_fname" style="text-transform:uppercase" placeholder="{{$student->ParentFullName}}" readonly>
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-xs-6">
                                <label for="last_name"><h4>IC Number</h4></label>
                                <input type="tel " class="form-control" name="stud_MyKid" id="stud_ICno" pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" placeholder="{{$student->ParentICno}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-1"><h4>Address-1</h4></label>
                                <input type="text" class="form-control" name="stud_address1" id="stud_address1" placeholder="{{$student->ParentAddress1}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-2"><h4>Address-2</h4></label>
                                <input type="text" class="form-control" name="stud_address2" id="stud_address2" placeholder="{{$student->ParentAddress2}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="State"><h4>Poscode</h4></label>
                                <input type="number" class="form-control" name="stud_poscode" id="stud_poscode" placeholder="{{$student->ParentPoscode}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4">
                                <label for="city"><h4>City</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->ParentCity}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="state"><h4>State</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->ParentState}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Phone No.</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->ParentPhoneNo}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Nationality</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->ParentNationality}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Job</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->ParentJob}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Income</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->ParentIncome}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-1"><h4>Address-1 (Office)</h4></label>
                                <input type="text" class="form-control" name="stud_address1" id="stud_address1" placeholder="{{$student->ParentAddress1}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-2"><h4>Address-2 (Office)</h4></label>
                                <input type="text" class="form-control" name="stud_address2" id="stud_address2" placeholder="{{$student->ParentAddress2}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="State"><h4>Poscode</h4></label>
                                <input type="number" class="form-control" name="stud_poscode" id="stud_poscode" placeholder="{{$student->ParentPoscode}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4">
                                <label for="city"><h4>City (Office)</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->ParentCity}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="state"><h4>State (Office)</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$student->ParentState}}" readonly>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!--/tab-pane-->
        </div><!--/tab-content-->
    </div><!--/col-9-->
</div><!--/row-->
<h1 style="padding-bottom: 10%"></h1>
@endsection