@extends('backend.layouts.master')
@section('title', 'New course creation area')
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
                    <h1>New Live Course</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Course</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add new course goes here</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.livecourses.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Main Category<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" style="width: 100%;" name="category_id"
                                                required>
                                                <option value="" selected>--select category--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Subcategory<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" data-placeholder="Select subcategory"
                                                style="width: 100%" name="subcategory_id" required>

                                            </select>
                                        </div>
                                    </div>
                                    <!--<div class="col-md-3">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label>Childcategory</label>-->
                                    <!--        <select class="form-control  select2bs4" data-placeholder="Select childcategory"-->
                                    <!--            style="width: 100%" name="childcategory_id">-->

                                    <!--        </select>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-3">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label>Childsubcategory</label>-->
                                    <!--        <select class="form-control  select2bs4"-->
                                    <!--            data-placeholder="Select childsubcategory" style="width: 100%"-->
                                    <!--            name="childsubcategory_id">-->

                                    <!--        </select>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Instructor<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" style="width: 100%;" name="instructor"
                                                required>
                                                <option value="" selected>--select instructor--</option>
                                                @foreach ($instructors as $instructor)
                                                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="instructor_commision">Instructor Commision(%)<span class="text-danger">*</span></label>
                                            <input type="number" name="instructor_commision" class="form-control" id="instructor_commision"
                                                placeholder="Commision" value="{{ old('instructor_commision') }}" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="name">Course name:<span class="text-danger">*</span></label>
                                            <input type="text" name="course_name" class="form-control" id="name"
                                                placeholder="name" value="{{ old('name') }}" />
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price">Price:<span class="text-danger">*</span></label>
                                            <input type="number" name="price" class="form-control" id="price"
                                                placeholder="Price" value="{{ old('price') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="discount">Discount(%):</label>
                                            <input type="number" name="discount" class="form-control" id="discount"
                                                placeholder="Discount" value="{{ old('discount') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="discount">Discount price:</label>
                                            <input type="text" readonly name="discount_price"
                                                value="{{ old('discount_price') }}" class="form-control" id="discount_price"
                                                placeholder="Discount price" />
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="thumbnil_image">Course thumbnil image<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="thumbnil_image" class="form-control"
                                                id="thumbnil_image" placeholder="Course thumbnil image"
                                                value="{{ old('thumbnil_image') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="details_file">Course details (pdf)</label>
                                            <input type="file" name="details_file" class="form-control"
                                                id="details_file" placeholder="Provider company logo/logo"
                                                value="{{ old('details_file') }}">
                                        </div>
                                    </div>

                                    

                                </div>

                                <div class="form-group">
                                    <label for="course_details">Course details<span class="text-danger">*</span></label>
                                    <textarea type="text" name="details" class="form-control" id="summernote" rows="10">{{ old('details') }}</textarea>
                                </div>


                                <hr>


                                {{-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="certificate_image">Course Certificate</label>
                                        <input type="file" name="certificate_image" class="form-control"
                                            id="certificate_image" placeholder="Course Certificate"
                                            value="{{ old('certificate_image') }}">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="course_certificate_text">Certificate Details</label>
                                    <textarea type="text" name="certificate_text" class="form-control" id="summernote1" rows="10">{{ old('certificate_text') }}</textarea>
                                </div> --}}

                                <!--<div class="col-md-12">-->
                                <!--    <div class="form-group">-->
                                <!--        <label for="certificate_image">Course Schedules</label>-->
                                <!--    </div>-->
                                <!--</div>-->



                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('jsScript')


    {{-- submenu dependency --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/general/subcategory/') }}/" + category_id,
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="subcategory_id"]').on('change', function() {
                var subcategory_id = $(this).val();
                if (subcategory_id) {
                    $.ajax({
                        url: "{{ url('/general/childcategory/') }}/" + subcategory_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="childcategory_id"]').empty();
                            $('select[name="childcategory_id"]').append(
                                '<option value="">select</option>');
                            $.each(data, function(key, value) {
                                $('select[name="childcategory_id"]').append(
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="childcategory_id"]').on('change', function() {
                var childcategory_id = $(this).val();
                if (childcategory_id) {
                    $.ajax({
                        url: "{{ url('/general/childcategory/') }}/" + childcategory_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="childsubcategory_id"]').empty();
                            $('select[name="childsubcategory_id"]').append(
                                '<option value="">select</option>');
                            $.each(data, function(key, value) {
                                $('select[name="childsubcategory_id"]').append(
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

    {{-- for discount price --}}
    <script type="text/javascript">
        $(function() {
            $("#price, #discount").on("keydown keyup", sum);

            function sum() {
                var price = Number($("#price").val());
                var discount = Number($("#discount").val());
                $("#discount_price").val(parseInt((price * discount) / 100));
            }
        });
    </script>
@endsection
