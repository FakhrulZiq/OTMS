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
        <h4><a href="/staffs/list"><i class="fa fa-angle-double-left" style="font-size:25px;"></i> Back</a></h4>
        <div class="col-sm-10"><h1>Staff Profile</h1></div>
    </div>
    <div class="row">
        <!--left col-->
        <div class="col-sm-3">
            <form class="form" action="{{ route('staffs.update', $staff->id) }}" method="POST" id="registrationForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="text-center">
                <div class="image-container">
                    <img src="{{$staff->ProfileImage ? asset('/profileImages/' .$staff->ProfileImage) : asset('/images/no-image.jpg')}}">
                </div>
                <h6>Upload a different photo...</h6>
                <input type="file" class="text-center center-block file-upload" name="ProfileImage" id="ProfileImage">
            </div><br>
            <div class="panel panel-default">
            <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
        </div>
        
        <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
        </ul> 
            
        <div class="panel panel-default">
            <div class="panel-heading">Social Media</div>
            <div class="panel-body">
                <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
            </div>
        </div>
        
        </div><!--/col-3-->
        <div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Staff</a></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label for="first_name"><h4>Full name</h4></label>
                                <input type="text" class="form-control" name="FullName" id="FullName" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" value="{{$staff->FullName}}" required>
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-xs-12">
                                <label for="last_name"><h4>IC Number</h4></label>
                                <input type="tel " class="form-control" name="ICno" id="ICno" pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" value="{{$staff->ICno}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-1"><h4>Address-1</h4></label>
                                <input type="text" class="form-control" name="Address1" id="Address1" value="{{$staff->Address1}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-2"><h4>Address-2</h4></label>
                                <input type="text" class="form-control" name="Address2" id="Address2" value="{{$staff->Address2}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="State"><h4>Poscode</h4></label>
                                <input type="number" class="form-control" name="Poscode" id="Poscode" value="{{$staff->Poscode}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>City</h4></label>
                                <input type="text" class="form-control" name="City" id="City" value="{{$staff->City}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="state"><h4>State</h4></label>
                                <input type="text" class="form-control" name="State" id="State" value="{{$staff->State}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Phone No.</h4></label>
                                <input type="text" class="form-control" name="PhoneNo" id="PhoneNo" value="{{$staff->PhoneNo}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Nationality</h4></label>
                                <input type="text" class="form-control" name="Nationality" id="Nationality" value="{{$staff->Nationality}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Date Join</h4></label>
                                <input type="text" class="form-control" name="DateJoin" id="DateJoin" value="{{$staff->created_at}}" readonly>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-2">
                                    <br>
                                    <button class="btn btn-lg btn-success" style="position: relative; left: 71rem;" type="submit" onclick="confirm('Are you sure?')"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                    {{-- <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button> --}}
                                </div>
                        </div>
                    <hr>
                </div>
            </div>
        </div><!--/tab-content-->
    </div><!--/col-9-->
</div><!--/row-->

@endsection