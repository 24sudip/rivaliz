@extends('backend.layouts.master')
@section('title', 'Courses')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lessons of <strong>{{ $module->name }}</strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Courses</li>
                        <li class="breadcrumb-item">Modules</li>
                        <li class="breadcrumb-item active">Lessons</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('admin.courses.modules', $module->course_id) }}" class="btn btn-outline-info btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                                <div>
                                    <a href="{{ route('admin.courses.module.lessonadd', $module->id) }}" class="btn btn-outline-primary"><i class="fa fa-plus"></i> Add Lessons</a>
                                </div>
                            </div>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        {{-- <th>Image</th> --}}
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Last Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lessons as $lesson)
                                        <tr>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        {{-- <a class="dropdown-item"
                                                            href="{{ route('admin.courses.module.lesson.videos', $lesson->id) }}">
                                                            Videos</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.courses.module.lesson.quizzes', $lesson->id) }}">
                                                            Quizes</a> --}}

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.courses.module.lessonedit', $lesson->id) }}">Edit
                                                            Lesson</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.courses.module.add_pdf', $lesson->id) }}">Add PDF</a>


                                                        {{-- <a class="dropdown-item"
                                                            href="{{ route('admin.courses.assignment', $lesson->slug) }}">Assignment</a>
                                                            --}}
                                                        <form action="{{ route('admin.courses.module.lessondelete') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="lesson_id"
                                                                value="{{ $lesson->id }}">
                                                            <button class="dropdown-item"
                                                                onclick="return confirm('Are you sure want to delete this item?')"
                                                                type="submit">Delete
                                                                Lesson</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td>
                                                <img src="{{ asset($lesson->image) }}" style="height: 100px;width:100px;">
                                            </td> --}}
                                            <td>{{ $lesson->name }}</td>
                                            <td>{{ $lesson->description }}
                                            <td>{{ $lesson->status === 1 ? 'Active' : 'Inactive' }}</td>

                                            <td>{{ $lesson->updated_at->diffForhumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
