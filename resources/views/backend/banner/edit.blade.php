@extends('backend.layouts.master')
@section('title', 'Banner Info')

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
                        <li class="breadcrumb-item active">Banner</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-banner">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <h4>
                                <i>
                                    Front Banner
                                </i>
                            </h4>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('admin.banner.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tittle</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="Seperate with comma(,) for style" name="title"
                                                value="{{ $banner->title ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter description" name="description"
                                                value="{{ $banner->description ?? '' }}">
                                        </div>
                                    </div>
                                </div>





                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image 1 <span style="color:black; color: #00000061; font-size: 12px;"> (406w x 316h)</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="image1"
                                                        id="exampleInputFile">
                                                </div>
                                            </div>
                                            @if (!empty($banner->image1))
                                                <img src="{{ asset($banner->image1) }}" height="100" width="200"
                                                    alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image 2 <span style="color:black; color: #00000061; font-size: 12px;"> (201w x 159h)</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="image2"
                                                        id="exampleInputFile">
                                                </div>
                                            </div>
                                            @if (!empty($banner->image2))
                                                <img src="{{ asset($banner->image2) }}" height="100" width="200"
                                                    alt="">
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Additional text</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Seperate with comma(,) for style" name="additional_text"
                                        value="{{ $banner->additional_text ?? '' }}">
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
