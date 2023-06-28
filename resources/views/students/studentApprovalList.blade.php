@extends('layout')

@section('content')
<link rel="stylesheet" href="{{asset('css/approvalList.css')}}">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/list.css') }}" >
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
    .button-container {
        display: flex;
        flex-direction: row;
        gap: 10px;
    }

    .approve-button {
        background-color: #32e40e;
        color: white;
        border: none;
        padding: 6px 6px;
        border-radius: 6px;
    }

    .reject-button {
        background-color: #fe635f;
        color: white;
        border: none;
        padding: 6px 6px;
        border-radius: 6px;
    }

    .approve-button i,
    .reject-button i {
        margin: 0 5px;
        font-size: 1.125em;
    }
</style>
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
            <div class="panel panel-default">
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
    <nav>
        <ul class="tab-list">
          <li class="tab-item active" data-tab="pending">Pending</li>
          <li class="tab-item" data-tab="approved">Approved</li>
          <li class="tab-item" data-tab="rejected">Rejected</li>
        </ul>
      </nav>
      {{-- @unless (count($students) == 0) --}}
        <section class="tab-content active" id="pending">
          <div class="container" style="padding-top: 2rem">
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="main-box clearfix">
                        <div class="table-responsive">
                            <div class="input-group">
                                <div class="input-group-btn search-panel">
                                    <form action="{{ url()->current() }}">
                                    </div>
                                    <input type="hidden" name="search_param" value="all" id="search_param">         
                                    <input type="text" class="form-control" name="search" id="myInputPending" placeholder="Search Student...">
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
                                @foreach ($pendingApprovals as $student)
                                <tbody id="myTablePending">  
                                    <tr>
                                        <td>
                                            <img src="{{$student->ProfileImage ? asset('/profileImages/' .$student->ProfileImage) : asset('/images/no-image.jpg')}}" >
                                            <a href="/students/{{$student['id']}}" class="user-link">{{$student['FullName']}}</a><span class="user-subhead">Student</span>
                                        </td>
                                        <td>{{$student->DOB}}</td>
                                        <td class="text-center">
                                            <span class="label label-warning">{{$student->Status}}</span>
                                        </td>
                                        <td>
                                            <a href="#"><span class="__cf_email__" data-cfemail="660b0f0a07260d13080f154805090b">[email&#160;protected]</span></a>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="button-container">
                                                <form method="POST" action="{{ route('students.approve', $student->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="approve-button">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('students.reject', $student->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="reject-button ">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                        
                            <div class="pagination pull-right">
                                {{$pendingApprovals->links()}}
                            </div>
                        
                    </div>
                </div>  
            </div>
        </div>
        </section>
        
        {{-- approved tabs --}}
        <section class="tab-content" id="approved">
            <div class="container" style="padding-top: 2rem">
                <div class="row"> 
                    <div class="col-lg-12">
                        <div class="main-box clearfix">
                            <div class="table-responsive">
                                <div class="input-group">
                                    <div class="input-group-btn search-panel">
                                        <form action="{{ url()->current() }}">
                                        </div>
                                        <input type="hidden" name="search_param" value="all" id="search_param">         
                                        <input type="text" class="form-control" name="search" id="myInputApproved" placeholder="Search term...">
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
                                    @foreach ($approved as $student)
                                    <tbody id="myTableApproved">  
                                        <tr>
                                            <td>
                                                <img src="{{$student->ProfileImage ? asset('/profileImages/' .$student->ProfileImage) : asset('/images/no-image.jpg')}}" >
                                                <a href="/students/{{$student['id']}}" class="user-link">{{$student['FullName']}}</a><span class="user-subhead">Student</span>
                                            </td>
                                            <td>{{$student->DOB}}</td>
                                            <td class="text-center">
                                                <span class="label label-success">{{$student->Status}}</span>
                                            </td>
                                            <td>
                                                <a href="#"><span class="__cf_email__" data-cfemail="660b0f0a07260d13080f154805090b">[email&#160;protected]</span></a>
                                            </td>
                                            <td style="width: 20%;">
                                                {{-- <a href="/students/{{$student['id']}}" class="table-link success">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-check fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                                <form method="POST" action="/students/{{$student->id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                <a href="javascript:void(0);" class="table-link danger" id="{{$student->id}}">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a> --}}
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <div class="pagination pull-right">
                                {{$approved->links()}}
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </section>
    
        {{-- rejected tabs --}}
        <section class="tab-content" id="rejected">
            <div class="container" style="padding-top: 2rem">
                <div class="row"> 
                    <div class="col-lg-12">
                        <div class="main-box clearfix">
                            <div class="table-responsive">
                                <div class="input-group">
                                    <div class="input-group-btn search-panel">
                                        <form action="{{ url()->current() }}">
                                        </div>
                                        <input type="hidden" name="search_param" value="all" id="search_param">         
                                        <input type="text" class="form-control" name="search" id="myInputRejected" placeholder="Search term...">
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
                                    @foreach ($rejected as $student)
                                    <tbody id="myTableRejected">  
                                        <tr>
                                            <td>
                                                <img src="{{$student->ProfileImage ? asset('/profileImages/' .$student->ProfileImage) : asset('/images/no-image.jpg')}}" >
                                                <a href="/students/{{$student['id']}}" class="user-link">{{$student['FullName']}}</a><span class="user-subhead">Student</span>
                                            </td>
                                            <td>{{$student->DOB}}</td>
                                            <td class="text-center">
                                                <span class="label label-danger">{{$student->Status}}</span>
                                            </td>
                                            <td>
                                                <a href="#"><span class="__cf_email__" data-cfemail="660b0f0a07260d13080f154805090b">[email&#160;protected]</span></a>
                                            </td>
                                            <td style="width: 20%;">
                                                <div class="button-container">
                                                    <form method="POST" action="{{ route('students.approve', $student->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="approve-button">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="/students/{{$student->id}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="reject-button danger" id="{{$student->id}}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <div class="pagination pull-right">
                                {{$rejected->links()}}
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
</div>
        </section>
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript"></script>
        <script>
            $(document).ready(function(){
              $("#myInputPending").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTablePending tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            });
        </script>
        <script>
            $(document).ready(function(){
              $("#myInputApproved").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTableApproved tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            });
        </script>
        <script>
            $(document).ready(function(){
              $("#myInputRejected").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTableRejected tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            });
        </script>
        <script>
            $('.danger').click(function(e){
                e.preventDefault() // Don't post the form, unless confirmed
                if (confirm('Are you sure to permenantly delete this student?')) {
                    // Post the form
                    $(e.target).closest('form').submit() // Post the surrounding form
                }
            });
        </script>
  <script>
    // Get tab elements
    const tabItems = document.querySelectorAll('.tab-item');
    // Get tab content elements 
    const tabContents = document.querySelectorAll('.tab-content');

    // Add click event listener to each tab item
    tabItems.forEach(tabItem => {
    tabItem.addEventListener('click', () => {
        // Remove 'active' class from all tab items and tab contents
        tabItems.forEach(tab => tab.classList.remove('active'));
        tabContents.forEach(tabContent => tabContent.classList.remove('active'));

        // Add 'active' class to clicked tab item
        tabItem.classList.add('active');

        // Get the data-tab value of the clicked tab item
        const tabId = tabItem.getAttribute('data-tab');
        // Get the corresponding tab content element based on data-tab value
        const tabContent = document.getElementById(tabId);
        // Add 'active' class to corresponding tab content
        tabContent.classList.add('active');
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

