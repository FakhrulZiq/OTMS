@extends('layout')

@section('content')
<head>
    <title>Student Learning Progress Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/studentApplicationStatus.css') }}">
</head>

<h4 style="margin-left: 10%;"><a href="{{ url()->previous() }}"><i class="fa fa-angle-double-left" style="font-size:25px;"></i> Back</a></h4>
<h2 style="margin-left: 10%">Student Application Status</h2>

<div class="containers">
    <div class="profile">
        <img class="profile-image" src="{{$student->ProfileImage ? asset('/profileImages/' .$student->ProfileImage) : asset('/images/no-image.jpg')}}" alt="Profile Image">
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