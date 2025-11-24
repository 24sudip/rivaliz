@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>Course Detail - {{ env('APP_NAME') }}</title>
    @endsection
    
    
    <style>
          .quicktech-modal-content {
      border: none;
      background: transparent;
    }
    .quicktech-modal-body {
      padding: 0;
    }
    .quicktech-video-wrapper iframe {
      width: 100%;
      height: 400px;
    }
    .quicktech-close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 1.5rem;
      color: white;
      background: transparent;
      border: none;
      z-index: 1056;
    }
    
    .quikctech-acc-main h5{
        padding-bottom:10px;
    }
    </style>
    
 <section id="quikctch-course-details-main" class="pt-5">
    <div class="container">
        <div class="row pt-5">
            <div class="col-lg-8 col-md-7">
               <div class="quicktech-course-details-inner">
                <h1>{{$coursedetails->name}}</h1>
                <img src="{{asset($coursedetails->thumbnil_image)}}" class="w-100" alt="">

                <div class="quicktech-course-tabs mt-5 mb-5">
                    <ul class="nav nav-pills quicktech-tabs-course mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                          <button class="nav-link quikctech-nav-course-link active" id="pills-curriculum-tab" data-bs-toggle="pill" data-bs-target="#pills-curriculum" type="button" role="tab" aria-controls="pills-curriculum" aria-selected="false">Course Content</button>
                        </li> 
                        <li class="nav-item" role="presentation">
                          <button class="nav-link quikctech-nav-course-link " id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">Description</button>
                        </li>
          
                         {{-- <li class="nav-item" role="presentation">
                          <button class="nav-link quikctech-nav-course-link" id="pills-instructor-tab" data-bs-toggle="pill" data-bs-target="#pills-instructor" type="button" role="tab" aria-controls="pills-instructor" aria-selected="false">Instructor Details</button>
                        </li> --}}
                           <li class="nav-item" role="presentation">
                          <button class="nav-link quikctech-nav-course-link" id="pills-syllabus-tab" data-bs-toggle="pill" data-bs-target="#pills-syllabus" type="button" role="tab" aria-controls="pills-syllabus" aria-selected="false">Syllabus</button>
                        </li> 
                      <li class="nav-item" role="presentation">
                          <button class="nav-link quikctech-nav-course-link" id="pills-faq-tab" data-bs-toggle="pill" data-bs-target="#pills-faq" type="button" role="tab" aria-controls="pills-faq" aria-selected="false">FAQ</button>
                        </li> 
                     
                        <li class="nav-item" role="presentation">
                          <button class="nav-link quikctech-nav-course-link" id="pills-review-tab" data-bs-toggle="pill" data-bs-target="#pills-review" type="button" role="tab" aria-controls="pills-review" aria-selected="false">Review</button>
                        </li>
                      </ul>

                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab" tabindex="0">
                          <div class="quicktech-description-course">
                            <p>{!!$coursedetails->details!!}</p>
                       
                          </div>
                        </div>
                     
                        <div class="tab-pane fade show active" id="pills-curriculum" role="tabpanel" aria-labelledby="pills-curriculum-tab" tabindex="0">
                          {{--<div class="quicktech-curriculm">
                              @foreach ($coursedetails->modules as $key => $module)
                                            <div class="">

                                                <a class="accordion-button text-dark fw-bold fs-5 @if ($key > 0) collapsed @endif"
                                                    type="button" data-toggle="collapse"
                                                    data-target="#module-{{ $module->id }}" aria-expanded="true"
                                                    aria-controls="module-{{ $module->id }}">
                                                    {{ $module->name }}
                                                </a>

                                                <div id="module-{{ $module->id }}"
                                                    class="collapse @if ($key == 0) show @endif"
                                                    aria-labelledby="headingOne" data-parent="#accordionModule">
                                                    <div class="card">
                                                        <div class="accordion" id="accordionLesson">
                                                            @foreach ($module->lessons as $index => $lesson)
                                                                <div class="border-top">
                                                                    <div class="accordion-body">
                                                                        <a class="text-dark fw-bold col-12" type="button"
                                                                            data-toggle="collapse"
                                                                            data-target="#lesson-{{ $lesson->id }}"
                                                                            aria-expanded="true"
                                                                            aria-controls="lesson-{{ $lesson->id }}">
                                                                            <h5 class="col-12">
                                                                                {{ $lesson->name }}
                                                                                <span class="float-end"><i
                                                                                        class="fa fa-caret-down"
                                                                                        aria-hidden="true"></i></span>
                                                                            </h5>

                                                                        </a>

                                                                        <div id="lesson-{{ $lesson->id }}"
                                                                            class="collapse @if ($index == 0) show @endif"
                                                                            aria-labelledby="headingOne"
                                                                            data-parent="#accordionLesson">
                                                                            <div class="accordion-body">

                                                                                <ol class="list-group">
                                                                                    @foreach ($lesson->videos as $video)
                                                                                        <li
                                                                                            class="list-group-item d-flex justify-content-between align-items-start border-0">
                                                                                            <span><span
                                                                                                    class="@if ($video->free) alert-primary @else alert-secondary @endif rounded-circle p-1"
                                                                                                    style="font-size: smaller;">
                                                                                                    <i class="fa fa-play-circle"
                                                                                                        aria-hidden="true"></i>
                                                                                                </span></span>
                                                                                            <div class="ms-2 me-auto">
                                                                                                {{ $video->name }}
                                                                                            </div>

                                                                                            @if ($video->free)
                                                                                                <div class="course__video">
                                                                                                    <div
                                                                                                        class="course__video-thumb w-img">
                                                                                                        <h5>Play</h5>
                                                                                                    
                                                                                                        <div>
                                                                                                          <video width="180" height="100" controls controlsList="nodownload">
                        <source src="{{ asset($video->image) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <span
                                                                                                    class="text-muted text-sm"
                                                                                                    style="font-size: smaller;">
                                                                                                    <i class="fa fa-lock"
                                                                                                        aria-hidden="true"></i>
                                                                                                </span>
                                                                                            @endif
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ol>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                            
                          </div> --}}
                          <!---->
                          {{--   @foreach ($coursedetails->modules as $key => $module)
                             <div class="accordion" id="mainAccordion">

  <!-- Main Accordion 1 -->
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
         {{ $module->name }}
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#mainAccordion">
      <div class="accordion-body">
        <div class="accordion" id="nestedAccordion1">
                  @foreach ($module->lessons as $index => $lesson)
          <!-- Nested Accordion 1.1 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading1_1">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1_1">
               {{ $lesson->name }}
              </button>
            </h2>
            <div id="collapse1_1" class="accordion-collapse collapse" data-bs-parent="#nestedAccordion1">
              <div class="accordion-body">
                  <div class="quikctech-acc-main">
                      @foreach ($lesson->videos as $video)
                      <h5 style="font-size:17px;">  <a href="#" data-bs-toggle="modal" data-bs-target="#quicktechVideoModal"> <i style="font-size:20px; color:black;" class="fa-solid fa-play fa-3x"></i></a> {{ $video->name }}</h5>
                      
                                   <div>
                                                                                                          <video width="180" height="100" controls controlsList="nodownload">
                        <source src="{{ asset($video->image) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                                                                                                        </div>
                      
                       @endforeach
                       <!--<h5 style="font-size:17px;">  <a href="#" data-bs-toggle="modal" data-bs-target="#quicktechVideoModal"> <i style="font-size:20px; color:black;" class="fa-solid fa-play fa-3x"></i></a> Title </h5>-->
                  </div>
              </div>
            </div>
          </div>
                   @endforeach


        </div>
      </div>
    </div>
  </div>





</div>
                                        @endforeach
<!---video modal->

<!-- Modal -->
  <div class="modal fade" id="quicktechVideoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content quicktech-modal-content position-relative">
        <button type="button" class="quicktech-close-btn" data-bs-dismiss="modal" aria-label="Close">&times;</button>
        <div class="modal-body quicktech-modal-body">
          <div class="quicktech-video-wrapper ratio ratio-16x9">
            <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&rel=0" 
                    title="QuickTech Video" 
                    allow="autoplay; encrypted-media" 
                    allowfullscreen>
            </iframe>
          </div>
        </div>
      </div>
    </div>
  </div>


<!--video modal-->  --}}



