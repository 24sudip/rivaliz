


@extends('backend.layouts.master')
@section('title', 'Exams')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                
               
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
                         <div class="d-flex justify-content-between">
                                
                               
                                {{--<div>
                                    <a href="{{ route( 'admin.courses.exam.addexam') }}" class="btn btn-outline-primary"><i class="fa fa-plus"></i> Add Quizzes</a>
                                </div> --}}
                            </div> 
                            <br>
                            <br>
                     <!--id="example1"-->
                            <table  id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Student Name</th>
                                        <th>Exam </th>
                                        <th>Total Question </th>
                                        <th>Correct Answer</th>
                                         <th>Total Point</th>
                                        <th>Score Percentage</th>
                                        
                                       
                                        
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($examscores as $examscore)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $examscore->student->name }}</td>
                                          
                                            <td>{{ $examscore->quiz->name}}</td>
                                           <td>{{ $examscore->totalquestion}}</td>
                                            <td>{{ $examscore->rightanswer }}</td>
                                            <td>{{ $examscore->total_points }}</td>
                                            
                                            <td>{{ $examscore->score_percentage}}%</td>
                                           
                                           
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
