@extends('layout')

@section('content')
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .nav-pills .nav-link {
            padding: 10px 20px;
        }
        
        .nav-pills .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<div class="container py-5" style="zoom: 145%">
    <div class="row">
        <div class="col-3">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="pill" href="#profile"><i class="fa fa-fw fa-user mr-1"></i><span>Profile</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="password-tab" data-toggle="pill" href="#password"><i class="fa fa-fw fa-unlock-alt mr-1"></i><span>Password</span></a>
                </li>
            </ul>
        </div>
        <div class="col-9">
            <div class="tab-content">
                <div id="profile" class="tab-pane active">
                    <form class="form" method="POST" action="{{ route('headmasters.uploadPhoto', $headmaster->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12 col-sm-auto mb-3">
                                <div class="mx-auto" style="width: 100px; height: 115px; overflow: hidden;">
                                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 100%; background-color: rgb(233, 236, 239);">
                                        @if ($headmaster->ProfileImage)
                                            <img src="{{ asset('profileImages/' . $headmaster->ProfileImage) }}" alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/no-image.jpg') }}" alt="Default Profile Image" style="width: 100%; height: 100%; object-fit: cover;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                <div class="text-center text-sm-left mb-2 mb-sm-0">
                                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ $headmaster->FullName }}</h4>
                                    <p class="mb-0">{{ $headmaster->ICno }}</p>
                                    <div class="text-muted"><small>Last seen 2 hours ago</small></div>
                                    <div class="mt-2">
                                        <input type="file" name="ProfileImage" style="padding-bottom: 10px">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-fw fa-camera"></i>
                                            <span>Change Photo</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="text-center text-sm-right">
                                    <span class="badge badge-secondary">headmaster</span>
                                    <div class="text-muted"><small>{{ date('d-m-Y', strtotime($headmaster->updated_at)) }}</small></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="{{ route('headmasters.update', ['headmaster' => $headmaster->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="form-control" type="text" name="FullName" placeholder="{{$headmaster->FullName}}" value="{{$headmaster->FullName}}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>IC Number</label>
                                    <input class="form-control" type="text" name="ICno" placeholder="{{$headmaster->ICno}}" value="{{$headmaster->ICno}}">
                                </div>
                            </div>     
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Address 1</label>
                                    <input class="form-control" type="text" name="Address1" placeholder="{{$headmaster->Address1}}" value="{{$headmaster->Address1}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Address 2</label>
                                    <input class="form-control" type="text" name="Address2" placeholder="{{$headmaster->Address2}}" value="{{$headmaster->Address2}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Posscode</label>
                                    <input class="form-control" type="number" name="Poscode" placeholder="{{$headmaster->Poscode}}" value="{{$headmaster->Poscode}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" type="text" name="City" placeholder="{{$headmaster->City}}" value="{{$headmaster->City}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>State</label>
                                    <select class="form-control custom-select browser-default" name="State" id="State">
                                        <option value="">--Choose--</option>
                                        <option value="Johor" {{$headmaster->State == "Johor"? 'selected' : ''}}>Johor</option>
                                        <option value="Kedah" {{$headmaster->State == "Kedah"? 'selected' : ''}}>Kedah</option>
                                        <option value="Kelantan" {{$headmaster->State == "Kelantan"? 'selected' : ''}}>Kelantan</option>
                                        <option value="Melaka" {{$headmaster->State == "Melaka"? 'selected' : ''}}>Melaka</option>
                                        <option value="Negeri Sembilan" {{$headmaster->State == "Negeri Sembilan"? 'selected' : ''}}>Negeri Sembilan</option>
                                        <option value="Pahang" {{$headmaster->State == "Pahang"? 'selected' : ''}}>Pahang</option>
                                        <option value="Perak" {{$headmaster->State == "Perak"? 'selected' : ''}}>Perak</option>
                                        <option value="Perlis" {{$headmaster->State == "Perlis"? 'selected' : ''}}>Perlis</option>
                                        <option value="Pulau Pinang" {{$headmaster->State == "Pulau Pinang"? 'selected' : ''}}>Pulau Pinang</option>
                                        <option value="Sabah" {{$headmaster->State == "Sabah"? 'selected' : ''}}>Sabah</option>
                                        <option value="Sarawak" {{$headmaster->State == "Sarawak"? 'selected' : ''}}>Sarawak</option>
                                        <option value="Selangor" {{$headmaster->State == "Selangor"? 'selected' : ''}}>Selangor</option>
                                        <option value="Terengganu" {{$headmaster->State == "Terengganu"? 'selected' : ''}}>Terengganu</option>
                                        <option value="Wilayah Persekutuan Kuala Lumpur" {{$headmaster->State == "Wilayah Persekutuan Kuala Lumpur"? 'selected' : ''}}>Wilayah Persekutuan Kuala Lumpur</option>
                                        <option value="Wilayah Persekutuan Kuala Labuan" {{$headmaster->State == "Wilayah Persekutuan Kuala Labuan"? 'selected' : ''}}>Wilayah Persekutuan Labuan</option>
                                        <option value="Wilayah Persekutuan Kuala Putrajaya" {{$headmaster->State == "Wilayah Persekutuan Kuala Putrajaya"? 'selected' : ''}}>Wilayah Persekutuan Putrajaya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" name="PhoneNo" id="PhoneNo" value="{{$headmaster->PhoneNo}}" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Nationality</label>
                                    <select id="warganeagara" class="form-control browser-default custom-select" name="Nationality" id="Nationality">
                                        <option value="Warganegara" {{$headmaster->Nationality == "Warganegara"? 'selected' : ''}}>Warganegara</option>
                                        <option value="Bukan Warganegara" {{$headmaster->Nationality == "Bukan Warganegara"? 'selected' : ''}}>Bukan Warganegara</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-primary" type="submit">Save Changes</button>
                            </div>
                        </div> 
                    </form>
                </div>
                <div id="password" class="tab-pane">
                    <form class="form" method="POST" action="{{ route('users.updatePassword', ['user' => $headmaster->id]) }}" novalidate onsubmit="return validatePassword()">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input class="form-control @error('current_password') is-invalid @enderror" type="password" placeholder="Current Password" name="current_password">
                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input class="form-control @error('new_password') is-invalid @enderror" type="password" placeholder="New Password" name="new_password">
                                    @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="form-control @error('confirm_password') is-invalid @enderror" type="password" placeholder="Confirm Password" name="confirm_password">
                                    @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-primary" type="submit">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    var profileTab = document.getElementById("profile-tab");
    var passwordTab = document.getElementById("password-tab");
    var profileContent = document.getElementById("profile");
    var passwordContent = document.getElementById("password");

    profileTab.addEventListener("click", function (event) {
        event.preventDefault();
        profileTab.classList.add("active");
        passwordTab.classList.remove("active");
        profileContent.classList.add("show", "active");
        passwordContent.classList.remove("show", "active");
    });

    passwordTab.addEventListener("click", function (event) {
        event.preventDefault();
        profileTab.classList.remove("active");
        passwordTab.classList.add("active");
        profileContent.classList.remove("show", "active");
        passwordContent.classList.add("show", "active");
    });
</script>
<script>
    function validatePassword() {
        var currentPassword = document.getElementById("current_password").value;
        var newPassword = document.getElementById("new_password").value;
        var confirmPassword = document.getElementById("confirm_password").value;

        // Make an AJAX request to check if the current password is correct
        // Replace 'check-password-url' with the actual URL that checks the password from the backend
        $.ajax({
            url: 'check-password-url',
            type: 'POST',
            data: { current_password: currentPassword },
            success: function(response) {
                if (!response.success) {
                    // Display an error message if the current password is incorrect
                    document.getElementById("current_password_error").innerHTML = response.message;
                    return false;
                } else {
                    // Clear the error message if the current password is correct
                    document.getElementById("current_password_error").innerHTML = "";
                    
                    // Check if the confirm password matches the new password
                    if (newPassword !== confirmPassword) {
                        document.getElementById("confirm_password_error").innerHTML = "Confirm password must match the new password.";
                        return false;
                    } else {
                        document.getElementById("confirm_password_error").innerHTML = "";
                        return true;
                    }
                }
            },
            error: function(xhr, status, error) {
                // Handle the error case
                console.error(error);
            }
        });
    }
</script>

@endsection
