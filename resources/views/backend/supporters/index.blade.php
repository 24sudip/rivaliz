@extends('backend.layouts.master')
@section('title', 'Courses')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Supporters</h1>
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
                           <a href="{{ route('admin.courses.supportercreate') }}" class="btn btn-outline-primary">Add
                              Supporter</a>  
                            <br>
                            <br>
                        <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                       <th>SerialId</th> 
                                        <th>Banner</th>
                                       
                                       
                                    </tr>
                                </thead>

                                    <tbody>
                                    @foreach ($supporters as $supporter)
                                        <tr>
                                        <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger btn-sm   dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    
                                                        
                                              
                                                        <form action="{{ route('admin.courses.supporterdelete', $supporter->id) }}"
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
                                            <td>
                                                {{$supporter->id}}
                                            </td>
                                            <td>
                                                <img src="{{ asset($supporter->image) }}" style="height: 120px;width:250px;">
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
