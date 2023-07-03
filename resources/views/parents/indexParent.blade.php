@extends('layout')

@section('content')

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
                                        <span>Active</span>            
                                    </td>
                                    <td>
                                        <a href="#"><span class="__cf_email__" data-cfemail="660b0f0a07260d13080f154805090b">[email&#160;protected]</span></a>
                                    </td>
                                    <form id="deleteForm_{{ $parent->id }}" action="{{ route('parents.destroy', $parent->id) }}" method="POST" class="delete-form">
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
                                            <a href="#" class="table-link danger deleteBtn" data-form-id="deleteForm_{{ $parent->id }}">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                        {{-- </form> --}}
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
                        'Parent details is safe :)',
                        'error'
                    )
                }
            });
        });
    </script>

</main>
@endsection