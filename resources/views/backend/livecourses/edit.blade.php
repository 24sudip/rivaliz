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
                        <form action="{{ route('admin.livecourses.update', $course->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Main Category<span class="text-danger">*</span></label>
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Subcategory<span class="text-danger">*</span></label>
                                            <select class="form-control  select2bs4" data-placeholder="Select subcategory"
                                                style="width: 100%" name="subcategory_id" required>
                                                @foreach ($sub as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($item->id == $course->subcategory_id) {{ 'selected' }} @endif>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--<div class="col-md-3">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label>Childcategory</label>-->
                                    <!--        <select class="form-control  select2bs4" data-placeholder="Select childcategory"-->
                                    <!--            style="width: 100%" name="childcategory_id">-->
                                    <!--            @foreach ($child as $item)-->
                                    <!--                <option value="{{ $item->id }}"-->
                                    <!--                    @if ($item->id == $course->subcategory_id) {{ 'selected' }} @endif>-->
                                    <!--                    {{ $item->name }}</option>-->
                                    <!--            @endforeach-->
                                    <!--        </select>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-3">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label>Childsubcategory</label>-->
                                    <!--        <select class="form-control  select2bs4"-->
                                    <!--            data-placeholder="Select childsubcategory" style="width: 100%"-->
                                    <!--            name="childsubcategory_id">-->
                                    <!--            @foreach ($childsub as $item)-->
                                    <!--                <option value="{{ $item->id }}"-->
                                    <!--                    @if ($item->id == $course->subcategory_id) {{ 'selected' }} @endif>-->
                                    <!--                    {{ $item->name }}</option>-->
                                    <!--            @endforeach-->
                                    <!--        </select>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="col-md-3">
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
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="instructor_commision">Instructor Commision(%)<span class="text-danger">*</span></label>
                                            <input type="number" name="instructor_commision" class="form-control" id="instructor_commision"
                                                value="{{ $course->instructor_commision }}" placeholder="Commision" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="name">Course name:<span class="text-danger">*</span></label>
                                            <input type="text" name="course_name" class="form-control" id="name"
                                                placeholder="name" value="{{ $course->name }}" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
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
                                    

                                    <div class="col-md-4">
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
                                            <label for="details_file">Course details (pdf)</label>
                                            <input type="file" name="details_file" class="form-control"
                                                id="details_file" placeholder="Provider company logo/logo"
                                                value="{{ old('details_file') }}">
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="form-group">
                                    <label for="course_details">Course details</label>
                                    <textarea type="text" name="details" class="form-control" id="summernote" rows="10">{!! $course->details !!}</textarea>
                                </div>


                                <hr>

                                {{-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="certificate_image">Certificate image</label>
                                        <input type="file" name="certificate_image" class="form-control"
                                            id="certificate_image" placeholder="Course thumbnil image"
                                            value="{{ old('certificate_image') }}">
                                    </div>
                                    <img src="{{ asset($course->certificate_image) }}" alt=""
                                        style="hight:100px;width:200px">
                                </div>

                                <div class="form-group">
                                    <label for="course_certificate_text">Certificate text</label>
                                    <textarea type="text" name="certificate_text" class="form-control" id="summernote1" rows="10">{!! $course->certificate_text !!}</textarea>
                                </div> --}}

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="certificate_image">Course Schedules</label>
                                        <button type="button" data-toggle="modal" data-target="#schedulestore"
                                            class="btn btn-primary btn-sm float-end"> Add </button>
                                    </div>

                                    <div class="d-flex flex-wrap">
                                        @foreach ($course->schedules as $schedule)
                                            <div class="col-6 my-1">
                                                <div class="d-flex border rounded">
                                                    <div class="col-11">

                                                        <p class="mt-2"><b>Day:</b> {{ $schedule->weekday }}<br>
                                                            <b>Time:</b> {{ $schedule->start_time }} -
                                                            {{ $schedule->end_time }}
                                                        </p>
                                                    </div>
                                                    <div>

                                                        <button type="button" class="btn btn-sm" data-toggle="modal"
                                                            data-target="#exampleModal-{{ $schedule->id }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                    <div class="modal fade" id="schedulestore" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('admin.livecourses.schedule.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Schedule Add</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label>Day</label>
                                            <select name="weekday" class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="SUN">SUN</option>
                                                <option value="MON">MON</option>
                                                <option value="TUE">TUE</option>
                                                <option value="WED">WED</option>
                                                <option value="THU">THU</option>
                                                <option value="FRI">FRI</option>
                                                <option value="SAT">SAT</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <input type="time" name="start_time" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>End Time</label>
                                            <input type="time" name="end_time" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Location/Link</label>
                                            <input type="text" name="location" class="form-control">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @foreach ($course->schedules as $schedule)
                        <div class="modal fade" id="exampleModal-{{ $schedule->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('admin.livecourses.schedule.edit', $schedule->id) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="hidden_id" value="{{ $schedule->id }}">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Schedule Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label>Day</label>
                                                <select name="weekday" class="form-control">
                                                    <option value="SUN"
                                                        @if ($schedule->weekday == 'SUN') selected @endif>
                                                        SUN</option>
                                                    <option value="MON"
                                                        @if ($schedule->weekday == 'MON') selected @endif>
                                                        MON</option>
                                                    <option value="TUE"
                                                        @if ($schedule->weekday == 'TUE') selected @endif>
                                                        TUE</option>
                                                    <option value="WED"
                                                        @if ($schedule->weekday == 'WED') selected @endif>
                                                        WED</option>
                                                    <option value="THU"
                                                        @if ($schedule->weekday == 'THU') selected @endif>
                                                        THU</option>
                                                    <option value="FRI"
                                                        @if ($schedule->weekday == 'FRI') selected @endif>
                                                        FRI</option>
                                                    <option value="SAT"
                                                        @if ($schedule->weekday == 'SAT') selected @endif>
                                                        SAT</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Start Time</label>
                                                <input type="time" name="start_time"
                                                    value="{{ $schedule->start_time }}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>End Time</label>
                                                <input type="time" name="end_time" value="{{ $schedule->end_time }}"
                                                    class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" value="{{ $schedule->title }}"
                                                    class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Location/Link</label>
                                                <input type="text" name="location" value="{{ $schedule->location }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
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
