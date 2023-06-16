@extends('layout')

@section('content')
<title>Student Learning Progress Dashboard</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
     .containers {
        /* margin: 50px auto;  */
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        max-width: 50%;
        position:relative; 
        left:10%;
        top: 20px;
    } 

    .profile {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .profile-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin-right: 20px;
        object-fit: cover;
    }
    .label {
        display: inline-block;
        padding: 4px 8px;
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 4px;
        color: #fff;
    }

    .label-success {
        background-color: #28a745;
    }

    .label-danger {
        background-color: #dc3545;
    }

    .label-warning {
        background-color: #ffc107;
    }
</style>
</head>

<h4 style="margin-left: 10%"><a href="/students/learning-progress-list"><i class="fa fa-angle-double-left" style="font-size:25px;"></i> Back</a></h4>
<h2 style="margin-left: 10%">Student Application Status</h2>

<div class="containers">
    <div class="profile">
        <img class="profile-image" src="{{$student->ProfileImage ? asset('/storage/profileImages/' .$student->ProfileImage) : asset('/images/no-image.jpg')}}" alt="Profile Image">
        <div>
            <h2>{{$student->FullName}}</h2>
            <p><strong>Registration Date:</strong> {{ date('d-m-Y', strtotime($student->updated_at)) }}</p>
            <p><strong>Class: </strong>{{$class->className}}</p>
            <p>
                <strong> Status:</strong>
                @if ($student->Status == 'Active')
                    <span class="label label-success">{{$student->Status}}</span>
                @elseif ($student->Status == 'Inactive')
                    <span class="label label-danger">{{$student->Status}}</span>
                @elseif ($student->Status == 'Pending')
                    <span class="label label-warning">{{$student->Status}}</span>
                @else
                    <span class="label label-danger">{{$student->Status}}</span>
                @endif
            </p>
        </div>
    </div>
</div>
@endsection