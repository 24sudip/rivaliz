@extends('backend.layouts.master')
@section('title', 'Courses')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Live Courses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Live Courses</li>
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
                            <a href="{{ route('admin.livecourses.create') }}" class="btn btn-outline-primary">Add Live
                                Courses</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Image</th>
                                        <th>Course Name</th>
                                        <th>Status</th>
                                        <th>Strategy</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Modified_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger btn-sm   dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        {{-- active&inactive --}}

                                                        @if ($course->status === 1)
                                                            <form
                                                                action="{{ route('admin.courses.inactive', $course->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Inactive
                                                                    Course</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.courses.active', $course->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active
                                                                    Course</button>
                                                            </form>
                                                        @endif

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.livecourses.edit', $course->id) }}">Edit
                                                            Course</a>


                                                        {{-- <a class="dropdown-item"
                                                            href="{{ route('admin.courses.addQuiz', $course->id) }}">Add
                                                            Quiz</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.courses.addQuestion', $course->id) }}">Add
                                                            Question</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.courses.addAuthor', $course->id) }}">Add
                                                            Author</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.courses.addVideo', $course->id) }}">Add
                                                            Video</a> --}}

                                                        {{-- <a class="dropdown-item"
                                                            href="{{ route('admin.courses.assignment', $course->slug) }}">Assignment</a>
                                                            --}}
                                                        <form action="{{ route('admin.livecourses.delete', $course) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button class="dropdown-item"
                                                                onclick="return confirm('Are you sure want to delete this item?')"
                                                                type="submit">Delete
                                                                Course</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <img src="{{ asset($course->thumbnil_image) }}"
                                                    style="height: 100px;width:100px;">
                                            </td>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ $course->status === 1 ? 'Y' : 'N' }}</td>
                                            <td>
                                                Commision: {{ $course->instructor_commision }}% <br>
                                                Amount: {{ $course->commision_amount }} <br>
                                                Due: {{ $course->commision_due }} <br>
                                            </td>
                                            <td>
                                                Price: <small> <del>{{ $course->old_price }}</del> </small> {{ $course->price }}  <br>
                                                Sold: {{ $course->enrolled }} <br>
                                                Revenue:
                                                {{ $course->enrolled * $course->price - $course->commision_amount }}
                                            </td>
                                            <td>
                                                Category: {{ $course->category->name }} <br>
                                                Subcategory: {{ $course->subcategory->name ?? '' }} <br>
                                                Childcategory: {{ $course->childcategory->name ?? 'Not set' }} <br>
                                                Childsubcategory: {{ $course->childsubcategory->name ?? 'Not set' }}
                                            </td>
                                            <td>{{ $course->updated_at->diffForhumans() }}</td>
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
