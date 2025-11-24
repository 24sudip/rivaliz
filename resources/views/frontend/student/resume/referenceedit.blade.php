@extends('frontend.student.studentmaster')
@section('title', 'Edit Resume')
@section('content')


    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card" style="background-color: #FFF;">
                        <div class="container">
                            <h1 class="p-3 mb-3 border-bottom border-secondary">Edit Reference</h1>

                            <form class="form-horizontal" role="form" action="{{ route('student.referenceupdate') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">

                                    <input type="hidden" name="hidden_id" value="{{ $reference->id }}">
                                    <!-- edit form column -->
                                    <div class="col-md-6 personal-info">

                                        <h3>Reference info
                                            <a href="{{ route('student.referencedelete', $reference->id) }}"
                                                class="btn btn-sm text-white float-end btn-danger">Delete</a>
                                        </h3>


                                        <div class="form-group">
                                            <label class="col-md-12 control-label">Name:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="name"
                                                    value="{{ $reference->name }}">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12 control-label">Designation:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="designation"
                                                    value="{{ $reference->designation }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12 control-label">Phone:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="phone"
                                                    value="{{ $reference->phone }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12 control-label">E-Mail:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="email"
                                                    value="{{ $reference->email }}">
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
