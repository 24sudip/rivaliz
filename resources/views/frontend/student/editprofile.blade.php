@extends('frontend.student.studentmaster')
@section('title', 'Edit Profile')
@section('content')


    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card" style="background-color: #F6F6F6;">
                        <div class="container">
                            <h1 class="p-3 mb-3 border-bottom border-secondary">Edit Profile</h1>

                            <form class="form-horizontal" role="form" action="{{ route('student.profileupdate') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-between">
                                    <!-- left column -->
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <img src="{{ asset($profile->image ?? 'https://png.pngitem.com/pimgs/s/150-1503945_transparent-user-png-default-user-image-png-png.png') }}"
                                                class="avatar img-circle img-fluid" alt="profile image">
                                            <h6>&nbsp;</h6>

                                            <input type="file" class="form-control bg-white" name="image">
                                        </div>
                                    </div>

                                    <!-- edit form column -->
                                    <div class="col-md-7 personal-info">

                                        <h3>Personal info</h3>


                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Name:</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" name="name"
                                                    value="{{ $profile->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Email:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="email"
                                                    value="{{ $profile->email }}">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Phone:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="phone"
                                                    value="{{ $profile->phone }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Address:</label>
                                            <div class="col-lg-8">
                                                <textarea class="form-control" type="text" name="address">{{ $profile->address }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Gender:</label>
                                            <div class="col-lg-8">
                                                <input type="radio" id="male" name="gender" value="Male"
                                                    @if ($profile->gender == 'Male') checked @endif>
                                                <label for="male">Male</label>
                                                <input type="radio" id="female" name="gender" value="Female"
                                                    @if ($profile->gender == 'Female') checked @endif>
                                                <label for="female">Female</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Religion:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="religion"
                                                    value="{{ $profile->religion }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Blood:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="blood"
                                                    value="{{ $profile->blood }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-8">
                                                <input type="submit" class="btn btn-primary" value="Save Changes">
                                                <span></span>
                                                <input type="reset" class="btn btn-default" value="Cancel">
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