{{-- Loop through course modules --}}
@foreach ($coursedetails->modules as $key => $module)
    @php $moduleId = 'mainAccordion_' . $key; @endphp
    <div class="accordion mb-3" id="{{ $moduleId }}">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingModule_{{ $key }}">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseModule_{{ $key }}">
                    {{ $module->name }}
                </button>
            </h2>
            <div id="collapseModule_{{ $key }}" class="accordion-collapse collapse" data-bs-parent="#{{ $moduleId }}">
                <div class="accordion-body">
                    <div class="accordion" id="nestedAccordion_{{ $key }}">
                        @foreach ($module->lessons as $index => $lesson)
                            @php $lessonId = 'lesson_' . $key . '_' . $index; @endphp
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading_{{ $lessonId }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $lessonId }}">
                                        {{ $lesson->name }}
                                    </button>
                                </h2>
                                <div id="collapse_{{ $lessonId }}" class="accordion-collapse collapse" data-bs-parent="#nestedAccordion_{{ $key }}">
                                    <div class="accordion-body">
                                        <div class="quikctech-acc-main">
                                            @foreach ($lesson->videos as $vkey => $video)
                                                <h5 style="font-size:17px;">
                                                     @if ($video->free)
                                                    <a href="#" 
                                                       class="video-link" 
                                                       data-bs-toggle="modal" 
                                                       data-bs-target="#quicktechVideoModal" 
                                                       data-video-src="{{ asset($video->image) }}">
                                                       <i style="font-size:20px; color:black;" class="fa-solid fa-play fa-3x"></i>
                                                       {{ $video->name }}
                                                    </a>
                                                    @else
                                                   <span
                                                                                                    class="text-muted text-sm"
                                                                                                    style="font-size: smaller;">
                                                                                                    <i class="fa fa-lock"
                                                                                                        aria-hidden="true"></i>
                                                                                                </span>
                                                                                                {{ $video->name }}
                                                    @endif
                                                    
                                                </h5>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- nestedAccordion -->
                </div>
            </div>
        </div>
    </div>
