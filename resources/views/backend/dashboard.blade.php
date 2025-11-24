@extends('backend.layouts.master')
@section('title', 'dashboard')

@section('backend')
    
    <link rel="stylesheet" type="text/css"
        href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <div class="grey-bg container">
        <section id="minimal-statistics">
            <div class="row">
                <div class="col-12 mt-3 mb-1">
                    <h4 class="text-uppercase">Dashboard</h4>
                    <p></p>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="icon-pencil primary font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{ $data["total_course"] }}</h3>
                                        <span>Total Course</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.courses.index') }}" class="stretched-link"></a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                  <a href="{{route('admin.courses.students')}}">
                        <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="icon-user warning font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3 style="color:black;">{{ $data["total_student"] }}</h3>
                                        <span style="color:black;">Total Students</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="icon-graph success font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{ $data["course_sold"] }}</h3>
                                        <span>Course Sold</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="icon-wallet danger font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{ $data["course_revenue"] }}</h3>
                                        <span> Revenue</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                  <a href="{{ route('admin.instructors.index') }}">
                        <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 style="color:black;" class="danger">{{ $data["total_instructor"] }}</h3>
                                        <span style="color:black;">Total Instructors</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-speech danger font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </a>
                </div>
              {{--  <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="success">{{ $data["commision_paid"] }}</h3>
                                        <span>Commision Paid</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-rocket success font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="warning">{{ $data["commision_due"] }}</h3>
                                        <span>Commision Due</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-direction warning font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="primary">{{ $data["pay_request"] }}</h3>
                                        <span>Pay Request</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-pie-chart primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.instructors.payrequest') }}" class="stretched-link"></a>
                    </div>
                </div> --}}
            </div>

        </section>

    </div>

@endsection
