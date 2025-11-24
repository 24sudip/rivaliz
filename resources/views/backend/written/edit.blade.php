<!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
@extends('backend.layouts.master')

@section('title', 'Edit Written')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Written </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Written </li>
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
                        <form action="{{ route('admin.written.update', $written->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Written Category<span class="text-danger">*</span></label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="written_category_id"
                                                required>
                                                <option value="" selected>--Written category--</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $written->written_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quiz Category<span class="text-danger">*</span></label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="quizcategory_id"
                                                required>
                                                <option value="" selected>--Quiz category--</option>
                                                @foreach ($quizcategories as $quizcategory)
                                                    <option value="{{ $quizcategory->id }}" {{ $written->quizcategory_id == $quizcategory->id ? 'selected' : '' }}>{{ $quizcategory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quiz Subcategory<span class="text-danger">*</span></label>
                                            <select class="form-control select2bs4" data-placeholder="Quiz subcategory"
                                                style="width: 100%" name="quizsubcategory_id" required>
                                                <option value="{{ $written->quizsubcategory_id }}">{{ $written->quizsubcategory->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Written Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image"
                                                        id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                            @if ($written->image)
                                            <img src="{{ asset($written->image) }}" width="100">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="question_name">Question Name</label>
                                            <input type="text" class="form-control" id="question_name"
                                                value="{{ old('question_name', $written->question_name) }}" placeholder="Question name" name="question_name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="answer">Answer<span class="text-danger">*</span></label>
                                            <textarea placeholder="answer" name="answer" class="form-control" id="summernote"
                                            rows="10">{{ old('answer', $written->answer) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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
@endsection

@section('jsScript')
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="quizcategory_id"]').on('change', function() {
            var quizcategory_id = $(this).val();
            if (quizcategory_id) {
                $.ajax({
                    url: "{{ url('/general/quizsubcategory/') }}/" + quizcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="quizsubcategory_id"]').empty();
                        $('select[name="quizsubcategory_id"]').append(
                            '<option value="">select</option>');
                        $.each(data, function(key, value) {
                            $('select[name="quizsubcategory_id"]').append(
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

