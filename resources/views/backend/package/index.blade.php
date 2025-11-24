<!-- Order your soul. Reduce your wants. - Augustine -->
@extends('backend.layouts.master')

@section('title', 'Package List')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Package List</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.package.create') }}" class="btn btn-primary float-right">
                        Add New Package
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
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Price</th>
                                        <th>Duration Month</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $key => $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                <span class="badge bg-success">Active</span>
                                                @else
                                                <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->duration_month }}</td>

                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if ($item->status == 0)
                                                            <form action="{{ route('admin.package.active', $item) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.package.inactive', $item) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item"
                                                                    type="submit">Inactive</button>
                                                            </form>
                                                        @endif
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.package.edit', $item) }}">Edit</a>
                                                        <form action="{{ route('admin.package.destroy', $item) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
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

