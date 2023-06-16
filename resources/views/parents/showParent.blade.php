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
        <h4><a href="/parents/list"><i class="fa fa-angle-double-left" style="font-size:25px;"></i> Back</a></h4>
        <div class="col-sm-10"><h1>Parent Profile</h1></div>
    </div>
    <div class="row">
        <!--left col-->
        <div class="col-sm-3">
            <div class="text-center">
                <div class="image-container">
                    <img src="{{$parent->ProfileImage ? asset('/profileImages/' .$parent->ProfileImage) : asset('/images/no-image.jpg')}}">
                </div>
                
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
                <li class="active"><a data-toggle="tab" href="#home">Parent</a></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                    <form class="form" action="##" method="post" id="registrationForm">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="first_name"><h4>Full name</h4></label>
                                <input type="text" class="form-control" name="FullName" id="FullName" style="text-transform:uppercase" placeholder="{{$parent->FullName}}" readonly>
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-xs-6">
                                <label for="last_name"><h4>IC Number</h4></label>
                                <input type="tel " class="form-control" name="ICno" id="ICno" pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" placeholder="{{$parent->ICno}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-1"><h4>Address-1</h4></label>
                                <input type="text" class="form-control" name="stud_address1" id="stud_address1" placeholder="{{$parent->Address1}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-2"><h4>Address-2</h4></label>
                                <input type="text" class="form-control" name="stud_address2" id="stud_address2" placeholder="{{$parent->Address2}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="State"><h4>Poscode</h4></label>
                                <input type="number" class="form-control" name="stud_poscode" id="stud_poscode" placeholder="{{$parent->Poscode}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4">
                                <label for="city"><h4>City</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$parent->City}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="state"><h4>State</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$parent->State}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Phone No.</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$parent->PhoneNo}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Nationality</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$parent->Nationality}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Job</h4></label>
                                <input type="text" class="form-control" name="Job" id="Job" placeholder="{{$parent->Job}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>Income</h4></label>
                                <input type="number" class="form-control" name="Income" id="Income" placeholder="RM {{$parent->Income}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-1"><h4>Office Address 1</h4></label>
                                <input type="text" class="form-control" name="stud_address1" id="stud_address1" placeholder="{{$parent->Address1}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address-2"><h4>Office Address-2</h4></label>
                                <input type="text" class="form-control" name="stud_address2" id="stud_address2" placeholder="{{$parent->Address2}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-3">
                                <label for="State"><h4>Office Poscode</h4></label>
                                <input type="number" class="form-control" name="stud_poscode" id="stud_poscode" placeholder="{{$parent->Poscode}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-3">
                                <label for="city"><h4>Office City</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$parent->City}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="state"><h4>Office State</h4></label>
                                <input type="text" class="form-control" name="stud_city" id="stud_city" placeholder="{{$parent->State}}" readonly>
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
            </div><!--/tab-pane-->
        </div><!--/tab-content-->
    </div><!--/col-9-->
</div><!--/row-->

@endsection