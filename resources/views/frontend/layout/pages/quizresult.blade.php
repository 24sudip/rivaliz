@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>All Quiz - {{ env('APP_NAME') }}</title>
    @endsection

    
    
    <!-- quizresult  -->

    <section>

        <h2>Quiz Results</h2>

        
        <div class="container pt-100">
          <div class="row mt-5">
            <div class="col-lg-12">
              <h1 class="text-center mb-4">Quiz Results</h1>
            </div>
          </div>
          <div class="row gap mt-5 mb-5">
            <div class="col-lg-6 col-md-6">
              <div class="quikctech-quiz-pass text-center">
                <img src="images/check.gif" alt="">
                <h4>Nice Job, Your Score</h4>

                 {{-- Quiz ID from session (optional, you can display it if you want) --}}
                
                 @php
                 $quizId = session('quiz_id');
                 $quiz = $quizId ? \App\Models\Quiz::with('questions')->find($quizId) : null;
             @endphp
                    {{-- <h1>{{  $quiz->amount }}</h1> --}}
                    
                
                @php
                // Define total questions and correct answers count
                $totalQuestions = count($questions);
                $correctCount = 0;
            
                // Calculate correct answers
                foreach($answers as $index => $answer) {
                    if(isset($correctAnswers[$index])) {
                        foreach($correctAnswers[$index]->options as $option) {
                            if($option->isAnswer && $option->option == $answer) {
                                $correctCount++;
                            }
                        }
                    }
                }
            
                // Calculate score percentage
                $scorePercentage = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100, 2) : 0;
            
                // Define passing score and points
                // $passingScore = 50; // You can modify this dynamically
                // $totalPoints = 10;   // Total points for the quiz (can be dynamic)
                // $passingPoints = 7;  // Required points to pass

                $passingScore = $quiz->passingscore; // You can modify this dynamically
                $totalPoints = count($questions);   // Total points for the quiz (can be dynamic)
                $passingPoints =  $quiz->passingpoint; 
            
                // Calculate earned points based on correct answers
                $earnedPoints = round(($correctCount / $totalQuestions) * $totalPoints);
            @endphp
            
                <div class="row gap mt-5">
                  <div class="col-lg-6 col-sm-6">
                    <div class="quikctech-pass-score">
                      {{-- <h5>Your Score <br> 100%</h5>
                      <hr>
                      <p>Passing score: 50%</p> --}}
                      <h5>Your Score <br> {{ $scorePercentage }}%</h5>
                      <hr>
                      <p>Passing score: {{ $passingScore }}%</p>
                    </div>
                  </div>
                  <div class="col-lg-6 col-sm-6">
                    <div class="quikctech-pass-score">
                      {{-- <h5>Your Points <br> 10</h5>
                      <hr>
                      <p>Passing Point: 7</p> --}}
                      <h5>Your Points <br> {{ $earnedPoints }}</h5>
                      <hr>
                      <p>Passing Point: {{ $passingPoints }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">

                <div id="quizResults" class="mb-4">

                    {{-- Quiz ID from session (optional, you can display it if you want) --}}
                    {{-- 
                    @php
                        $quizId = session('quiz_id');
                    @endphp
                    <h1>{{ $quizId }}</h1>
                    --}}
                
                    <div id="quicktech-questions">
                        {{-- @foreach($correctAnswers as $index => $question)
                            <div data-question="Question {{ $index + 1 }}: {{ $question->question }}" 
                                 data-options="{{ $question->options->pluck('option')->implode(',') }}">
                                <strong>Correct Answer: </strong>
                                @foreach($question->options as $option)
                                    @if($option->isAnswer)
                                        <span class="text-success">{{ $option->option }}</span>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div> --}}
                
                    {{-- Display quiz results --}}
           {{-- Display quiz results --}}
@if (!empty($answers) && !empty($questions))
@foreach($answers as $index => $answer)
    <div class="mb-3 quicktech-quiz-result">
        <h5>{{ $questions[$index] }}</h5>
        <p><strong>Your Answer:</strong> 
            @php
                $correctAnswer = $correctAnswers[$index] ?? null;
                $isCorrect = false;
            @endphp

            {{-- Check if the user's answer matches the correct answer --}}
            @if($correctAnswer)
                @foreach($correctAnswer->options as $option)
                    @if($option->isAnswer && $option->option == $answer)
                        @php $isCorrect = true; @endphp
                    @endif
                @endforeach
            @endif

            {{-- Show answer with correct/wrong color --}}
            @if($isCorrect)
                <span class="text-success">{{ $answer }} ✅ (Correct)</span>
            @else
                <span class="text-danger">{{ $answer }} ❌ (Wrong)</span>
            @endif
        </p>

        {{-- Display the correct answer --}}
        @if($correctAnswer)
            <p><strong>Correct Answer:</strong> 
                @foreach($correctAnswer->options as $option)
                    @if($option->isAnswer)
                        <span class="text-success">{{ $option->option }}</span>
                    @endif
                @endforeach
            </p>
        @endif
    </div>
@endforeach
@else
<p>No quiz results available.</p>
@endif
                </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- quizresult -->

@endsection