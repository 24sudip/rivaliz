@extends('backend.layouts.master')
@section('title', 'Quizzes')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                {{-- <div class="col-sm-6">
                    <h1>Question of <strong>{{ $quiz->name }}</strong></h1>
                </div> --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Modules</li>
                        <li class="breadcrumb-item">Lessons</li>
                        <li class="breadcrumb-item active">Question</li>
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
                                    <a href="{{ route('admin.courses.module.lesson.quizzes', $quiz->lesson_id) }}" class="btn btn-outline-info btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                                </div> --}}
                                <div>
                                    <a href="{{ route('admin.courses.exam.addquestions', $quiz->id) }}" class="btn btn-outline-primary"><i class="fa fa-plus"></i>  Add Questions</a>
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
                                        <th>Options</th>
                                        <th>Last Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $question)
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
                                                            href="{{ route('admin.courses.module.lesson.quiz.questionedit', $question->id) }}">Edit
                                                            Question</a>



                                                        {{-- <a class="dropdown-item"
                                                            href="{{ route('admin.courses.assignment', $question->slug) }}">Assignment</a>
                                                            --}}
                                                        <form
                                                            action="{{ route('admin.courses.module.lesson.quiz.questiondelete') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="question_id"
                                                                value="{{ $question->id }}">
                                                            <button class="dropdown-item"
                                                                onclick="return confirm('Are you sure want to delete this item?')"
                                                                type="submit">Delete
                                                                Quiz</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td>
                                                <img src="{{ asset($question->image) }}" style="height: 100px;width:100px;">
                                            </td> --}}
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        {{ $question->question }}
                                                    </div>
                                                    @if ($question->image)
                                                        <div class="float-end">
                                                            <img src="{{ asset($question->image) }}" alt=""
                                                                class="img-lg mr-2">
                                                        </div>
                                                    @endif
                                            </td>
                                            <td>
                                                @foreach ($question->options as $key => $option)
                                                    <span>{{ $key + 1 }}.
                                                        {{ $option->option }}</span>
                                                    @if ($option->isAnswer)
                                                        &check;
                                                    @endif
                                                    <br>
                                                @endforeach
                                            </td>


                                            <td>{{ $question->updated_at->diffForhumans() }}</td>
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
