@extends('backend.layouts.master')
@section('title', 'Supports')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Supports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Supports</li>
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
                            
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Course</th>
                                        <th>Student</th>
                                        <th>Issue</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supports as $support)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $support->course->name }}
                                            </td>

                                            <td>
                                                {{ $support->student->name }} <br> 
                                                {{ $support->student->email }} <br>
                                            </td>
                                            

                                            <td><strong>{{ $support->subject }}</strong> <br> {{ $support->description }}</td>
                                            <td>
                                                @if($support->status)
                                                <a class="btn btn-info btn-sm" disabled>Solved</a>
                                                @else
                                                <a href="{{ route('instructor.support.active', $support->id) }}" onclick="return confirm('Have you solved it?')" class="btn btn-danger btn-sm">Solved?</a>
                                                @endif
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
