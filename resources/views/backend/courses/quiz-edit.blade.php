@extends('backend.layouts.master')
@section('title', 'Quiz')
@section('cssStyle')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .hide {
            display: none;
        }
    </style>
@endsection

@section('backend')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit quiz</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Quiz</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <form action="{{ route('admin.courses.module.lesson.quizupdate') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                <input type="hidden" name="lesson_id" value="{{ $lesson->id ?? ''}}">
                <input type="hidden" name="exam_status" value="1">

                <div class="card-body">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Quiz details</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category_id">Quiz Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">Select Quiz Category</option>
                                    @foreach($quizcategory as $category)
                                        <option value="{{ $category->id }}" {{ $quiz->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <label for="subcategory_id">Quiz Subcategory</label>
                                <select name="subcategory_id" class="form-control" required>
                                    <option value="">Select Subcategory</option>
                                    @foreach($quizsubcategory as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ $quiz->subcategory_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>

                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                                    value="{{ $quiz->name }}" required>

                                <label for="timer" class="mt-3">Time</label>
                                <input type="text" name="timer" id="timer" class="form-control" placeholder="timer"
                                value="{{ $quiz->timer }}">

                                {{-- <input type="file" name="pdf" class="form-control" accept="application/pdf"> --}}
                                <label for="passingscore">Passing Score</label>
                                <input type="number" name="passingscore" class="myfrm form-control" placeholder="Passing Score (%)" id="passingscore" value="{{ $quiz->passingscore }}">

                                <label for="passingpoint">Passing Point</label>
                                <input type="number" name="passingpoint" class="myfrm form-control" placeholder="Passing Points" id="passingpoint" value="{{ $quiz->passingpoint }}">

                                <label for="release_date">Release Date</label>
                                <input type="date" name="release_date" class="form-control" value="{{ $quiz->release_date }}">

                                <label for="negative_mark">Negative Mark</label>
                                <input type="number" step="0.01" name="negative_mark" class="form-control" placeholder="Negative Mark" value="{{ $quiz->negative_mark }}">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="checkDefault" name="inside_routine" @if ($quiz->inside_routine == 1) checked @endif >
                                    <label class="form-check-label" for="checkDefault">
                                        Inside Routine
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('jsScript')
    {{-- for multiple file insertion --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-success").click(function() {
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);
            });
            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".hdtuto").remove();
            });
            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/general/quizsubcategory/') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="subcategory_id"]').empty();
                            $('select[name="subcategory_id"]').append(
                                '<option value="">select</option>');
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' +
                                    value.id + '">' + value
                                    .name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endsection
