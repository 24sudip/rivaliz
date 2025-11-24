@extends('backend.layouts.master')
@section('title', 'Company Info')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Website Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Company</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-info">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <h4>
                                <i>
                                    General Information
                                </i>
                            </h4>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('admin.storeSiteGeneralInfo') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Site Name</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter site name" name="name"
                                                value="{{ $info->name ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter email" name="email" value="{{ $info->email ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">About (in a nutshell)</label>
                                            <textarea name="about" class="form-control" rows="3" placeholder="Enter about">{{ $info->about ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address</label>
                                            <textarea name="address" class="form-control" rows="3" placeholder="Enter address">{{ $info->address ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone One</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter phone one" name="phone_one"
                                                value="{{ $info->phone_one ?? '' }}">
                                        </div>
                                    </div>
                                    <!--<div class="col-md-4">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label for="exampleInputEmail1">Phone Two</label>-->
                                    <!--        <input type="text" class="form-control" id="exampleInputEmail1"-->
                                    <!--            placeholder="Enter phone two" name="phone_two"-->
                                    <!--            value="{{ $info->phone_two ?? '' }}">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-4">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label for="exampleInputEmail1">Phone Three</label>-->
                                    <!--        <input type="text" class="form-control" id="exampleInputEmail1"-->
                                    <!--            placeholder="Enter phone three" name="phone_three"-->
                                    <!--            value="{{ $info->phone_three ?? '' }}">-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                </div>



                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Company Logo <span style="color:black; color: #00000061; font-size: 12px;"> (166w x 40h)</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="logo"
                                                        id="exampleInputFile">
                                                </div>
                                            </div>
                                            @if (!empty($info->logo))
                                                <img src="{{ asset($info->logo) }}" height="100" width="200"
                                                    alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Company favicon <span style="color:black; color: #00000061; font-size: 12px;"> (50w x 50h)</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="favicon"
                                                        id="exampleInputFile">
                                                </div>
                                            </div>
                                            @if (!empty($info->favicon))
                                                <img src="{{ asset($info->favicon) }}" height="100" width="200"
                                                    alt="">
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputFile">App Logo</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="app_logo"
                                                        id="exampleInputFile">
                                                </div>
                                            </div>
                                            @if (!empty($info->app_logo))
                                                <img src="{{ asset($info->app_logo) }}" height="100" width="200"
                                                    alt="">
                                            @endif
                                        </div>
                                    </div> --}}
                                </div>
                                
                                <div class="form-group">
                                    <label for="footer_text">Footer Text</label>
                                    <textarea name="footer_text" id="footer_text" class="form-control" rows="3" placeholder="Enter footer text">{{ $info->footer_text ?? '' }}</textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">App Link</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter App Link" name="app_link"
                                        value="{{ $info->app_link ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Facebook</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter facebook" name="facebook"
                                        value="{{ $info->facebook ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Twitter</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter twitter" name="twitter" value="{{ $info->twitter ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Instagram</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter instagram" name="instagram"
                                        value="{{ $info->instagram ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Youtube</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter youtube" name="youtube" value="{{ $info->youtube ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">LinkedIn</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter linkedin" name="linkedin"
                                        value="{{ $info->linkedin ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pinterest</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter pinterest" name="pinterest"
                                        value="{{ $info->pinterest ?? '' }}">
                                </div>
                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
