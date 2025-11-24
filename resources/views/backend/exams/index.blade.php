@extends('backend.layouts.master')
@section('title', 'Exams')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1>Quizzes of <strong>{{ $lesson->name }}</strong></h1> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Modules</li>
                        <li class="breadcrumb-item">Lessons</li>
                        <li class="breadcrumb-item active">Quizzes</li>
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
                                {{-- <div>
                                    <a href="{{ route('admin.courses.module.lessons', $lesson->module_id) }}" class="btn btn-outline-info btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                                </div> --}}

                                <div>
                                    <a href="{{ route( 'admin.courses.exam.addexam') }}" class="btn btn-outline-primary"><i class="fa fa-plus"></i> Add Quizzes</a>
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
                                        <th>Time</th>
                                        {{--  <th>Amount</th> --}}
                                        {{-- <th>Last Update</th> --}}
                                        <th>Passing Score</th>
                                        <th>Passing Points</th>
                                        {{-- <th>Pdf</th> --}}
                                        <th>View Score</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quizzes as $quiz)
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

                                                            href="{{ route('admin.courses.exam.questions', $quiz->id) }}">Questions</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.courses.module.lesson.quizedit', $quiz->id) }}">Edit
                                                            Quiz</a>



                                                        {{-- <a class="dropdown-item"
                                                            href="{{ route('admin.courses.assignment', $quiz->slug) }}">Assignment</a>
                                                            --}}
                                                        <form action="{{ route('admin.courses.module.lesson.quizdelete') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="quiz_id"
                                                                value="{{ $quiz->id }}">
                                                            <button class="dropdown-item"
                                                                onclick="return confirm('Are you sure want to delete this item?')"
                                                                type="submit">Delete
                                                                Quiz</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td>
                                                <img src="{{ asset($quiz->image) }}" style="height: 100px;width:100px;">
                                            </td> --}}
                                            <td>{{ $quiz->name }}</td>
                                            <td>{{ $quiz->timer }} </td>
                                            {{-- <td>{{ $quiz->status === 1 ? 'Y' : 'N' }}</td> --}}
                                            {{--<td>{{ $quiz->amount }}</td>--}}
                                            <td>{{ $quiz->passingscore }}%</td>
                                            <td>{{ $quiz->passingpoint }}</td>
                                            {{-- <td>
                                                <!-- Check if the quiz has a PDF path and display a "View" button -->
                                                @if ($quiz->pdf)
                                                    <!-- Link to the PDF file -->
                                                    <a href="{{ asset($quiz->pdf) }}" target="_blank" class="btn btn-primary">View Pdf</a>
                                                @else
                                                    <!-- If no PDF is available, show a message -->
                                                    <span>No PDF available</span>
                                                @endif
                                            </td> --}}
                                            <td>
                                             <a href="{{ route('admin.courses.examscore', $quiz->id) }}" target="_blank" class="btn btn-secondary">View Score</a>
                                            </td>
                                            <td>{{ $quiz->updated_at->diffForhumans() }}</td>
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
