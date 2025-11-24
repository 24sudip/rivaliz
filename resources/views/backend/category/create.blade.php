@extends('backend.layouts.master')

@section('title', 'Create Written Category')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Written Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create Written Category</li>
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
                        <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        value="{{ old('name') }}" placeholder="Written category name" name="name">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputFile">Written Category Image(80x80)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image"
                                                id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                file</label>
                                        </div>
                                    </div>
                                </div>

                                <!--<div class="form-group">-->
                                <!--    <label for="exampleIconEmail1">Icon</label>-->
                                <!--    <input type="text" class="form-control" id="exampleIconEmail1"-->
                                <!--        value="{{ old('icon') }}" placeholder="Enter category icon" name="icon">-->
                                <!--</div>-->

                                <div class="form-group">
                                    <label for="exampleDescEmail1">Description</label>
                                    <textarea type="text" class="form-control" id="exampleDescEmail1" value="{{ old('description') }}"
                                        placeholder="Enter category description" name="description" rows="4"></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" name="front_page" id="front_page" value="1">
                                    <label for="front_page">Front</label>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" name="favourite" id="favourite" value="1">
                                    <label for="favourite">Favourite</label>
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
