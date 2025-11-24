<!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
@extends('backend.layouts.master')
@section('title', 'Create Slider Photo')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Slider Photo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create Slider Photo</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body mb-0">

                                <div class="form-group mb-2">
                                    <label class="form-label">Slider Photo</label>
                                    <input type="file" class="form-control" name="photo_name" onchange="mainThumUrl(this)">
                                    <img src="" id="mainThmb">
                                </div>
                                                               <!-- Select2 CSS (CDN) -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (Required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@php
    use App\Models\Course;
    $courses = Course::select('id', 'name')->get();
@endphp

<div class="form-group mb-2">
    <label class="form-label">Course Name</label>
    <select class="form-control form-control-sm" id="course-select" name="course_id">
        <option value="">Select A Course</option>
        @foreach($courses as $course)
            <option value="{{ $course->id }}" >
                {{ $course->name }}
            </option>
        @endforeach
    </select>
</div>
<style>
    .select2-container .select2-selection--single {
        height: 31px !important;
        padding: 4px 8px;
        font-size: 0.875rem;
    }
    .select2-selection__rendered {
        line-height: 22px !important;
    }
    .select2-selection__arrow {
        height: 31px !important;
    }
</style>
<script>
    $(document).ready(function() {
        $('#course-select').select2({
            placeholder: "Search or select a course",
            allowClear: true
        });
    });
</script>
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Select A Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script type="text/javascript">
    function mainThumUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#mainThmb").attr("src",e.target.result).width(80);
                // .height(80)
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
@endsection
