@extends('frontend.student.studentmaster')
@section('title', 'Enrolled Courses')
@section('content')

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="row">
                    <div class="col-md-4 grid-margin stretch-card mx-auto my-auto">
                        <div class="card">
                            <a href="{{ route('student.quizquestion', ['id' => $quiz->id]) }}" class="stretched-link"></a>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title">{{ $quiz->name }}</h4>
                                </div>
                                <div class="media d-flex justify-content-between">
                                    <div>
                                        <span>
                                            Total {{ $question }} questions
                                        </span>
                                        <div class="media-body">
                                            <p class="card-text">Duration: {{ $quiz->timer }}</p>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <button class="btn btn-danger text-light">Start</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
