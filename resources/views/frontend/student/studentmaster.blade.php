@include('frontend.inc.header')


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.bootstrapdash.com/kapella-free/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Apr 2024 08:32:27 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title') | Learnengwithshahan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Site Icon -->
    <link rel="shortcut icon" href="{{ asset($company->favicon) }}" type="image/x-icon">
    
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('/frontend/student/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/student/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('/frontend/student/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('/frontend/css/fontAwesome5Pro.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('/frontend/student/images/favicon.png') }}" />

 
        

        
        <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="../../../assets/frontend/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../../assets/frontend/css/slick.css">
        <link rel="stylesheet" href="../../../assets/frontend/css/colorfulTab.min.css">
        <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
        <link rel="stylesheet" href="../../../assets/frontend/css/all.min.css">
        <link rel="stylesheet" href="../../../assets/frontend/css/animate.css">
        <link rel="stylesheet" href="../../../assets/frontend/css/venobox.css">
        <link rel="stylesheet" href="../../../assets/frontend/css/style.css">
        <link rel="stylesheet" href="../../../assets/frontend/css/responsive.css">
        {{-- Toastr css --}}
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
   
    
</head>

<style>
    .bn-font{
        font-family: banglafont;
    }
 .tabs a.active {
	color: #fff;
	background-color: #2B70B7;
	border-radius: 5px;
	width: 25%;
	 height: ; 
	line-height: 7px;
}

.tabs a{
    width:25%;
}


.menu-title{
    font-size:18px;
}

.nav-item a{
    display:flex;
    align-items:center;
}

</style>


<body class="bn-font">

    <!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
        <nav class="navbar top-navbar col-lg-12 col-12 p-0">
            <div class="container-fluid">
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                    <ul class="navbar-nav navbar-nav-left">
                         <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                        <a class="navbar-brand brand-logo" href="/"><img src="{{ asset($company->logo) }}"
                                alt="logo" style="height: 45px;" /></a>
                        <a  class="navbar-brand brand-logo-mini" href="/"><img style="width: 180px; height: 30px;"
                                src="{{ asset($company->logo) }}" alt="logo" /></a>
                    </div>

                    </ul>
                   
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown  d-lg-flex d-none">
                            <a href="/?#courses" style="background-color: #2B70B75C !important;" class="btn btn-inverse-primary btn-sm">Explore More Courses
                            </a>
                        </li>

                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                id="profileDropdown">
                                <span class="nav-profile-name">{{ auth()->guard('student')->user()->name }}</span>
                                <span class="online-status"></span>
                                
                                <!--<img src="{{ asset(auth()->guard('student')->user()->image) }}" alt="" />-->
      <img 
    src="{{ auth()->guard('student')->user()->image ? asset(auth()->guard('student')->user()->image) : 'https://learnengwithshahan.com/images/site/WhatsApp Image 2025-04-21 at 6.23.46 PM.jpeg' }}" 
    alt="Student Avatar" 
/>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('student.profile') }}">
                                    <i class="mdi mdi-account text-primary"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="/student/settings">
                                    <i class="mdi mdi-settings text-primary"></i>
                                    Password Change
                                </a>
                                <a class="dropdown-item" href="{{ route('student.logout') }}">
                                    <i class="mdi mdi-logout text-primary"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-none align-self-center" type="button"
                        data-toggle="horizontal-menu-toggle">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </div>
        </nav>
        <nav class="bottom-navbar">
            <div class="container">
                <ul class="nav page-navigation">

                    <li></li>
                    
                    <li class="nav-item">
                        <a href="/student/enrolled/courses" class="nav-link iconnn">
                            <i class="mdi mdi-cube-outline menu-icon"></i>
                            <span class="menu-title">My Courses</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/student/enrolled/ebooks" class="nav-link iconnn">
                            <i class="mdi mdi-cube-outline menu-icon"></i>
                            <span class="menu-title">My Ebooks</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/student/enrolled/instructors" class="nav-link iconnn">
                            <i class="mdi mdi-chart-areaspline menu-icon"></i>
                            <span class="menu-title">Instructor List</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>

                    {{-- <li class="nav-item">
                        <a href="/student/enrolled/live-classes" class="nav-link iconnn">
                            <i class="mdi mdi-codepen menu-icon"></i>
                            <span class="menu-title">Live Class</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li> --}}
                    
                    <li class="nav-item">
                        <a class="nav-link iconnn" href="/student/dashboard">
                            <i class="mdi mdi-file-document-box menu-icon"></i>
                            <span class="menu-title">Learning Report </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/student/quiz/grades" class="nav-link">
                            <i class="mdi mdi-finance menu-icon"></i>
                            <span class="menu-title">Grades</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/student/quiz/exams" class="nav-link">
                            <i class="mdi mdi-cube-outline menu-icon"></i>
                            <span class="menu-title">Exam</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="/student/settings" class="nav-link">
                            <i class=" mdi mdi-lock-reset menu-icon"></i>
                            <span class="menu-title">Change Password</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/student/profile" class="nav-link">
                            <i class="fa fa-user me-2 menu-icon"></i>
                            <span class="menu-title">Profile</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.logout') }}" class="nav-link">
                            <i class="mdi mdi-logout  menu-icon"></i>
                            <span class="menu-title">Logout</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                 
                    <!--<li class="nav-item">-->
                    <!--    <a href="#" class="nav-link">-->
                    <!--        <i class=" mdi mdi-monitor-cellphone menu-icon"></i>-->
                    <!--        <span class="menu-title">ডিভাইস ম্যানেজার</span>-->
                    <!--        <i class="menu-arrow"></i>-->
                    <!--    </a>-->
                    <!--</li>-->


                    <li></li>
                </ul>
            </div>
        </nav>
    </div>
    
    <div class="tabs mobile-nav d-block d-md-none">
       <div role="tablist" aria-label="Navigation" class="shadow-lg">
            
            <a class="flex-column" href="/student/enrolled/courses" role="tab" aria-selected="false" id="likes">
              <i class="mdi mdi-cube-outline menu-icon"></i>
                <span class="label"></span>
            </a>
            <a class="flex-column" href="/student/dashboard" role="tab" aria-selected="false" id="search">
                <!--<i class="mdi mdi-file-document-box menu-icon text-facebook"></i>-->
                <i class="mdi mdi-file-document-box menu-icon"></i>
                <span class="label"></span>
            </a>
            <a class="flex-column" href="/student/quiz/grades" role="tab" aria-selected="false" id="profile">
               <i class="mdi mdi-finance menu-icon"></i>
                <span class="label"></span>
            </a>
            
            <a class="flex-column" data-bs-toggle="offcanvas" href="#mobileMenuCanvas" role="button" aria-controls="mobileMenuCanvas">
                <i class="fa-solid fa-bars"></i>
                   <!--<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 25 25"><path stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.5 7.15c0-2.625.028-3.5 3.5-3.5s3.5.875 3.5 3.5.011 3.5-3.5 3.5-3.5-.875-3.5-3.5zM14.5 7.15c0-2.625.028-3.5 3.5-3.5s3.5.875 3.5 3.5.011 3.5-3.5 3.5-3.5-.875-3.5-3.5zM3.5 18.15c0-2.625.028-3.5 3.5-3.5s3.5.875 3.5 3.5c0 2.626.011 3.5-3.5 3.5s-3.5-.874-3.5-3.5zM14.5 18.15c0-2.625.028-3.5 3.5-3.5s3.5.875 3.5 3.5c0 2.626.011 3.5-3.5 3.5s-3.5-.874-3.5-3.5z" clip-rule="evenodd"></path></svg>-->
                   <span class="label"></span>
            </a>
       </div>
       
    </div>
    
    <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenuCanvas" aria-labelledby="mobilemenuCanvasLabel" data-bs-scroll="false">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobilemenuCanvasLabel">LearnEng with Shahan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
            <ul class="mobile-menu">
    <li class="nav-item {{ request()->is('student/enrolled/courses') ? 'active' : '' }}">
        <a href="/student/enrolled/courses" class="nav-link iconnn">
            <i class="mdi mdi-cube-outline menu-icon"></i>
            <span class="menu-title">My courses</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('student/enrolled/instructors') ? 'active' : '' }}">
        <a href="/student/enrolled/instructors" class="nav-link iconnn">
            <i class="mdi mdi-chart-areaspline menu-icon"></i>
            <span class="menu-title">Instructor list</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('student/enrolled/live-classes') ? 'active' : '' }}">
        <a href="/student/enrolled/live-classes" class="nav-link iconnn">
            <i class="mdi mdi-codepen menu-icon"></i>
            <span class="menu-title">Live Class</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('student/dashboard') ? 'active' : '' }}">
        <a class="nav-link iconnn" href="/student/dashboard">
            <i class="mdi mdi-file-document-box menu-icon"></i>
            <span class="menu-title">Learning Report</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('student/quiz/grades') ? 'active' : '' }}">
        <a href="/student/quiz/grades" class="nav-link">
            <i class="mdi mdi-finance menu-icon"></i>
            <span class="menu-title">Grades</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('student.profile') ? 'active' : '' }}">
        <a href="{{ route('student.profile') }}" class="nav-link">
            <i class="mdi mdi-account menu-icon"></i>
            <span class="menu-title">Profile</span>
        </a>
    </li>
    <!--<li class="nav-item {{ request()->is('student/settings') ? 'active' : '' }}">-->
    <!--    <a href="/student/settings" class="nav-link">-->
    <!--        <i class="mdi mdi-settings menu-icon"></i>-->
    <!--        <span class="menu-title">Settings</span>-->
    <!--    </a>-->
    <!--</li>-->
    <li class="nav-item {{ request()->is('student/settings') ? 'active' : '' }}">
        <a href="/student/settings" class="nav-link">
            <i class=" mdi mdi-lock-reset menu-icon"></i>
            <span class="menu-title">Password Change</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('student.logout') ? 'active' : '' }}">
        <a href="{{ route('student.logout') }}" class="nav-link">
            <i class="mdi mdi-logout menu-icon"></i>
            <span class="menu-title">Logout</span>
        </a>
    </li>
