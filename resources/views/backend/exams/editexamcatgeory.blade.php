@extends('backend.layouts.master')
@section('title', 'Edit Quiz Category')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Quiz Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Quiz Category</li>
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
                        <form action="{{ route('admin.courses.updateexamcatgeory', $category->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        value="{{ $category->name }}" name="name">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputFile">Quiz Category Image(80x80)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image"
                                                id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                file</label>
                                        </div>
                                    </div>
                                    @if (!empty($category->image))
                                        <img src="{{ asset($category->image) }}" height="100" width="200"
                                            alt="">
                                    @endif
                                </div>


                                {{-- <div class="form-group">
                                    <label for="exampleDesc">Description</label>
                                    <textarea type="text" class="form-control" id="exampleDesc" name="description" rows="4">{{ $category->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" name="front_page" id="front_page" value="1" {{ $category->front_page ? 'checked' : '' }}>
                                    <label for="front_page">Front</label>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" name="favourite" id="favourite" value="1" {{ $category->favourite ? 'checked' : '' }}>
                                    <label for="favourite">Favourite</label>
                                </div> --}}

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
