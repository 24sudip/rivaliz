<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
@extends('backend.layouts.master')
@section('title', 'Contact List')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contact List</h1>
                </div>
                {{-- <div class="col-sm-6">
                    <a href="{{ route('admin.ads.category.create') }}" class="btn btn-primary float-right">Add New
                        Category</a>
                </div> --}}
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
                            <table  class="table table-bordered table-striped" id="example1">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $key => $contact)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->subject }}</td>
                                            <td>{{ $contact->message }}</td>
                                            <td>{{ $contact->created_at }}</td>

                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Select
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        {{-- @if ($item->status == 0)
                                                            <form action="{{ route('admin.ads.category.active', $item) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.ads.category.inactive', $item) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item"
                                                                    type="submit">Inactive</button>
                                                            </form>
                                                        @endif --}}
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.contact.edit', $contact->id) }}">Show</a>
                                                        <form action="{{ route('admin.contact.delete', $contact->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
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
