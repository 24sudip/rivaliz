@extends('backend.layouts.master')
@section('title', 'Videos')
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
                    <h1>Add video for <b>{{ $lesson->name }}</b></h1>
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
            <form action="{{ route('admin.courses.module.lesson.videostore') }}" method="post"
                enctype="multipart/form-data" id="lessonForm">
                @csrf
                <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                <div class="card-body">

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Lesson details</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group hdtuto control-group lst increment">
                                    <input type="text" name="names[]" class="myfrm form-control" placeholder="Name"
                                        required>
                                    <input type="text" name="links[]" class="myfrm form-control" placeholder="Link"
                                       >
                                        <input type="file" name="images[]" class="myfrm form-control" placeholder="Image"
                                       >
                                        <div class="form-check ml-3 mr-3" style="margin-top: 10px;">
                                             <input type="checkbox" name="frees[]" class="form-check-input" value="1" id="freeCheck{{ uniqid() }}">
                                              <label class="form-check-label" for="freeCheck{{ uniqid() }}">Free</label>
                                        </div>

                                    <div class="input-group-btn">
                                        <button class="btn btn-success" type="button"><i class="far fa-plus-square"></i>
                                            Add</button>
                                    </div>
                                </div>

                                <div class="clone hide">
                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                        <input type="text" name="names[]" class="myfrm form-control" placeholder="Name">
                                        <input type="text" name="links[]" class="myfrm form-control" placeholder="Link">
                                        <input type="file" name="images[]" class="myfrm form-control" placeholder="Image">
                                         <div class="form-check ml-3 mr-3" style="margin-top: 10px;">
                                             <input type="checkbox" name="frees[]" class="form-check-input" value="1" id="freeCheck{{ uniqid() }}">
                                              <label class="form-check-label" for="freeCheck{{ uniqid() }}">Free</label>
                                        </div>
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

 <!-- Loader below input fields (initially hidden) -->
        <div id="loader" style="display:none; text-align:center; margin-top: 20px;">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Uploading...</span>
            </div>
            <p style="margin-top: 15px; font-size: 18px;">Uploading... Please wait</p>
        </div>


                    <!-- /.card-body -->
                </div>
            </form>
            
          <!-- JavaScript to Show Loader After Submission -->
<script>
    document.getElementById('lessonForm').addEventListener('submit', function () {
        // Show the loader after form submission
        document.getElementById('loader').style.display = 'block';
    });
</script>

<!-- Optional: Include Bootstrap if not already included -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
