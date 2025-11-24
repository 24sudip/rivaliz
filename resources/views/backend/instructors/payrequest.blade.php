@extends('backend.layouts.master')
@section('title', 'Instructors')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Instructor Pay Request</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Instructor Pay Request</li>
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
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Instructor</th>
                                        <th>Commision Due</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instructors as $instructor)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                
                                                <form action="{{ route('admin.instructors.duePayment', $instructor) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit"
                                                        onclick="return(confirm('Did you paid all the due?'))"
                                                        class="btn btn-danger btn-xs"> Pay </i>
                                                    </button>
                                                </form>



                                            </td>
                                            <td>
                                                <img src="{{ asset($instructor->image) }}" height="20" width="20">
                                                {{ $instructor->name }}
                                            </td>
                                            <td>{{ $instructor->commision_due }}</td>
                                            <td>Requested</td>
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
