<!-- Simplicity is an acquired taste. - Katharine Gerould -->
@extends('backend.layouts.master')

@section('title', 'Written')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Written List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Written </li>
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
                            <a href="{{ route('admin.written.create') }}" class="btn btn-outline-primary">
                                Add Written
                            </a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Image</th>
                                        <th>Question Name</th>
                                        <th>Quizcategory</th>
                                        <th>Quizsubcategory</th>
                                        <th>Written Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($writtens as $written)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{ route('admin.written.edit', $written) }}"
                                                class="btn btn-info btn-xs"> <i class="fas fa-edit"></i> </a>

                                                <form action="{{ route('admin.written.destroy', $written) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return(confirm('Are you sure you want to Delete this item?'))"
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
                                                @if ($written->image)
                                                <img src="{{ asset($written->image) }}" width="50">
                                                @else
                                                Not Found
                                                @endif
                                            </td>
                                            <td>{{ $written->question_name }} </td>
                                            <td>
                                                {{ $written->quizcategory->name }}
                                            </td>
                                            <td>{{ $written->quizsubcategory->name }}</td>
                                            <td>{{ $written->written_category->name }}</td>
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
