@extends('backend.layouts.master')
@section('title', 'Existing course update area')
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
    </style>
@endsection

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Course</h1>
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
                        <form action="{{ route('admin.courses.update', $course->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Quiz Category<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" style="width: 100%;" name="category_id"
                                                required>
                                                <option value="" selected>--select category--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if ($category->id == $course->category_id) {{ 'selected' }} @endif>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quiz Subcategory<span class="text-danger"></span></label>
                                            <select class="form-control  select2bs4" data-placeholder="Select subcategory"
                                                style="width: 100%" name="subcategory_id" required>
                                                <option value="{{ $sub->id }}" selected>{{ $sub->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Childcategory</label>
                                            <select class="form-control  select2bs4" data-placeholder="Select childcategory"
                                                style="width: 100%" name="childcategory_id">
                                                @foreach ($child as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($item->id == $course->subcategory_id) {{ 'selected' }} @endif>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Childsubcategory</label>
                                            <select class="form-control  select2bs4"
                                                data-placeholder="Select childsubcategory" style="width: 100%"
                                                name="childsubcategory_id">
                                                @foreach ($childsub as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($item->id == $course->subcategory_id) {{ 'selected' }} @endif>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Instructor<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" style="width: 100%;" name="instructor_id"
                                                required>
                                                <option value="" selected>--select instructor--</option>
                                                @foreach ($instructors as $instructor)
                                                    <option value="{{ $instructor->id }}"
                                                        @if ($instructor->id == $course->instructor_id) {{ 'selected' }} @endif>
                                                        {{ $instructor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}

                                    <!--<div class="col-md-3">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label for="instructor_commision">Instructor Commision(%):</label>-->
                                    <!--        <input type="number" name="instructor_commision" class="form-control" id="instructor_commision"-->
                                    <!--            value="{{ $course->instructor_commision }}" placeholder="Commision" />-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="name">Course name:<span class="text-danger">*</span></label>
                                            <input type="text" name="course_name" class="form-control" id="name"
                                                placeholder="name" value="{{ $course->name }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 mt-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="status" id="status"
                                                @if ($course->status == true) checked @endif>
                                            <label class="form-check-label" for="status">
                                                Active
                                            </label>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price">Price:<span class="text-danger">*</span></label>
                                            <input type="number" name="price" class="form-control" id="price"
                                                value="{{ $course->price + $course->discount_price }}" value="{{ old('price') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="discount">Discount(%):</label>
                                            <input type="number" name="discount" class="form-control" id="discount"
                                                value="{{ $course->discount }}" placeholder="Discount" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="discount">Discount price:</label>
                                            <input type="text" readonly name="discount_price" class="form-control"
                                                id="discount_price" placeholder="Discount price"
                                                value="{{ $course->discount_price }}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="buy">Buying Status</label>
                                        <select class="form-control" id="buy" value="{{ old('buy') }}" name="buy">
                                            <option value="">Select A Status</option>
                                            <option value="Paid" {{  $course->buy == 'Paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="Free" {{  $course->buy == 'Free' ? 'selected' : '' }}>Free</option>
                                        </select>
                                    </div> --}}

                                    <!--<div class="form-group">-->
                                    <!--    <label for="level">Level</label>-->
                                    <!--    <select class="form-control" id="level" value="{{ old('level') }}" name="level">-->
                                    <!--        <option value="">Select A Level</option>-->
                                    <!--        <option value="Beginner" {{  $course->level == 'Beginner' ? 'selected' : '' }}>Beginner</option>-->
                                    <!--        <option value="Advanced" {{  $course->level == 'Advanced' ? 'selected' : '' }}>Advanced</option>-->
                                    <!--    </select>-->
                                    <!--</div>-->

                                    <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const buySelect = document.getElementById("buy");
                                        const priceInput = document.getElementById("price");

                                        if (buySelect && priceInput) {
                                            buySelect.addEventListener("change", function () {
                                                if (this.value === "Free") {
                                                    priceInput.value = 0;
                                                    priceInput.setAttribute("readonly", true);
                                                } else {
                                                    priceInput.removeAttribute("readonly");
                                                }
                                            });

                                            // Optional: Trigger change on page load if needed
                                            buySelect.dispatchEvent(new Event("change"));
                                        }
                                    });
                                    </script>

                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="thumbnil_image">Course thumbnil image<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="thumbnil_image" class="form-control"
                                                id="thumbnil_image" placeholder="Course thumbnil image"
                                                value="{{ old('thumbnil_image') }}">
                                        </div>
                                        <img src="{{ asset($course->thumbnil_image) }}" style="hight:100px;width:200px">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="details_file">Routine (pdf)</label>
                                            <input type="file" name="details_file" class="form-control"
                                                id="details_file" placeholder="Provider company logo/logo"
                                                value="{{ old('details_file') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="syllabus_files">Syllabus (pdf)</label>
                                            <input type="file" name="syllabus_files[]" class="form-control"
                                                id="syllabus_files" placeholder="Provider company logo/logo"
                                                 multiple  accept=".pdf">

                                        </div>
                                    </div> --}}
                                </div>

                                {{-- <div class="form-group">
                                    <label for="course_details">Course details</label>
                                    <textarea type="text" name="details" class="form-control" id="summernote" rows="10">{!! $course->details !!}</textarea>
                                </div> --}}

                                <hr>

                                <!--<div class="col-md-12">-->
                                <!--    <div class="form-group">-->
                                <!--        <label for="certificate_image">Certificate image</label>-->
                                <!--        <input type="file" name="certificate_image" class="form-control"-->
                                <!--            id="certificate_image" placeholder="Course thumbnil image"-->
                                <!--            value="{{ old('certificate_image') }}">-->
                                <!--    </div>-->
                                <!--    <img src="{{ asset($course->certificate_image) }}" alt=""-->
                                <!--        style="hight:100px;width:200px">-->
                                <!--</div>-->

                                <!--<div class="form-group">-->
                                <!--    <label for="course_certificate_text">Certificate text</label>-->
                                <!--    <textarea type="text" name="certificate_text" class="form-control" id="summernote1" rows="10">{!! $course->certificate_text !!}</textarea>-->
                                <!--</div>-->

                                <div class="my-3 row">
                                    <!--<div class="col-md-3">-->
                                    <!--    <div class="form-check">-->
                                    <!--        <input class="form-check-input" type="checkbox" value="1"-->
                                    <!--            name="featured" id="featured"-->
                                    <!--            @if ($course->featured == true) checked @endif>-->
                                    <!--        <label class="form-check-label" for="featured">-->
                                    <!--            Featured-->
                                    <!--        </label>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <!--<div class="col-md-3">-->
                                    <!--    <div class="form-check">-->
                                    <!--        <input class="form-check-input" type="checkbox" value="1"-->
                                    <!--            name="favorite" id="favorite"-->
                                    <!--            @if ($course->favorite == true) checked @endif>-->
                                    <!--        <label class="form-check-label" for="favorite">-->
                                    <!--            Favorite-->
                                    <!--        </label>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <!--<div class="col-md-3">-->
                                    <!--    <div class="form-check">-->
                                    <!--        <input class="form-check-input" type="checkbox" value="1"-->
                                    <!--            name="common" id="common"-->
                                    <!--            @if ($course->common == true) checked @endif>-->
                                    <!--        <label class="form-check-label" for="common">-->
                                    <!--            Common-->
                                    <!--        </label>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>

                                {{-- <div class="card-body">

                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">FAQs</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">

                                                <div class="input-group hdtuto control-group lst increment">
                                                    <input type="text" name="questions[]" class="myfrm form-control" placeholder="Question">
                                                    <input type="text" name="answers[]" class="myfrm form-control" placeholder="Answer">

                                                    <div class="input-group-btn">
                                                        <button class="btn btn-success" type="button"><i class="far fa-plus-square"></i>
                                                            Add</button>
                                                    </div>
                                                </div>

                                                <div class="clone hide">
                                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                                        <input type="text" name="questions[]" class="myfrm form-control" placeholder="Question">
                                                        <input type="text" name="answers[]" class="myfrm form-control" placeholder="Answer">

                                                        <div class="input-group-btn">
                                                            <button class="btn btn-danger" type="button"> <i
                                                                    class="far fa-minus-square"></i> Remove </button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div> --}}

                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                    {{-- <div class="card-body">

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">FAQs Edit</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    @foreach($course->faqs as $faq)
                                    <form action="/admin/courses/faq/update" method="POST">
                                        @csrf
                                        <div class="input-group hdtuto control-group lst increment mb-1">
                                            <input type="hidden" name="hidden_id" value="{{ $faq->id }}">
                                            <input type="text" name="question" class="myfrm form-control" placeholder="Question" value="{{ $faq->question }}" required>
                                            <input type="text" name="answer" class="myfrm form-control" placeholder="Answer" value="{{ $faq->answer }}" required>

                                            <div class="input-group-btn align-content-center">
                                                <a class="btn btn-outline-danger btn-sm" href="/admin/courses/faq/delete/{{ $faq->id }}"><i class="far fa-trash-alt"></i>Delete</a>
                                                <button class="btn btn-outline-info btn-sm" type="submit"><i class="far fa-edit"></i>Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div> --}}

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