@endforeach


 <!-- Video Modal -->
<div class="modal fade" id="quicktechVideoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content quicktech-modal-content position-relative">
            <button type="button" class="quicktech-close-btn" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            <div class="modal-body quicktech-modal-body">
                <div class="quicktech-video-wrapper text-center">
                    <video id="quicktechVideoPlayer" width="100%" height="auto" controls controlsList="nodownload">
                        <source id="quicktechVideoSource" src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('quicktechVideoModal');
        const video = document.getElementById('quicktechVideoPlayer');
        const source = document.getElementById('quicktechVideoSource');

        // Handle play on link click
        document.querySelectorAll('.video-link').forEach(link => {
            link.addEventListener('click', function () {
                const videoSrc = this.getAttribute('data-video-src');
                source.src = videoSrc;
                video.load();
                video.play();
            });
        });

        // Reset video on modal close
        modal.addEventListener('hidden.bs.modal', function () {
            video.pause();
            video.currentTime = 0;
            source.src = '';
        });
    });
</script>


                          <!---->
                          
                          
                        </div> 
                       <div class="tab-pane fade" id="pills-faq" role="tabpanel" aria-labelledby="pills-faq-tab" tabindex="0">
                   
                                               
                                                 
                           <div class="quicktech-curriculm">
    <h3>Frequently Asked Questions</h3>
    
    <div class="quicktech-accordian-curriculm">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach($coursedetails->faqs as $index => $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{ $index }}">
                        <button style="border: 1px solid #ddd;" class="accordion-button quicktech-acc-head collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $index }}" aria-expanded="false" aria-controls="flush-collapse{{ $index }}">
                            {{ sprintf('%02d', $index + 1) }}. {{ $faq->question }}
                        </button>
                    </h2>
                    <div id="flush-collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $index }}" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
                      
                                               
                                               
                                               
                                               
                        </div>   
                         <div class="tab-pane fade " id="pills-syllabus" role="tabpanel" aria-labelledby="pills-syllabus-tab" tabindex="0">
                          <div class="quicktech-description-course">
                            <iframe 
            src="{{ asset($coursedetails->details_file) }}" 
            width="100%" 
            height="600px" 
            style="border: none;"
        ></iframe>
                       
                          </div>
                        </div>
                        <div class="tab-pane fade" id="pills-instructor" role="tabpanel" aria-labelledby="pills-instructor-tab" tabindex="0">
                          <div class="quicktech-instructor">
                            <div class="row">
                                <div class="col-lg-4 col-sm-4">
                                    <div class="quikctech-inscrutor-img">
                                        <img src="images/ad1.jpg" class="w-100" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-sm-8">
                                    <div class="quikctech-instructor-details">
                                        <h3>Jones Mark <br> <span>Java Programmer</span></h3>

                                        <div class="quicktech-stars">
                                            <ul>
                                                <li><i class="fa-solid fa-star"></i></li>
                                                <li><i class="fa-solid fa-star"></i></li>
                                                <li><i class="fa-solid fa-star"></i></li>
                                                <li><i class="fa-solid fa-star"></i></li>
                                                <li><i class="fa-regular fa-star"></i></li>
                                                <li class="quicktech-rating">4.8 (867)</li>
                                            </ul>
                                        </div>
                                        <p>Lasted my coming uneasy marked so should. Gravity letters it amongst herself dearest an windows by. Wooded ladies she basket season age her uneasy saw. Discourse unwilling am no described.</p>
                                        <div class="quicktech-instructor-experience">
                                            <ul class="quikctech-det">
                                                <li><i class="fa-solid fa-play"></i> 12 Courses</li>
                                                <li><i class="fa-solid fa-message"></i> 867 Rating</li>
                                                <li><i class="fa-solid fa-user"></i> 4k Students</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-4 col-sm-4">
                                    <div class="quikctech-inscrutor-img">
                                        <img src="images/ad1.jpg" class="w-100" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-sm-8">
                                    <div class="quikctech-instructor-details">
                                        <h3>Jones Mark <br> <span>Java Programmer</span></h3>

                                        <div class="quicktech-stars">
                                            <ul>
                                                <li><i class="fa-solid fa-star"></i></li>
                                                <li><i class="fa-solid fa-star"></i></li>
                                                <li><i class="fa-solid fa-star"></i></li>
                                                <li><i class="fa-solid fa-star"></i></li>
                                                <li><i class="fa-regular fa-star"></i></li>
                                                <li class="quicktech-rating">4.8 (867)</li>
                                            </ul>
                                        </div>
                                        <p>Lasted my coming uneasy marked so should. Gravity letters it amongst herself dearest an windows by. Wooded ladies she basket season age her uneasy saw. Discourse unwilling am no described.</p>
                                        <div class="quicktech-instructor-experience">
                                            <ul class="quikctech-det">
                                                <li><i class="fa-solid fa-play"></i> 12 Courses</li>
                                                <li><i class="fa-solid fa-message"></i> 867 Rating</li>
                                                <li><i class="fa-solid fa-user"></i> 4k Students</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab" tabindex="0">
                          <div class="quicktech-review">
                            <div class="rating-summary my-4">
                                <div class="text-center mb-4">
                                    <h1 class="rating-count">5.0</h1>
                                    <div class="rating-stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="mb-0">Rated 5 out of 3 Ratings</p>
                                </div>
                                <div>
                                    
                                </div>
                            </div>

                            <div class="review-card mt-3 d-flex">
                                <div>
                                    <img src="images/re.jpg" alt="Profile Picture" class="profile-img me-3">
                                </div>
                                <div>
                                    <h5 class="mb-0">Mira Jone</h5>
                                    <small class="text-muted">15 December, 2020</small>
                                    <div class="stars my-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <p class="mb-0">Agreeable law unwilling sir deficient curiosity instantly. Easy mind life fact with see has bore ten. Parish any chatty can elinor direct for former. Up as meant widow equal an share least.</p>
                                </div>
                            </div>
                            <div class="review-card mt-3 d-flex">
                                <div>
                                    <img src="images/re.jpg" alt="Profile Picture" class="profile-img me-3">
                                </div>
                                <div>
                                    <h5 class="mb-0">Mira Jone</h5>
                                    <small class="text-muted">15 December, 2020</small>
                                    <div class="stars my-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <p class="mb-0">Agreeable law unwilling sir deficient curiosity instantly. Easy mind life fact with see has bore ten. Parish any chatty can elinor direct for former. Up as meant widow equal an share least.</p>
                                </div>
                            </div>
                          </div>
                        </div> --}}
                        <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab" tabindex="0">
                          <div class="quicktech-review">
                              {{-- <div class="rating-summary my-4">
                                  <div class="text-center mb-4">
                                      <h1 class="rating-count">5.0</h1>
                                      <div class="rating-stars">
                                          <i class="fas fa-star"></i>
                                          <i class="fas fa-star"></i>
                                          <i class="fas fa-star"></i>
                                          <i class="fas fa-star"></i>
                                          <i class="fas fa-star"></i>
                                      </div>
                                      <p class="mb-0">Rated 5 out of 3 Ratings</p>
                                  </div>
                              </div> --}}
                              <div class="rating-summary my-4">
                                <div class="text-center mb-4">
                                    <h1 class="rating-count">{{ number_format($rating, 1) }}</h1>
                                    <div class="rating-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= round($rating) ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                    <p class="mb-0">Rated {{ number_format($rating, 1) }} out of {{ $totalRatings }} Ratings</p>
                                </div>
                            </div>
                      
                              {{-- Existing Reviews Section --}}

                              @foreach($reviews as $review)
