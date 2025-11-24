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
                    <h1>Edit lesson</b></h1>
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
            <form action="{{ route('admin.courses.module.lesson.videoupdate') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="video_id" value="{{ $video->id }}">
                <div class="card-body">

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Lesson details</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                                    value="{{ $video->name }}" required>

                                <label for="link" class="mt-3">Link</label>
                                <textarea type="text" name="link" id="link" class="form-control" placeholder="Description">{{ $video->link }}</textarea>
                                 <label for="image">Video</label>
                                      <input type="file" name="image" class="form-control"  placeholder="Video" >
                                @if($video->image)
    <video width="180" height="100" controls controlsList="nodownload" class="mt-2">
        <source src="{{ asset($video->image) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
@endif
                                <div class="d-flex mt-2 ">
                                    <input type="checkbox" name="free" class="myfrm" id="free"
                                        @if ($video->free) checked @endif>
                                    <label for="free" class="my-auto">&nbsp; Free</label>
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
