@extends('layout')

@section('content')

<main>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/list.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <!-- Statistic Cards -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="statistic-icon">
                                    <div class="icon icon-shape" style="background-color: #c5d300">
                                        <i class='bx bx-comment-detail'></i>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4>Pending</h4>
                                    <h2 class="statistic-number" data-number="{{$totalPendingApprovals}}">0</h2>
                                    <a href="#" class="view-all-btn">
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
                                        <i class='bx bx-comment-check' ></i>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4>Active</h4>
                                    <h2 class="statistic-number" data-number="{{$totalApproved}}">0</h2>
                                    <a href="#" class="view-all-btn">
                                        <span>View All</span>
                                        <i class="bx bx-right-arrow-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default" style="background-color:#c8dcfc">
                                <div class="statistic-icon">
                                    <div class="icon icon-shape" style="background-color: #41609a">
                                        <i class='bx bx-comment-x'></i>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4>Rejected</h4>
                                    <h2 class="statistic-number" data-number="{{$totalRejected}}">0</h2>
                                    <a href="#" class="view-all-btn">
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
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span id="search_concept">Filter by</span> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url()->current() }}">All</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ url()->current() }}?Status=Active">Active</a></li>
                                        <li><a href="{{ url()->current() }}?Status=Pending">Pending</a></li>
                                        <li><a href="{{ url()->current() }}?Status=Rejected">Rejected</a></li>
                                    </ul>
                                </div>
                                <input type="hidden" name="search_param" value="all" id="search_param">
                                <input type="text" class="form-control" name="search" id="myInput" placeholder="Search term..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                            </form>
                        </div>
                        <br>
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
                            @unless (count($students) == 0)
                            <tbody id="myTable">
                                @foreach ($students as $student)
                                <tr>
                                    <td>
                                        <img src="{{ $student->ProfileImage ? asset('profileImages/' . $student->ProfileImage) : asset('images/no-image.jpg') }}">

                                        <a href="/students/{{$student['id']}}" class="user-link">{{$student['FullName']}}</a><span class="user-subhead">Student</span>
                                    </td>
                                    <td>{{$student->DOB}}</td>
                                    <td class="text-center">
                                        @if ($student->Status == 'Active')
                                        <span class="label label-success">{{$student->Status}}</span>
                                        @elseif ($student->Status == 'Inactive')
                                        <span class="label label-danger">{{$student->Status}}</span>
                                        @elseif ($student->Status == 'Pending')
                                        <span class="label label-warning">{{$student->Status}}</span>
                                        @else
                                        <span class="label label-danger">{{$student->Status}}</span>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="#"><span class="__cf_email__" data-cfemail="660b0f0a07260d13080f154805090b">[email&#160;protected]</span></a>
                                    </td>
                                    <td style="width: 20%;">
                                        <form method="POST" action="/students/{{$student->id}}" id="deleteForm_{{$student->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="/students/{{$student['id']}}" class="table-link">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                            <a style="color: #F29727" href="/students/{{$student['id']}}/edit" class="table-link">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                            <a style="color: #419a49" href="/students/fee-payment/{{$student['id']}}" class="table-link">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-money fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                            <a href="javascript:void(0);" class="table-link danger deleteBtn" data-form-id="deleteForm_{{$student->id}}">
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
                        {{$students->links()}}
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
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.deleteBtn').click(function(e) {
                e.preventDefault(); // Don't post the form, unless confirmed
                var formId = $(this).data('form-id');
                if (confirm('Are you sure?')) {
                    // Post the form
                    $('#' + formId).submit();
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
    @endunless
</main>
@endsection