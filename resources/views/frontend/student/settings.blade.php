@extends('frontend.student.studentmaster')
@section('title', 'Edit Resume')
@section('content')


    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card" style="background-color: #FFF;">
                        <div class="container">
                            <h1 style="color:black; font-weight:bolder;" class="p-3 mb-3 border-bottom border-secondary">Settings</h1>

                            <form class="form-horizontal" role="form" action="{{ route('student.changepassword') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">


                                    <!-- edit form column -->
                                    <div class="col-md-6 personal-info">

                             <h3 style="color:black; font-weight:bolder;" class="text-center">Change Password</h3>


                                        <div class="form-group">
                                            <label style="color:black;" class="col-md-12 control-label">Old Password:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="password" name="old_password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label style="color:black;" class="col-md-12 control-label">New Password:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="password" name="new_password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label style="color:black;" class="col-md-12 control-label">Confirm New Password:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="password" name="new_password_confirmation">
                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <label class="col-md-12 control-label"></label>
                                            <div class="col-md-12">
                                                <input type="submit" class="btn btn-primary" value="Save Changes">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