<div class="review-card mt-3 d-flex">
    <div>
    {{--  {{ asset(auth()->guard('student')->user()->image) }} --}}
        <img src="{{ asset($review->student->image ) }}" alt="Profile Picture" class="profile-img me-3">
    </div>
    <div>
        <h5 class="mb-0">{{ $review->student->name }}</h5>
        <small class="text-muted">{{ $review->created_at->format('d F, Y') }}</small>
        <div class="stars my-2">
            @for ($i = 1; $i <= 5; $i++)
                <i class="fas fa-star {{ $review->rating >= $i ? 'text-warning' : 'text-muted' }}"></i>
            @endfor
        </div>
        <p class="mb-0">{{ $review->review_text }}</p>
    </div>
</div>
@endforeach
                             

                            {{--  <div class="add-review mt-4">
                               
                                <form action="{{ route('reviews.store', $coursedetails) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Your Rating:</label>
                                        <div class="rating-stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star star-rating" data-rating="{{ $i }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Your Review:</label>
                                        <textarea class="form-control" name="review_text" rows="4" placeholder="Write your review here..."></textarea>
                                    </div>
                                    <input type="hidden" name="rating" id="rating" value="0">
                                    <input type="hidden" name="student_id" value="{{ auth()->guard('student')->user()->id }}">
                                
                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                </form>
                              </div>  --}}
                              @if(auth()->guard('student')->check()) 
    @php
        $student = auth()->guard('student')->user();
        $isEnrolled = \App\Models\Enroll::where('student_id', $student->id)
            ->where('course_id', $coursedetails->id)
            ->exists();
    @endphp

    @if($isEnrolled)
        <div class="add-review mt-4">
            <form action="{{ route('reviews.store', $coursedetails) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Your Rating:</label>
                    <div class="rating-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star star-rating" data-rating="{{ $i }}"></i>
                        @endfor
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Your Review:</label>
                    <textarea class="form-control" name="review_text" rows="4" placeholder="Write your review here..."></textarea>
                </div>
                <input type="hidden" name="rating" id="rating" value="0">
                <input type="hidden" name="student_id" value="{{ $student->id }}">
            
                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        </div>
    {{-- @else
        <p class="text-danger mt-3">You must be enrolled in this course to leave a review.</p> --}}
    @endif
{{-- @else
    <p class="text-warning mt-3">Please <a href="{{ route('student.login') }}">log in</a> as a student to leave a review.</p> --}}
