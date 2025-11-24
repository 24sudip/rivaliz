@extends('backend.layouts.master')
@section('title', 'Courses')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Orders</h1>
                </div>
                {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Courses</li>
                    </ol>
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
                           {{-- <a href="{{ route('admin.courses.create') }}" class="btn btn-outline-primary">Add
                                Courses</a>  
                            <br>
                            <br>--}}
                        <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        {{-- <th>Action</th> --}}
                                        <th>Order Id</th>
                                        <th>Student Name</th>
                                        <th>Course Title</th>
                                        {{-- <th>Course Id</th> --}}
                                        <th>Total</th>
                                        <th>Discount</th>
                                        <th>Coupon Code </th>
                                        <th>Payment Method</th>
                                   
                                        <th>Ordered_at</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                           {{-- <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger btn-sm   dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.courses.modules', $course->id) }}">Modules</a>

                                                        @if ($course->status === 1)
                                                            <form
                                                                action="{{ route('admin.courses.inactive', $course->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Inactive
                                                                    Course</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.courses.active', $course->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active
                                                                    Course</button>
                                                            </form>
                                                        @endif

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.courses.edit', $course->id) }}">Edit
                                                            Course</a>


                                                        <form action="{{ route('admin.courses.delete', $course) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button class="dropdown-item"
                                                                onclick="return confirm('Are you sure want to delete this item?')"
                                                                type="submit">Delete
                                                                Course</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td> --}}
                                            <td>
                                                {{$order->id}}
                                            </td>
                                            <td>
                                                {{$order->student->name ?? ''}}

                                            </td>
                                            <td>
                                            @foreach ($order->orderDetails as $detail)
                                            {{ $detail->course->name ?? 'No Course' }} <br>
                                        @endforeach
                                    </td>
                                            {{-- <td>
                                                @foreach ($order->courses as $course)
                                                {{ $course->name }}<br>
                                            @endforeach
                                            </td> --}}
                                            <td>
                                                {{$order->total}}
                                            </td>
                                            <td>
                                                {{$order->discount}}

                                            </td>
                                            <td>
                                                {{$order->coupon_code}}

                                            </td>

                                            
                                           

                                            {{-- <td>
                                                 
                                                @foreach ($order->orderDetails as $detail)
                                                     {{ $detail->course_id }} 
                                                 @endforeach
                                             </td> --}}
                                             
                                           
                                            <td>
                                               {{-- {{$order->payment_method}} --}}
                                               Online Payment
                                            </td>
                                           
                                               
                                                
                                            <td>
                                                {{$order->created_at->diffForhumans()}}
                                          
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                 {{--   <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger btn-sm   dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.courses.modules', $course->id) }}">Modules</a>

                                                        @if ($course->status === 1)
                                                            <form
                                                                action="{{ route('admin.courses.inactive', $course->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Inactive
                                                                    Course</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.courses.active', $course->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active
                                                                    Course</button>
                                                            </form>
                                                        @endif

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.courses.edit', $course->id) }}">Edit
                                                            Course</a>


                                                        <form action="{{ route('admin.courses.delete', $course) }}"
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
                                                <img src="{{ asset($course->thumbnil_image) }}"
                                                    style="height: 100px;width:100px;">
                                            </td>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ $course->status === 1 ? 'Y' : 'N' }}</td>
                                            <td>
                                                Commision: {{ $course->instructor_commision }}% <br>
                                                Amount: {{ $course->commision_amount }} <br>
                                                Due: {{ $course->commision_due }} <br>
                                            </td>
                                            <td>
                                                Price: <small> <del>{{ $course->old_price }}</del> </small> {{ $course->price }}  <br>
                                                Sold: {{ $course->enrolled }} <br>
                                                Revenue:
                                                {{ $course->enrolled * $course->price - $course->commision_amount }}
                                            </td>
                                            <td>
                                                Category: {{ $course->category->name }} <br>
                                                Subcategory: {{ $course->subcategory->name ?? '' }} <br>
                                                Childcategory: {{ $course->childcategory->name ?? 'Not set' }} <br>
                                                Childsubcategory: {{ $course->childsubcategory->name ?? 'Not set' }}
                                            </td>
                                            <td>{{ $course->updated_at->diffForhumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody> --}}
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
