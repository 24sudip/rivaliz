@extends('backend.layouts.master')
@section('title', 'Affiliate List')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Affiliate List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Affiliate</li>
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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Percentage & Validity</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($affiliate as $key => $item)
                                        <tr>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if ($item->status == 0)
                                                            <form action="{{ route('admin.affiliate.active', $item) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.affiliate.inactive', $item) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item"
                                                                    type="submit">Inactive</button>
                                                            </form>
                                                        @endif
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.editAdmin', $item) }}">Edit</a>
                                                        <form action="{{ route('admin.affiliate.delete', $item) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="dropdown-item" type="submit"
                                                                onclick="return(confirm('Are you sure want to delete this item?'))">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->address }}</td>
                                            <td>{{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal_{{ $item->id }}">
                                                    @if ($item->percentage && $item->validity)
                                                        {{ $item->percentage . '% - ' . $item->validity . ' days' }}
                                                    @else
                                                        {{ 'Not set yet' }}
                                                    @endif
                                                </button>
                                                <div class="modal fade" id="exampleModal_{{ $item->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Percentage
                                                                    and Validity for every course
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('admin.affiliate.setPercentageAndValidity') }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $item->id }}">
                                                                    <div class="form-group">
                                                                        <label for="percentage">Percentage(%)</label>
                                                                        <input type="number" class="form-control"
                                                                            id="percentage" placeholder="5" required
                                                                            name="percentage" min="1" max="999999999"
                                                                            value="{{ $item->percentage ?? '' }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="validity">Validity(days only)</label>
                                                                        <input type="number" class="form-control"
                                                                            id="validity" placeholder="15" required
                                                                            name="validity" min="1" max="999999999"
                                                                            value="{{ $item->validity ?? '' }}">
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Submit</button>
                                                                </form>
                                                            </div>
                                                            {{-- <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><img src="{{ asset($item->image) }}" height="50" width="50"
                                                    alt=""></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $affiliate->links() }}
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
