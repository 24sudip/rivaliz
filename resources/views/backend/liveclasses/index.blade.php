@extends('backend.layouts.master')
@section('title', 'Classes')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Classes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Classes</li>
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
                            <a href="{{ route('admin.liveclass.create') }}" class="btn btn-outline-primary">Add
                                Classes</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Title</th>
                                        <th>Course</th>
                                        <th>Instructor</th>
                                        <th>Scheduled At</th>
                                        <th>Modified_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($liveclasses as $class)
                                        <tr>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.liveclass.edit', $class->id) }}">Edit
                                                            Class</a>

                                                    </div>
                                                </div>
                                            </td>

                                            <td>{{ $class->name }}</td>
                                            @if ($class->course)
                                            <td>{{ $class->course->name }} </td>
                                            @else
                                            <td>No Course</td>
                                            @endif
                                            <td>{{ $class->instructor->name }}</td>
                                            <td>{{ $class->scheduled_at }}</td>

                                            <td>{{ $class->updated_at->diffForhumans() }}</td>
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
