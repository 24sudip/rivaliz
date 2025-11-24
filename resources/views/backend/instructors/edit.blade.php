@extends('backend.layouts.master')
@section('title', 'Edit Instructor')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Instructor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Instructor</li>
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
                        <form action="{{ route('admin.instructors.update', $instructor) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleName">Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleName"
                                            value="{{ $instructor->name }}" placeholder="Instructor name" name="name">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleEmail">E-Mail<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="exampleEmail"
                                            value="{{ $instructor->email }}" placeholder="Enter email" name="email">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="examplePhone">Phone<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="examplePhone"
                                            value="{{ $instructor->phone }}" placeholder="Enter phone" name="phone">
                                    </div>

                                    {{-- <div class="form-group col-6">
                                        <label for="examplePass">Password<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="examplePass"
                                            placeholder="Enter password"
                                            name="password">
                                    </div> --}}

                                    <div class="form-group col-6">
                                        <label for="">Gender<span class="text-danger">*</span></label>
                                        <select class="form-control" name="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="">Date of birth<span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" name="dob"
                                                value="{{ $instructor->dob }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="">Profession<span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Profession"
                                                name="profession" required value="{{ $instructor->profession }}">
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="">Institution<span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="institution"
                                                placeholder="Institution" value="{{ $instructor->institution }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="">Department<span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Department"
                                                name="department" value="{{ $instructor->department }}" required>
                                        </div>
                                    </div>


                                    <div class="form-group col-6">
                                        <label for="exampleInputFile">Instructor Image</label>
                                        <div class="input-group">
                                            
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image"
                                                    id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file
                                                </label>
                                                    
                                            </div>
                                        </div>
                                        <img class="img-fluid" src="{{ asset($instructor->image) }}" alt="" width="60">
                                    </div>


                                    <div class="form-group col-6">
                                        <label for="exampleDescEmail1">Address</label>
                                        <textarea type="text" class="form-control" id="exampleDescEmail1" placeholder="Enter address" name="address"
                                            rows="4">{{ $instructor->address }}</textarea>
                                    </div>

                                </div>

                            </div>

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
