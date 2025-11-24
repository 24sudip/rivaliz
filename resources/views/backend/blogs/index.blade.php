@extends('backend.layouts.master')
@section('title', 'Blogs')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Blogs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Blogs</li>
                    </ol>
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
                            <a href="{{ route('admin.blogs.create') }}" class="btn btn-outline-primary">Add
                                Blogs</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Thumbnil Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Modified_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $event)
                                        <tr>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        {{-- active&inactive --}}
                                                        @if ($event->status === 1)
                                                            <form action="{{ route('admin.blogs.inactive', $event->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Inactive
                                                                    Blog</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.blogs.active', $event->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active
                                                                    Blog</button>
                                                            </form>
                                                        @endif

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.blogs.edit', $event->id) }}">Edit
                                                            Blog</a>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <img src="{{ asset($event->image) }}" style="height: 100px;width:100px;">
                                            </td>
                                            <td>{{ $event->title }}</td>

                                            <td>{{ $event->status === 1 ? 'Y' : 'N' }}</td>

                                            <td>{{ $event->updated_at->diffForhumans() }}</td>
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
