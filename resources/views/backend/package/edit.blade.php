<!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
@extends('backend.layouts.master')

@section('title', 'Create Package')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Package</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Package</li>
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
                        <form action="{{ route('admin.package.update', $package) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title"
                                    value="{{ old('title', $package->title) }}" placeholder="Enter title" name="title">
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="checkDefault" name="status" @if ($package->status == 1) checked @endif>
                                        <label class="form-check-label" for="checkDefault">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price"
                                        value="{{ old('price', $package->price) }}" placeholder="Enter price" name="price">
                                </div>
                                <div class="form-group">
                                    <label for="duration_month">Duration (Month)</label>
                                    <input type="number" class="form-control" id="duration_month"
                                        value="{{ old('duration_month', $package->duration_month) }}" placeholder="Enter Duration Month" name="duration_month">
                                </div>
                                <div class="form-group">
                                    <label for="short_description">Short Description<span class="text-danger">*</span></label>
                                    <textarea placeholder="short Description" name="short_description" class="form-control" id="summernote" rows="10">{{ old('short_description', $package->short_description) }}</textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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

