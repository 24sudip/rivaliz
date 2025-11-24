@extends('frontend.student.studentmaster')
@section('title', 'Support Instructors')
@section('content')
<style>
@media (max-width: 576px) {
    .q-t{
        width:180% !important;
    }
}
  
</style>

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Your submitted Quizzes  </h4>

                                <div class="table-responsive">
                                  <table class="table table-striped q-t">
                                    <thead style="background-color:#ddd;">
                                        <tr>
                                            <th>Sl.</th>
                                            <th>Quiz Name</th>
                                            <th>Total Question</th>
                                            <th>Correct Answers</th>
                                            {{-- <th>Grade</th> --}}
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($submitted as $submit)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ @$submit->quiz->name }}</td>
                                                <td>{{ $submit->totalquestion }}</td>
                                                <td>{{ $submit->rightanswer }}</td>
                                                {{-- <td class="text-dark">
                                                    <b>{{ number_format(($submit->rightanswer * 100) / $submit->totalquestion) }}</b>%
                                                </td> --}}
                                                <td>
                                                    <a style="background-color:#7d37ce !important;" href="/student/enrolled/quiz/{{ $submit->quiz_id }}/answers" class="btn btn-sm btn-primary">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
