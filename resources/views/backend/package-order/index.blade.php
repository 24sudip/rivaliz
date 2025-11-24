<!-- An unexamined life is not worth living. - Socrates -->
@extends('backend.layouts.master')

@section('title', 'Package Order List')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Package Order List</h1>
                </div>
                <div class="col-sm-6">
                    {{-- <a href="{{ route('admin.ads.category.create') }}" class="btn btn-primary float-right">Add New
                        Category</a> --}}
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
                                        <th>Invoice No</th>
                                        <th>Student Name</th>
                                        <th>Package</th>
                                        <th>Expired At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($package_orders as $key => $package_order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $package_order->package_payment->invoice_no }}</td>

                                            <td>{{ $package_order->student->name }}</td>

                                            <td>
                                                {{ $package_order->package->title }}
                                            </td>
                                            <td>{{ $package_order->expired_at }}</td>
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

