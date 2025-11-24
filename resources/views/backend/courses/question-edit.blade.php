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
                        <li class="breadcrumb-item active">Questions</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <form action="{{ route('admin.courses.module.lesson.quiz.questionupdate') }}" method="post"
                enctype="multipart/form-data" id="lessonForm">
                @csrf
                <input type="hidden" name="question_id" value="{{ $question->id }}">
                <div class="card-body">

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Question details</h3>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset($question->image) }}" alt="" class="img-rounded mb-2">
                            <div class="form-group">
                                <div class="input-group hdtuto control-group lst increment">
                                    <input type="text" name="question" class="myfrm form-control" placeholder="Question"
                                        value="{{ $question->question }}" required>
                                    <input type="file" name="image" class="myfrm form-control" placeholder="Image">

                                    {{-- <div class="input-group-btn">
                                        <button class="btn btn-success" type="button"><i class="far fa-plus-square"></i>
                                            Add</button>
                                    </div> --}}
                                </div>

                                <div class="mb-3">
                                    <hr>
                                    <div class="hdtuto control-group lst d-flex flex-wrap" style="margin-top:10px">
                                        @for ($i = 1; $i <= 4; $i++)
                                            <div class="col-6 input-group mt-2">
                                                <input type="hidden" name="option_ids[]"
                                                    value="{{ $question->options[$i - 1]->id }}">
                                                <label class="my-auto mr-1">{{ $i }}.</label>
                                                <input type="text" name="options[]" class="myfrm form-control"
                                                    value="{{ $question->options[$i - 1]->option }}"
                                                    placeholder="Option (tick if correct answer)" required>
                                                <input type="radio" name="answer" value="{{ $i }}"
                                                    class="myfrm m-1" placeholder="Question"
                                                    @if ($question->options[$i - 1]->isAnswer) checked @endif>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="course_details">Explanation</label>
                                    <textarea type="text" name="explanation" class="form-control" id="summernote"
                                    rows="10">{{ old('explanation', $question->explanation) }}</textarea>
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

@endsection
