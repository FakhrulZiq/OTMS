@extends('layout')

@section('content')

@php
    $staffs = session('staffs');
@endphp

<main>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/list.css') }}" >
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <div class="container">
        <div class="row"> 
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <!-- Statistic Cards -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-default" style="background-color:#c8dcfc">
                                <div class="statistic-icon">
                                    <div class="icon icon-shape" style="background-color: #c5d300">
                                        <i class='bx bx-user-pin'></i>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4>CLERK</h4>
                                    <h2 class="statistic-number" data-number="{{$totalStaffs}}">0</h2>
                                    <a href="/staffs/list" class="view-all-btn">
                                        <span>View All</span>
                                        <i class="bx bx-right-arrow-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="statistic-icon">
                                    <div class="icon icon-shape" style="background-color: #419a49">
                                        <i class='bx bx-book-open' ></i>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4>TEACHER</h4>
                                    <h2 class="statistic-number" data-number="{{$totalTeachers}}">0</h2>
                                    <a href="/teachers/list" class="view-all-btn">
                                        <span>View All</span>
                                        <i class="bx bx-right-arrow-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="statistic-icon">
                                    <div class="icon icon-shape" style="background-color: #41609a">
                                        <i class='bx bxs-graduation'></i>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4>STUDENT</h4>
                                    <h2 class="statistic-number" data-number="{{$totalStudents}}">0</h2>
                                    <a href="/students/list" class="view-all-btn">
                                        <span>View All</span>
                                        <i class="bx bx-right-arrow-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Statistic Cards -->
                    <div class="table-responsive">
                        <div class="input-group">
                            <div class="input-group-btn search-panel">
                                <form action="{{ url()->current() }}">
                                </div>
                                <input type="hidden" name="search_param" value="all" id="search_param">         
                                <input type="text" class="form-control" name="search" id="myInput" placeholder="Search term..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                            </form>
                        </div>
                        <br>
                        <div class="text-right">
                            <a href="{{ route('staffs.registration') }}" class="btn btn-primary">Add Clerk</a>
                        </div>
                        <table class="table user-list">
                            <thead>
                                <tr>
                                    <th><span>User</span></th>
                                    <th><span>Created</span></th>
                                    <th class="text-center"><span>Status</span></th>
                                    <th><span>Email</span></th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            {{-- @unless (count($staffs) == 0) --}}

                            @foreach ($staffs as $staff)
                            <tbody id="myTable">  
                                <tr>
                                    <td>
                                        <img src="{{ $staff->ProfileImage ? asset('profileImages/' . $staff->ProfileImage) : asset('images/no-image.jpg') }}">

                                        <a href="/staffs/{{$staff['id']}}" class="user-link">{{$staff['FullName']}}</a><span class="user-subhead">Staff</span>
                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($staff->updated_at)) }}</td>
                                    <td class="text-center">
                                        Clerk
                                    </td>
                                    <td>
                                        <a href="#"><span class="__cf_email__" data-cfemail="660b0f0a07260d13080f154805090b">[email&#160;protected]</span></a>
                                    </td>
                                    <td style="width: 20%;">
                                        <form id="deleteForm_{{ $staff->id }}" action="{{ route('staffs.destroy', $staff->id) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <a href="/staffs/{{$staff['id']}}" class="table-link">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                            <a style="color: #F29727" href="/staffs/{{$staff['id']}}/edit" class="table-link">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                            <a href="#" class="table-link danger deleteBtn" data-form-id="deleteForm_{{ $staff->id }}">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination pull-right">
                        {{$staffs->links()}}
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript"></script>
    <script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script>
        // Attach click event handler to the delete button
        $('.deleteBtn').click(function () {
            // Get the ID of the form associated with the button
            var formId = $(this).data('form-id');
            
            // Display the confirmation box
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
            
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed the action
                    // Submit the associated form
                    $('#' + formId).submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // User cancelled the action
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Staff details is safe :)',
                        'error'
                    )
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.statistic-number').each(function() {
                var $this = $(this);
                var number = parseInt($this.attr('data-number'));
                $({ countNum: 0 }).animate({ countNum: number }, {
                    duration: 2000,
                    easing: 'linear',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);
                    }
                });
            });
        });
    </script>
    {{-- @endunless --}}
</main>
@endsection