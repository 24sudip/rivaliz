@extends('backend.layouts.master')
@section('title', 'Exam')
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
                    {{-- <h1>Add Exam for <b>{{ $lesson->name }}</b></h1> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Exam</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <form action="{{ route('admin.courses.exam.storeexam') }}" method="post"
                enctype="multipart/form-data" id="lessonForm">
                @csrf
                <input type="hidden" name="lesson_id" value="{{ $lesson->id ?? ''}}">
                <input type="hidden" name="exam_status" value="1">

                <div class="card-body">

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Exam details</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group hdtuto control-group lst increment">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                {{-- <label for="category_id">Quiz Category</label> --}}
                                                <select name="category_id" class="form-control" required>
                                                    <option value="">Select Quiz Category</option>
                                                    @foreach($quizcategory as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                {{-- <label for="subcategory_id">Quiz Subcategory</label> --}}
                                                <select name="subcategory_id" class="form-control" required>
                                                    <option value="">Select Subcategory</option>
                                                    @foreach($quizsubcategory as $subcategory)
                                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text" name="name" class="myfrm form-control" placeholder="Name"
                                                required>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="number" name="timer" class="myfrm form-control" placeholder="Time"
                                                required>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="number" name="passingscore" class="myfrm form-control" placeholder="Passing Score (%)" required>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="number" name="passingpoint" class="myfrm form-control" placeholder="Passing Points" required>
                                        </div>
                                        <div class="col-lg-4 mt-3">
                                            <input type="date" name="release_date" class="form-control">
                                        </div>
                                        <div class="col-lg-3 mt-3">
                                            <input type="number" step="0.01" name="negative_mark" class="form-control" placeholder="Negative Mark">
                                        </div>
                                        <div class="col-lg-4 mt-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="checkDefault" name="inside_routine">
                                                <label class="form-check-label" for="checkDefault">
                                                    Inside Routine
                                                </label>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-4 mt-3">
                                            <!-- PDF Upload Field -->
                                            <input type="file" name="pdfs[]" class="form-control" accept="application/pdf">
                                        </div> --}}
                                    </div>
                                </div>

                                {{-- <div class="clone hide">
                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                        <input type="text" name="names[]" class="myfrm form-control" placeholder="Name">
                                        <input type="text" name="timer[]" class="myfrm form-control" placeholder="Time">
                                        <input type="number" name="amount[]" class="myfrm form-control" placeholder="Amount">
                                        <input type="number" name="passing_score[]" class="myfrm form-control" placeholder="Passing Score (%)">
                                        <input type="number" name="passing_points[]" class="myfrm form-control" placeholder="Passing Points">

                                        <input type="file" name="pdfs[]" class="form-control" accept="application/pdf">
                                        <div class="input-group-btn">
                                            <button class="btn btn-danger" type="button"> <i
                                                    class="far fa-minus-square"></i> Remove </button>
                                        </div>
                                    </div>
                                </div> --}}
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