@endif
                            
                            <style>
                                .rating-stars {
                                    display: flex;
                                    gap: 5px;
                                    font-size: 30px;
                                    cursor: pointer;
                                }
                            
                                .star-rating {
                                    color: #ddd; /* Default gray */
                                    transition: color 0.3s ease-in-out;
                                }
                            
                                .star-rating.hover {
                                    color: #ff9800 !important; /* Orange when hovered */
                                }
                            
                                .star-rating.selected {
                                    color: #ffc107 !important; /* Gold when selected */
                                }
                            </style>
                            
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const stars = document.querySelectorAll(".star-rating");
                                    const ratingInput = document.getElementById("rating");
                                    let selectedRating = 0;
                            
                                    stars.forEach((star, index) => {
                                        star.addEventListener("mouseover", function () {
                                            updateStarDisplay(index + 1, true);
                                        });
                            
                                        star.addEventListener("mouseout", function () {
                                            updateStarDisplay(selectedRating, false);
                                        });
                            
                                        star.addEventListener("click", function () {
                                            selectedRating = index + 1;
                                            ratingInput.value = selectedRating;
                                            updateStarDisplay(selectedRating);
                                        });
                                    });
                            
                                    function updateStarDisplay(rating, isHover = false) {
                                        stars.forEach((star, index) => {
                                            if (index < rating) {
                                                star.classList.add(isHover ? "hover" : "selected");
                                                star.classList.remove(isHover ? "selected" : "hover");
                                            } else {
                                                star.classList.remove("selected", "hover");
                                            }
                                        });
                                    }
                                });
                            </script>

                              



                          </div>
                        </div>
                      </div>


                </div>


               </div>
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="course-card">
                    <div class="quikctech-f-inner">
                      <div class="course-title">Course Features</div>
                    <ul class="course-list">
                      <li class="course-list-item">
                        <i>&#128101;</i>
                        <strong>Enrolled :</strong> {{$coursedetails->enrolled}} students
                      </li>
                      {{-- <li class="course-list-item">
                        <i>&#128337;</i>
                        <strong>Duration :</strong> 2 hours
                      </li>
                      <li class="course-list-item">
                        <i>&#128196;</i>
                        <strong>Lectures :</strong> 8
                      </li> --}}
                      <li class="course-list-item">
                        <i>&#128193;</i>
                        <strong>Categories :</strong> {{$coursedetails->category->name}}
                      </li>
                      {{-- <li class="course-list-item">
                        <i>&#128204;</i>
                        <strong>Tags :</strong> Android, JavaScript
                      </li> --}}
                      <li class="course-list-item">
                        <i>&#128100;</i>
                        <strong>Instructor :</strong> {{$coursedetails->instructor->name}}
                      </li>
                    </ul>
                    </div>
                    <div class="quikctech-pp">
                        <div class="course-price">Price: {{$coursedetails->price}} Tk</div>
                        <a href="{{ route('অতিথি-চেকআউট', $coursedetails->id) }}" class="course-button">ENROLL COURSE</a>
                    </div>
                  </div>

                <div class="quicktech-recent-course mt-5">
                    <h3>Suggested Courses</h3>
                   

                    <div class="quikctech-in-cour">
                      
                      @foreach ($suggestedcourses as $course)
                      <div class="quicktech-recent-inner mt-3 d-flex gap-3">
                          <a href="{{ route('coursedetails', $course->id) }}">
                              {{-- <div class="quikcteck-recent-img">
                                        <img src="{{asset($course->thumbnil_image)}}" alt="{{ $course->name}}">
                                    </div> --}}
                               <div class="quikcteck-recent-img">
                                  <img src="{{asset($course->thumbnil_image)}}" alt="">
                               </div>
                               <div class="quikctech-recent-details">
                                  <h4>{{ $course->name }} <br>  
                                    <p></p>
                                    {{-- <p>Become a web designer in 3 months</p> --}}
                                  </h4>
                                   <div class="quikctech-enroll-btnn mt-2">
                                      <p>{{ $course->price }} tk</p>
                                      <a class="quikctech-entrolll" href="{{ route('অতিথি-চেকআউট', $course->id) }}">Enroll Now</a>
                                    </div>
                               </div>
                           </a>
                      </div>
                        
                         
                            
                     
                     @endforeach

                    
                  </div>  
                </div>  
            </div>
        </div>
    </div>
 </section>


 <!-- related course -->
 <section id="quicktech-popular-courses">
    <div class="container">
      <div class="row mt-5">
        <div class="col-lg-12">
          <div class="quikctech-main-head text-center">
            <h1>Related Courses</h1>
          </div>
        </div>
      </div>


      <div class="row mt-4 mb-5">
        <div class="col-lg-12">
          <!-- Slider main container -->
  <div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->

      @foreach($relatedcourses as $relatedcourse)
      <div class="swiper-slide">
        <a href="{{ route('coursedetails', $course->id) }}">
          <div class="quicktech-course-inner">
            <div class="quikctech-course-img">
              <img src="{{asset($relatedcourse->thumbnil_image)}}" class="w-100" alt="">
            </div>
            <div class="quicktech-course-text">
              <span>Web Design</span>
              <h3>{{$relatedcourse->name}}</h3>
              <div class="quikctech-enroll-btn mt-5">
                <p>{{$relatedcourse->price}} tk</p>
                <a class="quikctech-entroll" href="{{ route('অতিথি-চেকআউট', $relatedcourse->id) }}">Enroll Now</a>
              </div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
      <!-- <div class="swiper-slide">
        <a href="coursedetails.html">
          <div class="quicktech-course-inner">
            <div class="quikctech-course-img">
              <img src="images/popular.png" class="w-100" alt="">
            </div>
            <div class="quicktech-course-text">
              <span>Web Design</span>
              <h3>Become a web designer in 3 months</h3>
              <div class="quikctech-enroll-btn mt-5">
                <p>150 tk</p>
                <a class="quikctech-entroll" href="checkout.html">Enroll Now</a>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="swiper-slide">
        <a href="coursedetails.html">
          <div class="quicktech-course-inner">
            <div class="quikctech-course-img">
              <img src="images/popular.png" class="w-100" alt="">
            </div>
            <div class="quicktech-course-text">
              <span>Web Design</span>
              <h3>Become a web designer in 3 months</h3>
              <div class="quikctech-enroll-btn mt-5">
                <p>150 tk</p>
                <a class="quikctech-entroll" href="checkout.html">Enroll Now</a>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="swiper-slide">
        <a href="coursedetails.html">
          <div class="quicktech-course-inner">
            <div class="quikctech-course-img">
              <img src="images/popular.png" class="w-100" alt="">
            </div>
            <div class="quicktech-course-text">
              <span>Web Design</span>
              <h3>Become a web designer in 3 months</h3>
              <div class="quikctech-enroll-btn mt-5">
                <p>150 tk</p>
                <a class="quikctech-entroll" href="checkout.html">Enroll Now</a>
              </div>
            </div>
          </div>
        </a>
      </div> -->

    </div>
    <!-- If we need pagination -->
    <!-- <div class="swiper-pagination"></div> -->

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
    <!-- <div class="swiper-scrollbar"></div> -->
  </div>

        </div>
      </div>

    </div>
  </section>
   <!-- related course -->



   <!-- teachers details -->


@endsection
