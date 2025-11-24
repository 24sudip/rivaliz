<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
@extends('backend.layouts.master')
@section('title', 'Podcast List')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Podcast List</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.podcast.create') }}" class="btn btn-primary float-right">
                        Add New Podcast
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
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Photo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($podcasts as $key => $item)
                                    {{-- as $key => --}}
                                        <tr>
                                    
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <img src="{{ asset($item->photo) }}" width="80">
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
                                                            <form action="{{ route('admin.ads.podcast.active', $item) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active</button>
                                                            </form>
                                                       @else
                                                            <form action="{{ route('admin.ads.podcast.inactive', $item) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item"
                                                                    type="submit">Inactive</button>
                                                            </form> 
                                                           
                                                        @endif  
                                                        {{-- <form action="{{ route('admin.ads.podcast.inactive', $item) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item"
                                                                    type="submit">Inactive</button>
                                                            </form> --}}
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.podcast.edit', $item) }}">Edit</a>
                                                        <form action="{{ route('admin.podcast.destroy', $item) }}"
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

