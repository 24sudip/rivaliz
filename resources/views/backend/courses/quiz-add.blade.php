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
                    <h1>Add quiz for <b>{{ $lesson->name }}</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Videos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <form action="{{ route('admin.courses.module.lesson.quizzestore') }}" method="post"
                enctype="multipart/form-data" id="lessonForm">
                @csrf
                <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                <div class="card-body">

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Quiz details</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group hdtuto control-group lst increment">
                                    <input type="text" name="names[]" class="myfrm form-control" placeholder="Name"
                                        required>
                                    <input type="text" name="timer[]" class="myfrm form-control" placeholder="Time"
                                        required>

                                    <div class="input-group-btn">
                                        <button class="btn btn-success" type="button"><i class="far fa-plus-square"></i>
                                            Add</button>
                                    </div>
                                </div>

                                <div class="clone hide">
                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                        <input type="text" name="names[]" class="myfrm form-control" placeholder="Name">
                                        <input type="text" name="timer[]" class="myfrm form-control" placeholder="Time">

                                        <div class="input-group-btn">
                                            <button class="btn btn-danger" type="button"> <i
                                                    class="far fa-minus-square"></i> Remove </button>

                                        </div>
                                    </div>
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
