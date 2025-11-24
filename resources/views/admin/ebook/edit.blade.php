<!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
@extends('backend.layouts.master')
@section('title', 'Edit Ebook')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Ebook</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.ebook.index') }}">Back</a></li>
                        <li class="breadcrumb-item active">Edit Ebook</li>
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
                        <form action="{{ route('admin.ebook.update', $ebook->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" class="form-control" id="photo" value="{{ old('photo') }}"
                                    placeholder="Enter Photo" name="photo">
                                    <label class="form-label">Old Photo</label>
                                    <div class="mb-2">
                                        <img src="{{ asset($ebook->photo) }}" width="80">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" value="{{ old('title') ?? $ebook->title }}"
                                    placeholder="Enter Title" name="title">
                                </div>
                                 <!-- PDF upload -->
        <div class="form-group">
            <label for="pdf">PDF File</label>
            <input type="file" class="form-control" id="pdf" value="{{ old('pdf') }}" placeholder="Upload PDF" name="pdf">
            @if ($ebook->pdf) 
                <label class="form-label">Old PDF</label>
                <div class="mb-2">
                    <a href="{{ asset($ebook->pdf) }}" target="_blank">View Old PDF</a>
                </div>
            @endif
        </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" rows="3" placeholder="Enter Description"
                                    name="description">{{ old('description') ?? $ebook->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" value="{{ old('price') ?? $ebook->price }}"
                                    placeholder="Enter Price" name="price">
                                </div>
                                <div class="form-group">
                                    <label for="buy">Buying Status</label>
                                    <select class="form-control" id="buy" value="{{ old('buy') }}" name="buy">
                                        <option value="">Select A Status</option>
                                        <option value="Paid" {{ $ebook->buy == 'Paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="Free" {{ $ebook->buy == 'Free' ? 'selected' : '' }}>Free</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select class="form-control" id="level" value="{{ old('level') }}" name="level">
                                        <option value="">Select A Level</option>
                                        <option value="Beginner" {{ $ebook->level == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="Advanced" {{ $ebook->level == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                    </select>
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

