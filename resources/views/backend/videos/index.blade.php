@extends('backend.layouts.master')
@section('title', 'Category')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Video List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
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
                            <a href="{{ route('admin.courses.createfreevideos') }}" class="btn btn-outline-primary">Add Videos</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        
                                        <th>Action</th>
                                        <th>Id</th>
                                        {{-- <th>Image</th> --}}
                                        <th>Category Name</th>
                                        <th>Video link </th>
                                        <th>Status</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                           <tbody>
                                    @foreach ($datas as $index => $data)
                                        <tr>
                                             {{-- <td class="d-flex justify-content-between">
                                          <a href="{{ route('admin.category.edit', $category) }}"
                                                    class="btn btn-info btn-xs"> <i class="fas fa-edit"></i> </a> 
                                                    
                                                @if ($data->status == 0)
                                                    <form action="{{ route('admin.ads.freevideos.active', $data) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="dropdown-item" type="submit">Active</button>
                                                    </form>
                                               @else
                                                    <form action="{{ route('admin.ads.freevideos.inactive', $data) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="dropdown-item"
                                                            type="submit">Inactive</button>
                                                    </form> 
                                                   
                                                @endif  
                                            </td>
                                          <td> --}}
                                                <!-- Example single danger button -->
                                          <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger btn-sm   dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    
                                                        
                                                        @if ($data->status == 0)
                                                        <form action="{{ route('admin.ads.freevideos.active', $data) }}"
                                                            method="post">
                                                            @csrf
                                                            <button class="dropdown-item" type="submit">Active</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('admin.ads.freevideos.inactive', $data) }}"
                                                            method="post">
                                                            @csrf
                                                            <button class="dropdown-item"
                                                                type="submit">Inactive</button>
                                                        </form> 
                                                       
                                                    @endif  
                                                        <form action="{{ route('admin.courses.deletefreevideos', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button class="dropdown-item"
                                                                onclick="return confirm('Are you sure want to delete this item?')"
                                                                type="submit">Delete
                                                                Course</button>
                                                        </form> 
                                                    </div>
                                                </div>
                                            </td>   
                                            <td>{{$loop->iteration}}</td>
                                            {{-- <td><img src="{{ asset($category->image) }}" height="50" width="50"></td> --}}
                                           
                                            <td>{{ $data->category->name }} </td>
                                            <td>{{ $data->video }} </td>
                                            <td>{{ $data->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ $data->created_at }}</td>
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
