<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!--<a href="{{ route('admin.dashboard') }}" class="brand-link">-->
    <!--    <img src="{{ asset($site->logo ?? '') }}" alt="admin" class="brand-image  elevation-3" style="opacity: .8">-->
    <!--</a>-->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel  pb-3 mb-3 d-flex">
            <!--<div class="image">-->
            <!--    <img src="{{ asset(auth()->guard('admin')->user()->image) }}" class="img-circle elevation-2"-->
            <!--        alt="AI">-->
            <!--</div>-->
            <div class="profile-image">
    <img src="{{ asset(auth()->guard('admin')->user()->image) }}" alt="Profile" class="img-fluid rounded-circle shadow">
</div>
<style>
    .profile-image {
        width: 60px;
        height: 60px;
        overflow: hidden;
        border-radius: 50%;
        border: 2px solid #ddd;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

            <div style="padding-top:17px;" class="info">
                <a href="{{ route('admin.dashboard') }}" class="d-block">{{ auth()->guard('admin')->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                {{-- admin --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Admin
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.adminList') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Admin List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.createAdmin') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Create New Admin</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Packages
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.package.create') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.package.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.package-order.list') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Package Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.package-payment.list') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Package Payment</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Instructors
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.instructors.create') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.instructors.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.instructors.payrequest') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Pay Request</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- categories --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Written
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.category.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Written Category</p>
                            </a>
                        </li>
                        {{-- 'admin.subcategory.index' --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.written.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Written Manage</p>
                            </a>
                        </li>
                        <!--<li class="nav-item">-->
                        <!--    <a href="{{ route('admin.childcategory.index') }}" class="nav-link">-->
                        <!--        <i class="nav-icon far fa-circle text-danger"></i>-->
                        <!--        <p>Childcategory</p>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <!--<li class="nav-item">-->
                        <!--    <a href="{{ route('admin.childsubcategory.index') }}" class="nav-link">-->
                        <!--        <i class="nav-icon far fa-circle text-danger"></i>-->
                        <!--        <p>Childsubcategory</p>-->
                        <!--    </a>-->
                        <!--</li>-->
                    </ul>
                </li>
                {{-- courses --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Study Courses
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.courses.create') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>New Course</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.courses.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Manage Courses</p>
                            </a>
                        </li>

                        <!--<li class="nav-item">-->
                        <!--    <a href="{{ route('admin.livecourses.index') }}" class="nav-link">-->
                        <!--        <i class="nav-icon far fa-circle text-danger"></i>-->
                        <!--        <p>Live Courses</p>-->
                        <!--    </a>-->
                        <!--</li>-->

                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                        Students
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        {{-- <li class="nav-item">
                            <a href="{{route('admin.courses.freevideoscategory')}}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Videos Category</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">

                            <a href="{{route('admin.courses.students')}}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>All Students</p>
                            </a>
                        </li>
                    </ul>
                </li>

                  {{-- Exam --}}
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                          Quiz/Exam
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.courses.create') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>New Exam<p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.courses.examcatgeory') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Quiz Category</p>
                            </a>
                        </li>
                        <li class="nav-item">

                            <a href="{{ route('admin.courses.examsubcatgeory') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Quiz Subcategory</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.courses.exam') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Manage Quiz/Exam</p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.livecourses.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Live Courses</p>
                            </a>
                        </li> --}}

                    </ul>
                </li>

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                           Orders
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.courses.order') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>All orders</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <!--<li class="nav-item">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p class="text">-->
                <!--          Ebook Orders-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview nav-header">-->
                <!--        <li class="nav-item">-->
                <!--            <a href="{{ route('admin.courses.ebookorder') }}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>All orders</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->

                <!--<li class="nav-item {{-- menu-open --}}">-->
                <!--    <a href="#" class="nav-link {{-- active --}}">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p class="text">-->
                <!--            Live Classes-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview nav-header">-->
                <!--        <li class="nav-item {{-- menu-open --}}">-->
                <!--            <a href="{{ route('admin.liveclass.create') }}" class="nav-link {{-- active --}}">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>Schedule Class</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--        <li class="nav-item">-->
                <!--            <a href="{{ route('admin.liveclass.index') }}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>Manage Classes</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->

                <!--<li class="nav-item">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p class="text">-->
                <!--            Supports-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview nav-header">-->
                <!--        <li class="nav-item">-->
                <!--            <a href="{{ route('admin.supports') }}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>View</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->

                <!--<li class="nav-item">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p class="text">-->
                <!--            Ebook-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview nav-header">-->
                <!--        <li class="nav-item">-->
                <!--            <a href="{{ route('admin.ebook.index') }}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>All Ebooks</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->


                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                           Review
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.courses.review') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>All Reviews</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <!--<li class="nav-item">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p class="text">-->
                <!--          Free Videos-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview nav-header">-->
                <!--        <li class="nav-item">-->
                <!--            <a href="{{route('admin.courses.freevideoscategory')}}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>Videos Category</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--        <li class="nav-item">-->

                <!--            <a href="{{route('admin.courses.freevideos')}}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>All Free videos</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->

                <!-- {{--About --}}-->
                <!-- <li class="nav-item">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p class="text">-->
                <!--            About-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview nav-header">-->

                <!--        <li class="nav-item">-->

                <!--            <a href="{{route('admin.courses.about')}}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>All About</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li> -->

                <!-- {{--Together we --}}-->
                <!-- <li class="nav-item">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p class="text">-->
                <!--            Together we-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview nav-header">-->

                <!--        <li class="nav-item">-->

                <!--            <a href="{{route('admin.courses.together')}}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>All Together</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->

                <!--{{--Student Teacjer Content--}}-->
                <!--<li class="nav-item">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p class="text">-->
                <!--            Student Teacher Content-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview nav-header">-->

                <!--        <li class="nav-item">-->

                <!--            <a href="{{route('admin.courses.content')}}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>All  Content</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->
                <!--{{-- Testimonial --}}-->
                <!--<li class="nav-item">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p class="text">-->
                <!--            Testimonial-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview nav-header">-->

                <!--        <li class="nav-item">-->

                <!--            <a href="{{route('admin.courses.testimonials')}}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>All Testimonial</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->

                <!-- {{-- Services --}}-->
                <!-- <li class="nav-item">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p class="text">-->
                <!--          Services-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview nav-header">-->

                <!--        <li class="nav-item">-->

                <!--            <a href="{{route('admin.courses.services')}}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>All  Services</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->
                <!-- {{-- Why Learn --}}-->
                <!-- <li class="nav-item">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p class="text">-->
                <!--            Why Learn-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview nav-header">-->

                <!--        <li class="nav-item">-->

                <!--            <a href="{{route('admin.courses.whylearn')}}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>Why Learn</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->



                <!--<li class="nav-item">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p class="text">-->
                <!--          Supporter-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview nav-header">-->
                <!--        <li class="nav-item">-->
                <!--            <a href="{{ route('admin.courses.supportercreate') }}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>New Supporter</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--        <li class="nav-item">-->
                <!--            <a href="{{ route('admin.courses.supporter') }}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>All Supporter</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>  -->

                <!--<li class="nav-item">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p class="text">-->
                <!--            Podcast-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--     <ul class="nav nav-treeview nav-header">-->
                <!--        <li class="nav-item">-->
                <!--            <a href="{{ route('admin.podcastcategory.index') }}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p> Podcasts Category</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--    <ul class="nav nav-treeview nav-header">-->
                <!--        <li class="nav-item">-->
                <!--            <a href="{{ route('admin.podcast.index') }}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>All Podcasts</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Notice
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.events.create') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>New Notice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.events.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Manage Notice</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Notices
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.notice.create') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>New Notice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.notice.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Manage Notices</p>
                            </a>
                        </li>

                    </ul>
                </li> --}}

               {{--<li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Blogs
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.blogs.create') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>New Blog</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.blogs.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Manage Blogs</p>
                            </a>
                        </li>

                    </ul>
                </li> --}}


                <!--<li class="nav-item">-->
                <!--    <a href="{{ route('admin.coupons.index') }}" class="nav-link">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p>-->
                <!--            Coupon-->
                <!--        </p>-->
                <!--    </a>-->
                <!--</li>-->


                {{-- affiliate --}}
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Affiliate
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.affiliate.affiliateList') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- Advertisements --}}
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Advertisements
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.ads.categories') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Ad Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ads.manage') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Manage Ads</p>
                            </a>
                        </li>
                    </ul>
                </li>
                --}}

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Tutorial
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.promovideo.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Videos</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.studentbenefit.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Student benefits</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>


                {{-- site info --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Site Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.showSiteInfo') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Site Information</p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.banner.edit') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Front Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.page.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Pages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.sliders.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Slider Images</p>
                            </a>
                        </li> --}}

                        <!--<li class="nav-item">-->
                        <!--    <a href="{{ route('admin.about-tab.index') }}" class="nav-link">-->
                        <!--        <i class="nav-icon far fa-circle text-danger"></i>-->
                        <!--        <p>About Tab</p>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <!--<li class="nav-item">-->
                        <!--    <a href="{{ route('admin.about-item.index') }}" class="nav-link">-->
                        <!--        <i class="nav-icon far fa-circle text-danger"></i>-->
                        <!--        <p>About Item All</p>-->
                        <!--    </a>-->
                        <!--</li>-->
                    </ul>
                </li>

                <!--<li class="nav-item">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon far fa-circle text-warning"></i>-->
                <!--        <p class="text">-->
                <!--            Contact Info-->
                <!--            <i class="fas fa-angle-left right"></i>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--    <ul class="nav nav-treeview nav-header">-->
                <!--        <li class="nav-item">-->
                <!--            <a href="{{ route('admin.contact.index') }}" class="nav-link">-->
                <!--                <i class="nav-icon far fa-circle text-danger"></i>-->
                <!--                <p>All Contact Info</p>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
