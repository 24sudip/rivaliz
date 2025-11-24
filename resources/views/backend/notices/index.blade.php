@extends('backend.layouts.master')
@section('title', 'Notices')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Notices</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Notices</li>
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
                            <a href="{{ route('admin.notice.create') }}" class="btn btn-outline-primary">Add
                                Notices</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>For</th>
                                        <th>Status</th>
                                        <th>Modified_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notices as $notice)
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
                                                        @if ($notice->status === 1)
                                                            <form action="{{ route('admin.notice.inactive', $notice->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Inactive Notice</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.notice.active', $notice->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active Notice</button>
                                                            </form>
                                                        @endif

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.notice.edit', $notice->id) }}">Edit Notice</a>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $notice->title }}</td>
                                            <td>{!! $notice->description !!}</td>
                                            <td>@if($notice->sent_to==0) All @elseif($notice->sent_to==1) Instructors @elseif($notice->sent_to==2) Students @endif</td>
                                            <td>{{ $notice->status === 1 ? 'Active' : 'Inactive' }}</td>

                                            <td>{{ $notice->updated_at->diffForhumans() }}</td>
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
