<!-- When there is no desire, all things are at peace. - Laozi -->
@extends('backend.layouts.master')

@section('title', 'Package-Payment List')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Package-Payment List</h1>
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
                                        <th>Student Name</th>
                                        <th>Total Amount</th>
                                        <th>Package Name</th>
                                        <th>Invoice No</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($package_payments as $key => $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->student->name }}</td>

                                            <td>{{ $item->total_amount }}</td>
                                            <td>{{ $item->package->title }}</td>
                                            <td>{{ $item->invoice_no }}</td>
                                            <td>{{ $item->order_date }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                <span class="badge bg-success">Paid</span>
                                                @else
                                                <span class="badge bg-danger">Unpaid</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if ($item->status == 0)
                                                            <form action="{{ route('admin.package-payment.active', $item) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Paid</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.package-payment.inactive', $item) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item"
                                                                    type="submit">Unpaid</button>
                                                            </form>
                                                        @endif
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

