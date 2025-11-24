@extends('backend.layouts.master')
@section('title', 'Courses')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Videos of <strong>{{ $lesson->name }}</strong></h1>
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
                                    <a href="{{ route('admin.courses.module.lessons', $lesson->module_id) }}" class="btn btn-outline-info btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                                <div>
                                    <a href="{{ route('admin.courses.module.lesson.videoadd', $lesson->id) }}" class="btn btn-outline-primary"><i class="fa fa-plus"></i> Add Videos</a>
                                </div>
                            </div>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                    <th>Video</th> 
                                        <th>Name</th>
                                        <th>Link</th>
                                        <h>Type</h>
                                        <th>Status</th>
                                        <th>Last Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($videos as $video)
                                        <tr>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">


                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.courses.module.lesson.videoedit', $video->id) }}">Edit
                                                            Video</a>



                                                        {{-- <a class="dropdown-item"
                                                            href="{{ route('admin.courses.assignment', $video->slug) }}">Assignment</a>
                                                            --}}
                                                        <form
                                                            action="{{ route('admin.courses.module.lesson.videodelete') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="video_id"
                                                                value="{{ $video->id }}">
                                                            <button class="dropdown-item"
                                                                onclick="return confirm('Are you sure want to delete this item?')"
                                                                type="submit">Delete
                                                                Video</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                              <video width="150" height="100" controls>
  <source src="{{ asset($video->image) }}" type="video/mp4">
  Your browser does not support the video tag.
</video>
                                            </td> 
                                            <td>{{ $video->name }}</td>
                                            <td> <a href="{{ $video->link }}" target="_blank"> {{ $video->link }} </a>
                                            </td>
                                            <td>{{ $video->free === 1 ? 'Free' : 'Paid' }}</td>
                                            <td>{{ $video->status === 1 ? 'Active' : 'Inactive' }}</td>

                                            <td>{{ $video->updated_at->diffForhumans() }}</td>
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
