<!-- It is never too late to be what you might have been. - George Eliot -->
@extends('backend.layouts.master')
@section('title', 'About Item Detail')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>About Item Detail</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.about-item.index') }}" class="btn btn-primary float-right">
                        About Item List
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
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $about_item->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Thumbnail</th>
                                        <td>
                                            <img src="{{ asset($about_item->thumbnail) }}" width="80">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $about_item->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Short Description</th>
                                        <td>{{ $about_item->short_description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Video</th>
                                        <td>{!! $about_item->video !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Long Description</th>
                                        <td>{!! $about_item->long_description !!}</td>
                                    </tr>
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

