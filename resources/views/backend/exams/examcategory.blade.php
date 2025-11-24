@extends('backend.layouts.master')
@section('title', 'Quiz Category')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quiz Category List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Quiz Category</li>
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
                            <a href="{{ route('admin.courses.createexamcatgeory') }}" class="btn btn-outline-primary">
                                Add Quiz Category
                            </a>
                            <br>
                            <br>
                          <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                         <td class="d-flex justify-content-between">
                                                   <a href="{{ route('admin.courses.editexamcatgeory', $category->id) }}"
                                                    class="btn btn-info btn-xs"> <i class="fas fa-edit"></i> </a>


                                                     <form action="{{ route('admin.courses.deleteexamcatgeory', $category->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit"
                                                            onclick="return(confirm('Are you sure want to Delete this item?'))"
                                                            class="btn btn-danger btn-xs"> <i
                                                                class="far fa-trash-alt"></i>
                                                        </button>
                                                    </form>

                                                {{-- @if ($category->status === 1)
                                                    <form action="{{ route('admin.category.inactive', $category) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit"
                                                            onclick="return(confirm('Are you sure want to INACTIVE this item?'))"
                                                            class="btn btn-danger btn-xs"> <i
                                                                class="far fa-thumbs-down"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.category.active', $category) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit"
                                                            onclick="return(confirm('Are you sure want to Active this item?'))"
                                                            class="btn btn-info btn-xs"> <i class="far fa-thumbs-up"></i>
                                                        </button>
                                                    </form>
                                                @endif --}}
                                            </td>
                                            <td>
                                                @if ($category->image)
                                                <img src="{{ asset($category->image) }}" height="50" width="50">
                                                @else
                                                Not Found 
                                                @endif
                                            </td>
                                            <td>{{ $category->name }} </td>
                                            {{-- <td>{{ $category->is_active }}</td> --}}
                                            <td>{{ $category->created_at }}</td>
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
