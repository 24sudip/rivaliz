@extends('frontend.student.studentmaster')
@section('title', 'Enrolled Courses')
@section('content')
   <style>
        .progress {
            height: 30px;
            width: 100%; /* Adjust width as needed */
            
        }
        .progress-bar {
            font-size: 1.2em;
            line-height: 30px; /* Center text vertically */
        }
        
        .course-image {
            height: auto;
        }
        
        @media (max-width: 500px) {
            .course-image {
                height: 50px;
            }
        }
    </style>

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="row mx-2 gapp">
                    @foreach ($courses as $course)
                    <div class="card quicktech-height">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-2">
                                    <!--<img src="{{ asset($course->instructor->image) }}" alt="">-->
                                    <img src="{{ asset($course->thumbnil_image) }}" class="w-100 course-image" alt="">
                                </div>
                                <div style="padding-top:27px;" class="col-10 quicktech-main">
                                    <div class="quicktech-flex text-left">
                                        <a href="{{ route('student.coursedetails', ['id' => $course->id]) }}" class="stretched-link"></a>
                                        <div class="card-body p-0 p-md-3">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="card-title">{{ $course->name }}</h4>
                                                
                                            </div>
                                            
                <!-- <div class="progress">-->
                                                        <!--    <div class="progress-bar bg-success" role="progressbar" style="width: 60%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">40%</div>-->
                                                        <!--</div>--> 
                                               {{-- <div class="progress">
                                                    <div class="progress-bar bg-success quicktech-progress" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                </div>  --}}
                                            
                                            <!--<div class="media mt-4 d-none d-md-block">-->
                                                <!--<i class="mdi mdi-earth icon-md text-info d-flex align-self-start me-3"></i>-->
                                            <!--    <div class="media-body quicktech-width">-->
                                            <!--        <p class="card-text quicktech-textt">{!! $course->details !!}</p>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="quicktech-button mt-2 d-md-block">
                                        <button><a href="">Start Now</a></button>
                                    </div>
                            
                                 
                                  
                                  
                                </div>
                            </div>
                          
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
 <script>
    // Initialize progress value
    let progress = 0;

    // Function to update the progress bars
    function updateProgressBar() {
        const progressBars = document.getElementsByClassName('quicktech-progress'); // Get all elements with this class

        // Loop through each progress bar
        for (let i = 0; i < progressBars.length; i++) {
            let progressBar = progressBars[i];
            
            progress += 1; // Increment progress by 1%

            // Ensure progress doesn't exceed 100%
            if (progress > 100) {
                progress = 100;
            }

            // Update the progress bar's width and text
            progressBar.style.width = progress + '%';
            progressBar.setAttribute('aria-valuenow', progress);
            progressBar.textContent = progress + '%';
        }

        // Stop updating if progress reaches 100%
        if (progress < 100) {
            setTimeout(updateProgressBar, 100); // Update every 100 milliseconds
        }
    }

    // Start the progress bar update when the page loads
    window.onload = function() {
        updateProgressBar();
    };
</script>

@endsection
