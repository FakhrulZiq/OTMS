@extends('layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .image-container {
        width: 260px;
        height: 260px; 
        overflow: hidden; 
        border-radius: 50%; 
        border: 2px solid #ffffff; 
        box-sizing: border-box; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
    }

    .image-container img {
        width: 100%; 
        height: 100%; 
        object-fit: cover;
        border-radius: 50%; 
    }
</style>
<div class="container bootstrap snippet">
    <div class="row">
        <h4><a href="{{ url()->previous() }}"><i class="fa fa-angle-double-left" style="font-size:25px;"></i> Back</a></h4>
        <div class="col-sm-10"><h1>Register Teacher</h1></div>
    </div>
    <div class="row">
        <!--left col-->
        <div class="col-sm-3">
            <form class="form" action="{{ route('teachers.store') }}" method="POST" id="registrationForm" enctype="multipart/form-data">
                @csrf
            <div class="text-center">
                <div class="image-container">
                    <img src="/images/no-image.jpg">
                </div>
                <h6>Upload a different photo...</h6>
                <input type="file" class="text-center center-block file-upload" name="ProfileImage" id="ProfileImage">
            </div><br>
            <div class="panel panel-default">
            </div>
        
        </div><!--/col-3-->
        <div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li><a data-toggle="tab" id="login-tab" href="#login">Login Credential</a></li>
            </ul>
            <input type="hidden" id="hidden-field-1" name="FullName" value="Full Name">
            <input type="hidden" id="hidden-field-2" name="ICno" value="000001-00-0000">
            <input type="hidden" id="hidden-field-3" name="Address1" value="Address 1">
            <input type="hidden" id="hidden-field-4" name="Address2" value="Address 2">
            <input type="hidden" id="hidden-field-5" name="Poscode" value="00000">
            <input type="hidden" id="hidden-field-6" name="City" value="City">
            <input type="hidden" id="hidden-field-7" name="State" value="State">
            <input type="hidden" id="hidden-field-8" name="PhoneNo" value="000-00000000">
            <input type="hidden" id="hidden-field-9" name="Nationality" value="Nationality">       

            <div class="tab-pane" id="login">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="first_name"><h4>Username</h4></label>
                        <input type="text" class="form-control" name="Username" placeholder="Username" required>
                        @error('Username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                            </div>
                            <div class="form-group"> 
                                <div class="col-xs-6">
                                    <label for="last_name"><h4>Email</h4></label>
                                    <input type="email" class="form-control" name="Email" placeholder="Email" required>
                                    @error('Email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="address-1"><h4>Password</h4></label>
                                    <input type="text" class="form-control" name="Password" placeholder="Password" required>
                                    @error('Password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-lg btn-success" style="float: right" type="submit" onclick="confirm('Are you sure?')"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                </div>
            </div>
        </div><!--/tab-content-->
    </div><!--/col-9-->
    <h1 style="margin-bottom: 50px"></h1>
</div><!--/row-->
<script>
    function openLoginTab() {
      // Get the element representing the "message" tab
      var messageTab = document.getElementById("login-tab");
    
      // Activate the "message" tab
      messageTab.click();
    }
</script>
<script>
    function openTeacherTab() {
      // Get the element representing the "message" tab
      var messageTab = document.getElementById("teacher-tab");
    
      // Activate the "message" tab
      messageTab.click();
    }
</script>
@endsection