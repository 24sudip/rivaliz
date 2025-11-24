<!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
@extends('backend.layouts.master')
@section('title', 'Create Ebook')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Ebook</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.ebook.index') }}">Back</a></li>
                        <li class="breadcrumb-item active">Create Ebook</li>
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
                        <form action="{{ route('admin.ebook.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" class="form-control" id="photo" value="{{ old('photo') }}"
                                    placeholder="Enter Photo" name="photo">
                                </div>
                                <div class="form-group">
                                    <label for="pdf">PDF File</label>
                                    <input type="file" class="form-control" id="pdf" name="pdf" accept=".pdf">
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" value="{{ old('title') }}"
                                    placeholder="Enter Title" name="title">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" rows="3" placeholder="Enter Description"
                                    name="description">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" value="{{ old('price') }}"
                                    placeholder="Enter Price" name="price">
                                </div>
                                <div class="form-group">
                                    <label for="buy">Buying Status</label>
                                    <select class="form-control" id="buy" value="{{ old('buy') }}" name="buy">
                                        <option value="">Select A Status</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Free">Free</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select class="form-control" id="level" value="{{ old('level') }}" name="level">
                                        <option value="">Select A Level</option>
                                        <option value="Beginner">Beginner</option>
                                        <option value="Advanced">Advanced</option>
                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
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

