@extends('backend.layouts.master')
@section('title', 'Notice')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Notice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Notice</li>
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
                            <a href="{{ route('admin.events.create') }}" class="btn btn-outline-primary">Add
                                Notice</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Thumbnil Image</th>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                        <th>Modified_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">

                                                         <form action="{{ route('admin.events.delete', $event->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Delete
                                                                    Notice</button>
                                                            </form>
                                                             {{-- active&inactive --}}
                                                        @if ($event->status === 1)
                                                            <form action="{{ route('admin.events.inactive', $event->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Inactive
                                                                    Notice</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.events.active', $event->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active
                                                                    Notice</button>
                                                            </form>
                                                        @endif

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.events.edit', $event->id) }}">Edit
                                                            Notice</a>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <img src="{{ asset($event->image) }}" style="height: 100px;width:100px;">
                                            </td>
                                            <td>{{ $event->title }}</td>
                                            <td>{{ $event->location }}</td>
                                            <td>{{ $event->date }} <br> {{ $event->time }}</td>
                                            <td>{{ $event->status === 1 ? 'Active' : 'Inactive' }}</td>

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
