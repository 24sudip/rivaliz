@extends('frontend.student.studentmaster')
@section('title', 'Edit Resume')
@section('content')


    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card" style="background-color: #FFF;">
                        <div class="container">
                            <h1 class="p-3 mb-3 border-bottom border-secondary">Education Edit</h1>

                            <form class="form-horizontal" role="form" action="{{ route('student.educationupdate') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">

                                    <input type="hidden" name="hidden_id" value="{{ $education->id }}">
                                    <!-- edit form column -->
                                    <div class="col-md-6 personal-info">

                                        <h3>Education info
                                            <a href="{{ route('student.educationdelete', $education->id) }}"
                                                class="btn btn-sm text-white float-end btn-danger">Delete</a>
                                        </h3>


                                        <div class="form-group">
                                            <label class="col-md-12 control-label">Institute:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="institute"
                                                    value="{{ $education->institute }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12 control-label">Degree:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="degree"
                                                    value="{{ $education->degree }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12 control-label">Department:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="study"
                                                    value="{{ $education->study }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12 control-label">Grade:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="grade"
                                                    value="{{ $education->grade }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Start Date:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="date" name="start_date"
                                                    value="{{ $education->start_date }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-6 control-label">End Date:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="date" name="end_date"
                                                    value="{{ $education->end_date }}">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12 control-label"></label>
                                            <div class="col-md-12">
                                                <input type="submit" class="btn btn-primary" value="Save Changes">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
