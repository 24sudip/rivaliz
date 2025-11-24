@extends('backend.layouts.master')
@section('title', 'Edit Ads')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Ads</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Ads</li>
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
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.ads.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="hidden_id" value="{{ $ad->id }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        value="{{ $ad->title }}" placeholder="Enter ad title" name="title">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ad Category</label>
                                    <select class="form-control" id="exampleInputEmail1" name="adcategory_id">
                                        <option value="">Select</option>
                                        @foreach ($adcategories as $category)
                                            <option value="{{ $category->id }}"
                                                @if ($ad->adcategory_id == $category->id) selected @endif>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputFile">Ads Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image"
                                                id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                file</label>

                                        </div>
                                    </div>
                                    <img src="{{ asset($ad->image) }}" height="100" width="100">
                                </div>

                                <div class="form-group">
                                    <label for="exampleIconEmail1">Link</label>
                                    <input type="text" class="form-control" id="exampleIconEmail1"
                                        value="{{ $ad->link }}" placeholder="Enter ad link" name="link">
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
