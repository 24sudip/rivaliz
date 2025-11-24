@extends('frontend.student.studentmaster')
@section('title', 'Edit Resume')
@section('content')


    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card" style="background-color: #FFF;">
                        <div class="container">
                            <h1 class="p-3 mb-3 border-bottom border-secondary">Add Achievement</h1>

                            <form class="form-horizontal" role="form" action="{{ route('student.achievementstore') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">


                                    <!-- edit form column -->
                                    <div class="col-md-6 personal-info">

                                        <h3>Achievement info</h3>


                                        <div class="form-group">
                                            <label class="col-md-12 control-label">Name:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="name">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12 control-label">Details:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="details">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12 control-label">Link:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="link">
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
