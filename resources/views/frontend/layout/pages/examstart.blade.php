@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>All Exams - {{ env('APP_NAME') }}</title>
    @endsection

  
      
      <section id="quicktech-ex-st" style="background: url(./images/eee.jpg) no-repeat center / cover; padding-bottom: 40px; height: 100vh;">
        <div class="container quikctech-mob-padding" id="quicktech-container">
            {{-- <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="quicktech-quesandans-head text-center">
                        <h1>Answer Your Questions</h1>
                        <h4 id="quicktech-timer">Timer: {{$quiz->timer }}</h4>
                    </div>
                </div>
            </div> --}}

            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="quicktech-quesandans-head text-center">
                        <h1>Answer Your Questions</h1>
                        <h4 id="quicktech-timer">Timer: {{$quiz->timer}} seconds</h4>
                    </div>
                </div>
            </div>
            
            <script>
                // Get the timer value from the Blade variable
                let timer = {{$quiz->timer}};
                
                // Function to format the timer as MM:SS
                function formatTime(seconds) {
                    let minutes = Math.floor(seconds / 60);
                    let secondsRemaining = seconds % 60;
                    return minutes + ":" + (secondsRemaining < 10 ? "0" + secondsRemaining : secondsRemaining);
                }
            
                // Update the displayed timer every second
                const timerElement = document.getElementById('quicktech-timer');
                const countdown = setInterval(function() {
                    if (timer <= 0) {
                        clearInterval(countdown);
                        timerElement.innerHTML = "Time's up!";
                        // Optionally trigger an event when the timer is up, like submitting the quiz
                        // Example: document.getElementById('submitQuizButton').click();
                    } else {
                        timerElement.innerHTML = "Timer: " + formatTime(timer);
                        timer--;
                    }
                }, 1000);
            </script>


        


<div id="quicktech-questions" style="display: none;">
            @foreach($questions as $index => $question)
            <div data-question="Question {{ $index + 1 }}: {{ $question->question }}" 
              data-options="{{ $question->options->pluck('option')->implode(',') }}">
         </div>
            @endforeach
        </div>


        


        
<div class="row gapp mt-4">
  <!-- Main Question Section -->
  <div class="col-lg-8">
      <div class="quicktech-progress" id="quicktech-progress"></div>
      <div class="quicktech-question" id="quicktech-question"></div>
      <div class="quicktech-options quicktech-option-padding" id="quicktech-options"></div>
      <div class="text-end">
          <button id="quicktech-prevBtn" style="display: none;">Previous</button>
          <button id="quicktech-nextBtn">Next</button>
          <button id="quicktech-submitBtn" style="display: none;">Submit</button>
      </div>
  </div>
  <!-- Question Navigation Sidebar -->
  <div class="col-lg-4">
      <div class="quicktech-question-list">
          <h3>Jump to Question</h3>
          <ul id="quicktech-questionNav"></ul>
      </div>
  </div>
</div>

<!-- ✅ Restored Answer Preview Modal -->
<div class="modal fade" id="quicktech-previewModal" tabindex="-1">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Review Your Answers</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="quizIdHidden" value="{{ $quiz->id }}">
              <ul id="quicktech-previewList"></ul>
          </div>
          <div class="modal-footer">
              {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit</button> --}}
              <button type="button" id="quicktech-confirmSubmitBtn" class="btn btn-primary">Confirm Submit</button>
          </div>
      </div>
  </div>
</div>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="quikctech-go-to-homepage text-center">
                        <a href="/">Go to Home Page</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
      


   <!-- exam start -->
   

@endsection