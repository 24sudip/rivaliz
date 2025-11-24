@extends('frontend.student.studentmaster')
@section('title', 'Edit Resume')
@section('content')


    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card" style="background-color: #FFF;">
                        <div class="container">
                            <h1 class="p-3 mb-3 border-bottom border-secondary">Edit Resume</h1>

                            <form class="form-horizontal" role="form" action="{{ route('student.resumeupdate') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">


                                    <!-- edit form column -->
                                    <div class="col-md-6 personal-info">

                                        <h3>Resume info</h3>


                                        <div class="form-group">
                                            <label class="col-md-12 control-label">Title:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="title"
                                                    value="{{ $resume->title ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12 control-label">Designation:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="designation"
                                                    value="{{ $resume->designation ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-12 control-label">Summary:</label>
                                            <div class="col-lg-12">
                                                <textarea class="form-control" type="text" name="summary" rows="10">{{ $resume->summary ?? '' }}</textarea>
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
