<!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
@extends('backend.layouts.master')
@section('title', 'About Item edit area')
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
                    <h1>About Item Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">About Item</li>
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
                            <h3 class="card-title">Edit About Item goes here</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.about-item.update', $about_item->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image" class="form-label">About Thumbnail (Max 10 MB)</label>
                                            <input type="file" name="thumbnail" class="form-control" id="image"
                                            placeholder="Thumbnil Image" value="{{ old('thumbnail') }}"
                                            onchange="mainThumUrl(this)">
                                            <img src="" id="mainThmb">
                                        </div>
                                        <div class="form-group">
                                            <label for="image" class="form-label">Old About Thumbnail</label>
                                            <div class="mt-0">
                                                <img src="{{ asset($about_item->thumbnail) }}" alt="thumbnail" width="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title:<span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control" id="title"
                                                placeholder="Title" value="{{ $about_item->title }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="short_description">Short Description:<span class="text-danger">*</span></label>
                                            <textarea type="text" name="short_description" class="form-control" id="short_description"
                                            placeholder="Short Description">{{ $about_item->short_description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Video Code</label>
                                            <textarea type="text" name="video" class="form-control" {{-- id="summernote" --}}
                                            rows="4">{{ $about_item->video }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Long Description</label>
                                            <textarea type="text" name="long_description" class="form-control" id="summernote1" rows="10">{{ $about_item->long_description }}</textarea>
                                        </div>
                                    </div>
                                </div>


                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
    <script type="text/javascript">
    function mainThumUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#mainThmb").attr("src",e.target.result).width(100);
                // .height(80)
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

@section('jsScript')
{{-- submenu dependency --}}
@endsection

