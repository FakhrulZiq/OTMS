@extends('layout')

@section('content')

<main>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/list.css') }}" >
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <div class="container">
        <div class="row"> 
            <div class="col-lg-12">
                <div class="main-box clearfix">
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
                                        <li><a href="{{ url()->current() }}?Status=Inactive">Inactive</a></li>
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
                            {{-- @unless (count($parents) == 0) --}}

                            @foreach ($parents as $parent)
                            <tbody id="myTable">  
                                <tr>
                                    <td>
                                        <img src="{{ $parent->ProfileImage ? asset('profileImages/' . $parent->ProfileImage) : asset('images/no-image.jpg') }}">

                                        <a href="/parents/{{$parent['id']}}" class="user-link">{{$parent['FullName']}}</a><span class="user-subhead">Parent</span>
                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($parent->updated_at)) }}</td>
                                    <td class="text-center">
                                        <h4>Hi</h4>            
                                    </td>
                                    <td>
                                        <a href="#"><span class="__cf_email__" data-cfemail="660b0f0a07260d13080f154805090b">[email&#160;protected]</span></a>
                                    </td>
                                    <form method="POST" action="/parents/{{$parent->id}}" id="deleteForm_{{$parent->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <td style="width: 20%;">
                                            <a href="/parents/{{$parent['id']}}" class="table-link">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                            <a style="color: #F29727" href="/parents/{{$parent['id']}}/edit" class="table-link">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                            <a href="javascript:void(0);" class="table-link danger deleteBtn" data-form-id="deleteForm_{{$parent->id}}">
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
                        {{$parents->links()}}
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
    <script>
        $(document).ready(function(){
            $('.deleteBtn').click(function(e){
                e.preventDefault(); // Don't post the form, unless confirmed
                var formId = $(this).data('form-id');
                if (confirm('Are you sure?')) {
                    // Post the form
                    $('#' + formId).submit();
                }
            });
        });
    </script>
        
    {{-- @endunless --}}
</main>
@endsection