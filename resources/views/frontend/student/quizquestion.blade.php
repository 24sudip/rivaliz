@extends('frontend.student.studentmaster')
@section('title', 'Enrolled Courses')
@section('content')

    <style>
        .quiz,
        .choices {
            list-style-type: none;
        }

        .choices li {
            margin-bottom: 5px;
        }

        .choices label {
            display: flex;
            align-items: center;
        }

        .choices label,
        input[type="radio"] {
            cursor: pointer;
        }

        input[type="radio"] {
            margin-right: 8px;
        }
    </style>

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="row">
                    <div class="col-12 grid-margin mx-auto my-auto">
                        <div class="card">
                            <div class="py-3 px-4">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mb-0">{{ $quiz->name }}</h4>

                                    <p class="card-text">Duration: {{ $quiz->timer }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-4 card">
                    <form action="{{ Route('student.quizsubmit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                        <ol class="quiz row py-4">
                            @foreach ($questions as $question)
                                <li class="col-md-6 mb-3">
                                    @if ($question->image)
                                        <a href="{{ asset($question->image) }}" style="width: inherit;"
                                            class="float-end me-3">
                                            <img src="{{ asset($question->image) }}" style="width: inherit;"
                                                class="float-end me-3">
                                        </a>
                                    @endif
                                    <h4 class="text-dark">{{ $loop->iteration }}. {{ $question->question }}</h4>
                                    <ul class="choices">
                                        @foreach ($question->options as $option)
                                            <li><label><input type="radio" name="{{ $question->id }}"
                                                        value="{{ $option->id }}"><span>{{ $option->option }}</span></label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach

                            <div>
                                <input type="submit" onclick="return confirm('Are you sure to submit?')"
                                    class="btn btn-primary mt-4" value="Submit">
                            </div>

                        </ol>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
