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
                                    <h4 class="card-title mb-0">Answers of <b>{{ $quiz->name }}</b></h4>
                                    <p>Correct: {{ $quizSubmit->rightanswer }}</p>
                                    <p class="card-text">Questions: {{ $quizSubmit->totalquestion }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-4 card">
                    <ol class="quiz row py-4">
                        <div class="mb-4">
                            
                        </div>
                        @foreach ($questions as $question)
                            <li class="col-md-6 mb-3">
                                @if ($question->image)
                                    <a href="{{ asset($question->image) }}" style="width: inherit;" class="float-end me-3">
                                        <img src="{{ asset($question->image) }}" style="width: 80%;"
                                            class="float-end me-3">
                                    </a>
                                @endif
                                <h4 class="text-dark">{{ $loop->iteration }}. {{ $question->question }}</h4>
                                <ul class="choices">
                                    @foreach ($question->options as $option)
                                        @php
                                            $submittedAnswer = $submitanswers->firstWhere('question_id', $question->id);
                                            $isSubmitted =
                                                $submittedAnswer && $submittedAnswer->option_id == $option->id;
                                            $isCorrect = $isSubmitted && $submittedAnswer->isRight;
                                        @endphp
                                        <li>
                                            <label>
                                                <input type="radio" disabled
                                                    @if ($option->isAnswer) checked @endif
                                                    @if ($isSubmitted) checked @endif>
                                                <span
                                                    @if ($isSubmitted) class="{{ $isCorrect ? 'bg-success text-white px-1' : 'bg-danger text-white px-1' }}"
                                                    @else class="{{ $option->isAnswer ? 'bg-primary text-white px-1' : '' }}" @endif>
                                                    {{ $option->option }}
                                                </span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach

                    </ol>
                </div>
            </div>

        </div>
    </div>

@endsection
