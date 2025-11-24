<!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
@extends('backend.layouts.master')
@section('title', 'About Item List')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>About Item List</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.about-item.create') }}" class="btn btn-primary float-right">
                        Add About Item
                    </a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Thumbnail</th>
                                        <th>Title</th>
                                        <th>Short Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($about_items as $key => $about_item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <img src="{{ asset($about_item->thumbnail) }}" width="80">
                                            </td>

                                            <td>{{ $about_item->title }}</td>
                                            <td>{{ $about_item->short_description }}</td>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Select
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        {{-- @if ($item->status == 0)
                                                            <form action="{{ route('admin.ads.category.active', $item) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.ads.category.inactive', $item) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item"
                                                                    type="submit">Inactive</button>
                                                            </form>
                                                        @endif --}}
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.about-item.show', $about_item->id) }}">Show</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.about-item.edit', $about_item->id) }}">Edit</a>
                                                        <form action="{{ route('admin.about-item.destroy', $about_item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="dropdown-item" type="submit"
                                                                onclick="return(confirm('Are you sure want to delete this item?'))">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

