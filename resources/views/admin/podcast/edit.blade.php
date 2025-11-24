<!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
@extends('backend.layouts.master')
@section('title', 'Edit Podcast')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Podcast</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.podcast.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Podcast</li>
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
                        <form action="{{ route('admin.podcast.update', $podcast->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" class="form-control" id="photo" value="{{ old('photo') }}"
                                    placeholder="Enter Photo" name="photo">
                                    <label class="form-label">Old Photo</label>
                                    <div class="">
                                        <img src="{{ asset($podcast->photo) }}" width="80">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" value="{{ old('title') ?? $podcast->title }}"
                                    placeholder="Enter Title" name="title">
                                </div>
                                <div class="form-group">
    <label for="category_id">Select Category</label>
    <select class="form-control" id="category_id" name="category_id" required>
        <option value="">-- Select Category --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ (old('category_id') ?? $podcast->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
                                <div class="form-group">
                                    <label for="audio">Audio</label>
                                    <input type="file" class="form-control" id="audio" value="{{ old('audio') }}"
                                    placeholder="Enter Audio" name="audio">
                                    <label class="form-label">Old Audio</label>
                                    <div class="">
                                        <audio src="{{ asset($podcast->audio) }}" controls></audio>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" rows="4" placeholder="Enter Description"
                                    name="description">{{ old('description') ?? $podcast->description }}</textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
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

