@extends('backend.layouts.master')
@section('title', 'Courses')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Courses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Courses</li>
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
                            <a href="{{ route('admin.courses.create') }}" class="btn btn-outline-primary">Add
                                Courses</a>
                            <br>
                            <br>

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                       {{-- <th>Student List<th>

                                            <th> </th> --}}
                                        <th>Course Name</th>
                                        {{-- <th>Image</th> --}}


                                        <th>Status</th>
                                        <!--<th>Strategy</th>-->
                                        <th>Quiz Sub-Category</th>
                                        <th>Quiz Category</th>
                                        <!--<th>Modified_at</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        use Illuminate\Support\Facades\DB;
                                        $students = DB::table('students')->get();
                                    @endphp

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
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.courses.modules', $course->id) }}">Modules</a>

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
                                                            href="{{ route('admin.courses.edit', $course->id) }}">Edit
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
                                                        <form action="{{ route('admin.courses.delete', $course) }}"
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


                                         {{--       <form action="{{ route('admin.courses.enroll') }}" method="POST">
                                                    @csrf

                                                    <td class="w-50">
                                                        <label><strong>Select Existing Students:</strong></label>
                                                        <select name="student_ids[]" class="form-control student-email-select" multiple>
                                                            @foreach ($students as $student)
                                                                <option value="{{ $student->id }}">{{ $student->email }}</option>
                                                            @endforeach
                                                        </select>
                                                        <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple</small>
                                                    </td>

                                                    <td class="w-50">
                                                        <label><strong>Add New Students:</strong></label>
                                                        <textarea name="email" class="form-control" placeholder="student1@example.com, student2@example.com" rows="3"></textarea>
                                                        <small class="text-muted">Separate multiple emails with commas</small>
                                                    </td>

                                                    <td class="align-top ">
                                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                        <button type="submit" class="btn btn-primary mt-4">Enroll</button>
                                                    </td>
                                                </form>
                                            --}}

                                            <td>{{ $course->name }}</td>

                                            {{-- <td>
                                                <img src="{{ asset($course->thumbnil_image) }}"
                                                    style="height: 100px;width:100px;">
                                            </td> --}}

                                            <td>{{ $course->status === 1 ? 'Active' : 'Inactive' }}</td>

                                            <!--<td>-->
                                            <!--    Commision: {{ $course->instructor_commision }}% <br>-->
                                            <!--    Amount: {{ $course->commision_amount }} <br>-->
                                            <!--    Due: {{ $course->commision_due }} <br>-->
                                            <!--</td>-->

                                            {{-- <td>
                                                Price: <small> <del>{{ $course->old_price }}</del> </small> {{ $course->price }}  <br>
                                                Sold: {{ $course->enrolled }} <br>
                                                <!--Revenue:-->
                                                {{ $course->enrolled * $course->price - $course->commision_amount }}
                                            </td> --}}

                                            <td>
                                                Subcategory: {{ $course->subcategory->name ?? '' }}
                                            </td>

                                            <td>
                                                Category: {{ $course->category->name }} <br>
                                                <!--Childcategory: {{ $course->childcategory->name ?? 'Not set' }} <br>-->
                                                <!--Childsubcategory: {{ $course->childsubcategory->name ?? 'Not set' }}-->
                                            </td>
                                            <!--<td>{{ $course->updated_at->diffForhumans() }}</td>-->
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

    <!-- jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Activate Select2 on the select box -->
    <script>
        $(document).ready(function() {
            $('.student-email-select').select2({
                placeholder: "Search..",
                width: '100%'
            });
        });
    </script>
@endsection
