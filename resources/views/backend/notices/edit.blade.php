@extends('backend.layouts.master')
@section('title', 'Existing Notice update area')
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
                    <h1>Update Notice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Notice</li>
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
                        <form action="{{ route('admin.notice.update', $notice->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">

                                <div class="row">
                                    
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label for="title">Notice title:<span class="text-danger">*</span></label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                    placeholder="title" value="{{ $notice->title }}" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="title">Notice For<span class="text-danger">*</span></label>
                                                <select class="form-control" name="sent_to">
                                                    <option value="0" @if($notice->sent_to==0) selected @endif>For All</option>
                                                    <option value="1" @if($notice->sent_to==1) selected @endif>Instructors</option>
                                                    <option value="2" @if($notice->sent_to==2) selected @endif>Students</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="title">Course<span class="text-danger">*</span></label>
                                                <select class="form-control" name="course_id">
                                                    <option value="">Select</option>
                                                    @foreach($courses as $course)
                                                    <option value="{{ $course->id }}" @if($notice->course_id==$course->id) selected @endif>{{ $course->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
        
                                        <div class="form-group col-12">
                                            <label for="description">Notice details<span class="text-danger">*</span></label>
                                            <textarea type="text" name="description" class="form-control" id="summernote" rows="10">{{ $notice->description }}</textarea>
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
