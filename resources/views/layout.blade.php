<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/students.css') }}">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    {{-- Bootstrap Link --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTMS | Darul Huffaz Anwar</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            {{-- <i class='bx bxl-c-plus-plus icon'></i> --}}
            <div class="logo_name"><a href="#">
                <img src="{{asset('storage/images/logo2.jpg')}}" alt="logo" style="width: 180px;"></a></div>
            <i class='bx bx-menu' id="btn"></i>
        </div> 
        <ul class="nav-list">
            <li>
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Search...">
                <span class="tooltip">Search</span>
            </li>
            @auth
                @if(auth()->user()->type === 'Teacher')
                    <li>
                        <a href="/students/list"><i class='bx bx-group'></i><span class="links_name">Manage Students</span></a>
                        <span class="tooltip">Manage Student</span>
                    </li>
                    <li>
                        <a href="/students/learning-progress-list"><i class='bx bx-line-chart'></i><span class="links_name">Learning Progress</span></a>
                        <span class="tooltip">Learning Progress</span>
                    </li>
                    <li class="profile">
                        @auth
                            @if(auth()->user()->teacher()->exists())
                                @php
                                    $teacher = auth()->user()->teacher;
                                    $profileImage = $teacher->ProfileImage ? asset('profileImages/' . $teacher->ProfileImage) : asset('images/no-image.jpg');
                                @endphp
                                <div class="profile-details">
                                    <img src="{{ $profileImage }}" alt="Profile Image">
                                    <div class="name_job">
                                        <a href="{{ route('teachers.edit-profile', ['teacher' => $teacher->id]) }}" class="name" style="background-color: transparent;">{{ auth()->user()->name }}</a>
                                        <div class="job">Teacher</div>
                                    </div>
                                </div>
                            @endif
                        @endauth
                        <form action="/logout" method="POST">
                            @csrf
                            <button>
                                <i class="bx bx-log-out" id="log_out"></i>
                            </button>
                        </form>
                    </li>      
                @elseif(auth()->user()->type === 'Headmaster')
                    <li>
                        <a href="/staffs/list"><i class='bx bx-user-pin'></i><span class="links_name">Manage Staff</span></a>
                        <span class="tooltip">Manage Staff</span>
                    </li>
                    <li>
                        <a href="/teachers/list"><i class='bx bx-book-open' ></i><span class="links_name">Manage Teacher</span></a>
                        <span class="tooltip">Manage Teacher</span>
                    </li>
                    <li>
                        <a href="/parents/list"><i class='bx bxs-group'></i><span class="links_name">Manage Parent</span></a>
                        <span class="tooltip">Manage Parents</span>
                    </li>
                    <li>
                        <a href="/students/list"><i class='bx bxs-graduation'></i><span class="links_name">Manage Students</span></a>
                        <span class="tooltip">Manage Students</span>
                    </li>
                    <li>
                        <a href="/students/approval"><i class='bx bxs-book-add'></i><span class="links_name">Approval Application</span></a>
                        <span class="tooltip">Approval Application</span>
                    </li>
                    <li class="profile">
                        @auth
                            @if(auth()->user()->headmaster()->exists())
                                @php
                                    $headmaster = auth()->user()->headmaster;
                                    $profileImage = $headmaster->ProfileImage ? asset('profileImages/' . $headmaster->ProfileImage) : asset('images/no-image.jpg');
                                @endphp
                                <div class="profile-details">
                                    <img src="{{ $profileImage }}" alt="Profile Image">
                                    <div class="name_job">
                                        <a href="{{ route('headmasters.edit-profile', ['headmaster' => $headmaster->id]) }}" class="name" style="background-color: transparent;">{{ auth()->user()->name }}</a>
                                        <div class="job">Headmaster</div>
                                    </div>
                                </div>
                            @endif
                        @endauth
                        <form action="/logout" method="POST">
                            @csrf
                            <button>
                                <i class="bx bx-log-out" id="log_out"></i>
                            </button>
                        </form>
                    </li>      
                    @elseif(auth()->user()->type === 'Parent')
                    <li>
                        @php
                            $parent = auth()->user()->parent;
                        @endphp
                
                        @if($parent->ICno === 'empty')
                            <a href="#" onclick="myFunction()"><i class='bx bx-file'></i><span class="links_name">Registration</span></a>
                            <span class="tooltip">New Registration</span>
                        @else
                            <a href="/students/registration"><i class='bx bx-file'></i><span class="links_name">Registration</span></a>
                            <span class="tooltip">New Registration</span>
                        @endif
                    </li>
                    @auth
                        @if(auth()->user()->parent && auth()->user()->parent->student)
                            @php
                                $student = auth()->user()->parent->student;
                                $payment = $student->payment;
                            @endphp
                
                            @if($student->Status === 'Pending' || $student->Status === 'Rejected')
                                <li>
                                    <a href="{{ route('students.approval', ['student' => $student->id]) }}">
                                        <i class="bx bx-check-circle"></i>
                                        <span class="links_name">Status</span>
                                    </a>
                                    <span class="tooltip">Application Status</span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('students.approval', ['student' => $student->id]) }}">
                                        <i class="bx bx-check-circle"></i>
                                        <span class="links_name">Status</span>
                                    </a>
                                    <span class="tooltip">Student Status</span>
                                </li>
                                <li>
                                    @if($student->RegistrastionFee === 'unpaid')
                                        <a href="#" onclick="showPaymentPopup()">
                                            <i class='bx bx-book-bookmark'></i>
                                            <span class="links_name">Learning Progress</span>
                                        </a>
                                        <span class="tooltip">Learning Progress</span>
                                    @else
                                        <a href="{{ route('students.view-learning-progress', ['student' => $student->id]) }}">
                                            <i class="bx bx-book-bookmark"></i>
                                            <span class="links_name">Learning Progress</span>
                                        </a>
                                        <span class="tooltip">Learning Progress</span>
                                    @endif
                                </li>
                                <li>
                                    <a href="{{ route('students.fee-payment', ['student' => $student->id]) }}">
                                        <i class="bx bx-cart"></i>
                                        <span class="links_name">Payment</span>
                                    </a>
                                    <span class="tooltip">Fee Payment</span>
                                </li>
                            @endif
                        @endif
                    @endauth 
                    <li class="profile">
                        @auth
                            @if(auth()->user()->parent()->exists())
                                @php
                                    $parent = auth()->user()->parent;
                                    $profileImage = $parent->ProfileImage ? asset('profileImages/' . $parent->ProfileImage) : asset('images/no-image.jpg');
                                @endphp
                                <div class="profile-details">
                                    <img src="{{ $profileImage }}" alt="Profile Image">
                                    <div class="name_job">
                                        <a href="{{ route('parents.edit-profile', ['parent' => $parent->id]) }}" class="name" style="background-color: transparent;">{{ auth()->user()->name }}</a>
                                        <div class="job">Parent</div>
                                    </div>
                                </div>
                            @endif
                        @endauth
                        <form action="/logout" method="POST">
                            @csrf
                            <button>
                                <i class="bx bx-log-out" id="log_out"></i>
                            </button>
                        </form>
                    </li>
                                                                
                @elseif(auth()->user()->type === 'Staff')
                    <li>
                        <a href="/students/list"><i class='bx bxs-graduation'></i><span class="links_name">Manage Students</span></a>
                        <span class="tooltip">Manage Students</span>
                    </li>
                    <li>
                        <a href="/students/approval"><i class='bx bx-select-multiple'></i><span class="links_name">Approval Application</span></a>
                        <span class="tooltip">Approval Application</span>
                    </li>
                    {{-- <li>
                        <a href="#"><i class='bx bx-cart-alt'></i><span class="links_name">Order</span></a>
                        <span class="tooltip">Order</span>
                    </li>
                    <li>
                        <a href="#"><i class='bx bx-cog'></i><span class="links_name">Setting</span></a>
                        <span class="tooltip">Setting</span>
                    </li> --}}
                    <li class="profile">
                        @auth
                            @if(auth()->user()->staff()->exists())
                                @php
                                    $staff = auth()->user()->staff;
                                    $profileImage = $staff->ProfileImage ? asset('profileImages/' . $staff->ProfileImage) : asset('images/no-image.jpg');
                                @endphp
                                <div class="profile-details">
                                    <img src="{{ $profileImage }}" alt="Profile Image">
                                    <div class="name_job">
                                        <a href="{{ route('staffs.edit-profile', ['staff' => $staff->id]) }}" class="name" style="background-color: transparent;">{{ auth()->user()->name }}</a>
                                        <div class="job">Staff</div>
                                    </div>
                                </div>
                            @endif
                        @endauth
                        <form action="/logout" method="POST">
                            @csrf
                            <button>
                                <i class="bx bx-log-out" id="log_out"></i>
                            </button>
                        </form>
                    </li>                                                                
                @endif
            @endauth
            
        </ul>
    </div>

    <section class="home-section">
        {{-- Main Content --}}
        <main>
            <div class="container">
                <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="absolute col-lg-10 offset-3 mt-4">
                    @include('flash-message')
                </div>
            </div>
            @yield('content')
        </main>
    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });

        searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search icon
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });

        // following are the code to change sidebar button(optional)
        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the icons class
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the icons class
            }
        }
    </script>
    <script>
        function myFunction() {
          alert("Please complete the user profile before create a new registration!");
        }
    </script>
    <script>
        function showPaymentPopup() {
          alert("Please complete the Registration Fee to get access this function!");
        }
    </script>
</body>
</html>