</ul>

      </div>
    </div>
    

    @if (session('error'))
        <div id="error-alert" class="alert alert-danger position-fixed alert-dismissible floating-alert m-3"
            style="right: 10px; z-index: 999;">
            {{ session('error') }}
        </div>
        <script>
            setTimeout(function() {
                $('#error-alert').fadeOut('slow');
            }, 5000); // 5000 milliseconds = 5 seconds (adjust as needed)
        </script>
    @endif

    @if (session('success'))
        <div id="success-alert" class="alert alert-success position-fixed alert-dismissible floating-alert m-3"
            style="right: 10px; z-index: 999;">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                $('#success-alert').fadeOut('slow');
            }, 5000);
        </script>
    @endif

    @if (session('warning'))
        <div id="warning-alert" class="alert alert-warning position-fixed alert-dismissible floating-alert m-3"
            style="right: 10px; z-index: 999;">
            {{ session('warning') }}
        </div>
        <script>
            setTimeout(function() {
                $('#warning-alert').fadeOut('slow');
            }, 5000);
        </script>
    @endif
   

    <!-- partial -->
    @yield('content')
    @include('frontend.inc.footer')
     <!--footer-->
    {{-- <footer>
        <div style="background-color:#f7f7f7; margin-top:20px" class="footer__area footer-bg">
            <div class="footer__top pt-40 pb-40">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="footer__widget ">
                                <div class="footer__widget-head mb-22">
                                    <div class="footer__logo text-center">
                                        <a href="/">
                                            <!--<img src="{{ asset('frontend') }}/img/easy-learn-Campus-3.png" class="w-100" class="img-fluid" alt="">-->
                                            <img src="{{ asset($company->logo) }}" class="img-fluid" alt="" style="width: 86%;">
                                        </a>
                                    </div>
                                </div>
                                <div class="footer__widget-body">
                                    <p class="bn-normal" style="font-weight: 700; color: #00000096 !important; font-size: 18px !important;"><small>{{ $company->footer_text }}</small></p>
                                    <!--<img src="{{ asset('assets/frontend/img/uploads/googlePlay.svg') }}" />-->               
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 offset-xxl-1 col-12 col-xl-2 offset-xl-1 col-lg-3 col-6 offset-lg-0 col-md-2 offset-md-1 col-sm-5 offset-sm-1">
                            <div class="footer__widget mb-50">
                                <div class="footer__widget-head mb-22">
                                    <!--<h3 class="footer__widget-title bn-normal">কম্পানি</h3>-->
                                </div>
                              <div class="footer__widget-body">
                                    <div class="footer__link">
                                        <h4 class="bn-font" >Quick Links</h4>
                                        <ul>
                                            
                                            <li class="bn-font"><a href=""><i style="font-size:10px;" class="fa-solid fa-angle-right"></i> About</a></li>
                                            <li class="bn-font"><a href=""><i style="font-size:10px;" class="fa-solid fa-angle-right"></i> Course</a> </l> 
                                         
                                
                                            <li class="bn-font"><a href="{{ route('যোগাযোগ') }}"><i style="font-size:10px;" class="fa-solid fa-angle-right"></i> Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-6 col-12 offset-lg-0 col-md-3 offset-md-1 col-sm-6">
                            <div class="footer__widget mb-50">
                                <div class="footer__widget-head mb-22">
                                    <!--<h3 style= class="footer__widget-title bn-normal">গুরুত্বপূর্ণ লিঙ্কস</h3>-->
                                </div>
                                <div class="footer__widget-body">
                                    <div class="footer__link">
                                        <ul>
                                            <!--<li><a href="#certificateModal" data-toggle="modal" data-target="#certificateModal">-->
                                            <!--    সার্টিফিকেট-->
                                            <!--</a></li>-->
                                            <li>
                                            <form action="{{ route('checkCertificate') }}" method="POST">
                                                @csrf
                                                  <div class="form-group">
                                                    <h4 id="emailHelp" class="form-text text-muted bn-font quicktech-footer-size"> Check  Certificate   </h4>
                                                    <input type="text" class="form-control inmob my-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Certificate No." name="certificateNo" required>
                                                  </div>
                                                  <button type="submit" class="btn bn-font inmoc btn-sm btn-outline-secondary col-12">Check</button>
                                            </form>
                                            </li>
                                            <!--<li><a href="#">পার্টনার্স</a></li>-->

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-sm-6">
                            <div class="footer__widget footer__pl-70 mb-50">
                                <div class="footer__widget-head mb-22">
                                    <!--<h3 style="color:Black; text-align:center;" class="footer__widget-title bn-font">যোগাযোগঃ</h3>-->
                                </div>
                            <div class="footer__widget-body">
                                <div class="footer__subscribe">
                                    <h4 class="bn-font quicktech-footer-size" style="color:black; font-weight:bolder;">Contact</h4>
                                    <p class="bn-font" style="font-size: 14px; font-weight:600; color: #0000009e !important;">
                                       <i class="fa-solid fa-phone"></i> Hotline: <span style="color: #2B70B7;">{{ $company->phone_one }}</span><br>
                                    
                                     <i class="fa-solid fa-envelope"></i>  Email: <span>{{ $company->email }}</span>
                                    </p>
                                    <div class="footer__social">
                                        <ul style="list-style: none; padding: 0; display: flex; gap: 10px; justify-content: center;">
                                            <li><a href="{{ $company->facebook }}" style="background: transparent !important; border-radius: 5px; font-size: 24px; padding: 5px; color: black; line-height: 30px;">
                                                <i class="fab fa-facebook"></i></a></li>
                                            <li><a href="{{ $company->twitter }}" style="background: transparent !important; border-radius: 5px; font-size: 24px; padding: 5px; color: black; line-height: 30px;">
                                                <i class="fab fa-twitter"></i></a></li>
                                            <li><a href="{{ $company->instagram }}" style="background: transparent !important; border-radius: 5px; font-size: 24px; padding: 5px; color: black; line-height: 30px;">
                                                <i class="fab fa-instagram"></i></a></li>
                                                 <li><a href="#" style="background: transparent !important; border-radius: 5px; font-size: 24px; padding: 5px; color: black; line-height: 30px;">
                                                <i class="fa-brands fa-youtube"></i></a></li>
                                                <li><a href="#" style="background: transparent !important; border-radius: 5px; font-size: 24px; padding: 5px; color: black; line-height: 30px;">
                                                <i class="fa-brands fa-linkedin"></i></a></li>
                                                
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="footer__copyright text-center">
                                <p> Copyright © 2025 | Doctor Porfolio | All rights reserved | Design & Developed by
 <a href="https://quicktech-ltd.com/">QuickTech IT</a></p>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>   --}}
    <!--footer-->
    <!-- page-body-wrapper ends -->
    <!--<footer class="footer">-->
    <!--    <div class="footer-wrap">-->
    <!--        <div class="d-sm-flex justify-content-center justify-content-sm-between">-->
    <!--            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a-->
    <!--                    href="/" target="_blank">Doctors Portal-->
    <!--                </a>2025</span>-->
    <!--            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Developed by <a-->
    <!--                    href="https://quicktech-ltd.com/" target="_blank"> QuickTech IT </a>-->
    <!--            </span>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</footer>-->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="{{ asset('/frontend/student/vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('/frontend/student/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="{{ asset('/frontend/student/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/frontend/student/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('/frontend/student/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
    <script src="{{ asset('/frontend/student/vendors/justgage/raphael-2.1.4.min.js') }}"></script>
    <script src="{{ asset('/frontend/student/vendors/justgage/justgage.js') }}"></script>
    <script src="{{ asset('/frontend/student/js/jquery.cookie.js" type="text/javascript') }}"></script>
    <!-- Custom js for this page-->
    <script src="{{ asset('/frontend/student/js/dashboard.js') }}"></script>
    <!-- End custom js for this page-->
    
    <script>
        document.querySelectorAll('.mobile-menu .nav-link').forEach(link => {
    if (link.href === window.location.href) {
        link.parentElement.classList.add('active');
    }
});

    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll(".tabs a");

    // Add a click event listener to all the links
    links.forEach(link => {
        link.addEventListener("click", function () {
            // Remove the 'active' class and set aria-selected to false for all links
            links.forEach(item => {
                item.classList.remove("active");
                item.setAttribute("aria-selected", "false");
            });

            // Add the 'active' class and set aria-selected to true for the clicked link
            this.classList.add("active");
            this.setAttribute("aria-selected", "true");
        });
    });

    // Optionally, you can add logic to set the active tab based on the current page URL
    const currentPath = window.location.pathname;
    links.forEach(link => {
        if (link.getAttribute("href") === currentPath) {
            link.classList.add("active");
            link.setAttribute("aria-selected", "true");
        }
    });
});

    </script>
    
</body>

<!-- Mirrored from demo.bootstrapdash.com/kapella-free/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Apr 2024 08:32:37 GMT -->

</html>
