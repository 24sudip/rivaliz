@extends('backend.layouts.master')
@section('title', 'Category')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Students</li>
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
                            {{-- <a href="{{ route('admin.courses.createfreevideos') }}" class="btn btn-outline-primary">Add Videos</a> --}}
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        
                                        {{-- <th>Action</th> --}}
                                        <th>Id</th>
                                        {{-- <th>Image</th> --}}
                                        <th>Student Name</th>
                                       {{-- <th>Device Limit</th>
                                        <th>Change Device</th>--}}
                                        <th>Phone</th>
                                        <th>Emails</th>
                                      {{--  <th>Manually Enrolled Course</th>--}}
                                        {{-- <th>Status</th> --}}
                                        <th>Created_at</th>
                                      {{--  <th>Device Ip</th>
                                        <th>Device Agent</th> --}}
                                      {{--  <th>Action</th> --}}
                                    </tr>
                                </thead>
                               <tbody>
                                    @foreach ($datas as $index => $data)
                                        <tr>
                                            {{-- <td class="d-flex justify-content-between">
                                                <a href="{{ route('admin.category.edit', $category) }}"
                                                    class="btn btn-info btn-xs"> <i class="fas fa-edit"></i> </a>
                                                    
                                          @if ($category->status === 1)
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
                                                @endif 
                                            </td> --}}
                                            {{-- <td>
                                                
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger btn-sm   dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    
                                                        
                                              
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
                                            </td>    --}}
                                            <td>{{$loop->iteration}}</td>
                                            {{-- <td><img src="{{ asset($category->image) }}" height="50" width="50"></td> --}}
                                           
                                            <td>{{ $data->name }} </td>
                                          {{--  <td>{{ $data->max_device }}</td>
                                            <td>
                                                <form action="{{ route('admin.courses.change.device', $data->id) }}" method="POST">
                                                    @csrf
                                                    <div class="dropdown">
                                                      <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" 
                                                      aria-expanded="false">
                                                        Select Limit
                                                      </button>
                                                      <div class="dropdown-menu">
                                                        <button name="max_device" value="1" class="dropdown-item" type="submit">1</button>
                                                        <button name="max_device" value="2" class="dropdown-item" type="submit">2</button>
                                                      </div>
                                                    </div>
                                                </form>
                                            </td>--}}
                                            <td>{{ $data->phone }} </td>
                                            <td>{{ $data->email }} </td>
                                             {{-- <td>{{ $data->enrolledcourse }} </td>  --}}

 
{{-- Display enrolled course names --}}
{{--<td>
    @if(!empty($data->enrolledcourse_names))  
        <ul>
            @foreach($data->enrolledcourse_names as $courseName)
                <li>{{ $courseName }}</li>  
            @endforeach
        </ul>
    @else
        No courses enrolled 
    @endif
</td>--}}
                 


                                            {{-- <td>{{ $category->is_active }}</td> --}}
                                            <td>{{ $data->created_at }}</td>
                                            @php
                                                $user_devices = App\Models\UserDevice::where('user_id', $data->id)->get();
                                            @endphp
                                            
                                         {{--   @if($user_devices)
                                            <td>
                                                @foreach($user_devices as $user_device)
                                                <span>
                                                {{ $user_device->device_ip }}
                                                </span>
                                                <br>
                                                @endforeach
                                            </td>
                                            @else
                                            <td>None</td>
                                            @endif
                                            
                                            @if($user_devices)
                                            <td>
                                                @foreach($user_devices as $user_device)
                                                <span>
                                                {{ preg_match('/(android|iphone|ipad|ipod|blackberry|windows phone|opera mini|mobile)/i', 
                                                    $user_device->device_agent) ? 'Mobile' : 'Desktop' }}
                                                </span>
                                                <br>
                                                @endforeach
                                            </td>
                                            @else
                                            <td>None</td>
                                            @endif
                                            --}}
                                          {{--  <td>
                                                <form action="{{ route('admin.courses.student.delete', $data->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger" type="submit"
                                                        onclick="return(confirm('Are you sure want to delete this item?'))">Delete</button>
                                                </form>
                                            </td> --}}
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
