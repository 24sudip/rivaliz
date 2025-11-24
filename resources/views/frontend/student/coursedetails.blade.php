@extends('frontend.student.studentmaster')
@section('title', $course->name)
@section('content')

    <style>
        iframe {
            width: 100%;
            height: 400px;
        }

        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&display=swap');

        :root {
            --lineWidth: 0px;
            --offwhite: #f5f7f9;
            --white: #ffffff;
            --grey: #8A8F9B;
            --green: #8bbba2;
            --purple: #b488df;
            --orange: #f77650;
            --skin: #f2b699;
            --brown: #b15a59;
            --ligtPurple: #d0b7e8;
            --dark-skin: #f5ceb4;
            --dark-brown: #8b5a59;
        }
    </style>

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                @if ($course->category_id == 0)
                    <h2 class="text-center py-3">{{ $course->name }}</h2>
                    <div class="container-main">
                        <div class="container-grid"></div>
                    </div>
                @else
                    <div class="row">

                        <div class="col-lg-7">
                            <div class="card shadow-sm">

                               


                                     


                                @if ($current_video)
                                         
                                         <div class="card-body">
                                            @if ($current_video->image)
                                              <video style="width:100% !important; height:max-content;" width="700" height="500" controls controlsList="nodownload" class="mt-2">
                                                  <source src="{{ asset($current_video->image) }}" type="video/mp4">
                                                  Your browser does not support the video tag.
                                              </video>
                                          @endif
                                         </div>
                                    <div class="card-body" id="video-container">
                                    
                                    </div>
                                    <div class="card-body pt-0 mt-0">
                                        <h4>
                                            <span class="text-success rounded-circle p-1 me-1" style="font-size: smaller;">
                                                <i class="fa fa-play-circle"></i>
                                            </span>
                                            <span class="text-dark">{{ $current_video->name }}</span>
                                            <div class="d-block d-md-none float-end">
                                                <button class="btn border p-1 text-google" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                                  <i class="mdi mdi-playlist-play mdi-24px"></i>
                                                </button>
                                            </div>
                                        </h4>
                                        <!--<div class="">-->
                                        <!--    <p style="padding-top:20px;" class="card-text quicktech-textt">{!! $course->details !!}</p>-->
                                        <!--</div>-->
                                    </div>
                                    
                                @else
  <div class="card">
    <div class="card-body">
        <!-- Header row: title + mobile toggle button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="fw-bold fs-5">Welcome to learn with Sahan</span>

            <!-- Toggle button only visible on small devices -->
            <div class="d-block d-md-none">
                <button class="btn btn-outline-secondary p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <i class="mdi mdi-playlist-play mdi-24px"></i>
                </button>
            </div>
        </div>

        <!-- Responsive image -->
        <div class="mb-3">
            <img src="{{ asset($course->thumbnil_image) }}" alt="Course Thumbnail" class="img-fluid rounded">
        </div>

        <!-- Description -->
        <div class="course-description">
            <p class="mb-0">{!! $course->details !!}</p>
        </div>
    </div>
</div>

                                @endif
                            </div>
                            
                            @php
                            $videoLink = $current_video ? $current_video->link : '';
                            @endphp

                            @if($enrolled->certification)
                            <div class="card mt-4">
                                <div class="card-body">
                                    CERTIFICATION

                                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        View Certificate
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Certificate of
                                                        {{ $course->name }}
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div id="pm-certificate-container">
                                                        <div class="mx-auto pm-certificate-container">
                                                            <div class="outer-border"></div>
                                                            <div class="inner-border"></div>

                                                            <div class="pm-certificate-border col-xs-12">
                                                                <div class="row pm-certificate-header">
                                                                    <div
                                                                        class="pm-certificate-title cursive col-xs-12 text-center">
                                                                        <img src="{{ asset($company->logo) }}"
                                                                            alt="logo" class="img-fluid"
                                                                            width="400px;" />
                                                                        {{-- <h2>Easy Learn Campus</h2> --}}
                                                                    </div>
                                                                </div>

                                                                <div class="row pm-certificate-body">

                                                                    <div class="pm-certificate-block">
                                                                        <div class="col-xs-12">
                                                                            <div class="row">
                                                                                <div class="col-xs-2"><!-- LEAVE EMPTY -->
                                                                                </div>
                                                                                <div
                                                                                    class="pm-certificate-name underline margin-0 col-xs-8 text-center">
                                                                                    <span
                                                                                        class="pm-name-text bold">{{ Auth::guard('student')->user()->name }}</span>
                                                                                </div>
                                                                                <div class="col-xs-2"><!-- LEAVE EMPTY -->
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-xs-12">
                                                                            <div class="row">
                                                                                <div class="col-xs-2"><!-- LEAVE EMPTY -->
                                                                                </div>
                                                                                <div class="pm-earned col-xs-8 text-center">
                                                                                    <span
                                                                                        class="pm-earned-text padding-0 block cursive">has
                                                                                        earned</span>
                                                                                    <span
                                                                                        class="pm-credits-text block bold sans">PD175:
                                                                                        1.0 Credit Hours</span>
                                                                                </div>
                                                                                <div class="col-xs-2"><!-- LEAVE EMPTY -->
                                                                                </div>
                                                                                <div class="col-xs-12"></div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-xs-12">
                                                                            <div class="row">
                                                                                <div class="col-xs-2"><!-- LEAVE EMPTY -->
                                                                                </div>
                                                                                <div
                                                                                    class="pm-course-title col-xs-8 text-center">
                                                                                    <span
                                                                                        class="pm-earned-text block cursive">while
                                                                                        completing the course
                                                                                        entitled</span>
                                                                                </div>
                                                                                <div class="col-xs-2"><!-- LEAVE EMPTY -->
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-xs-12">
                                                                            <div class="row">
                                                                                <div class="col-xs-2"><!-- LEAVE EMPTY -->
                                                                                </div>
                                                                                <div
                                                                                    class="pm-course-title underline col-xs-8 text-center">
                                                                                    <span
                                                                                        class="pm-credits-text block bold sans">{{ $course->name }}</span>
                                                                                </div>
                                                                                <div class="col-xs-2"><!-- LEAVE EMPTY -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xs-12">
                                                                        <div class="row">
                                                                            <div class="pm-certificate-footer">
                                                                                <div
                                                                                    class="col-xs-4 pm-certified col-xs-4 text-center">
                                                                                    <span
                                                                                        class="pm-credits-text block sans">Easy
                                                                                        Learn Campus - Admin</span>

                                                                                </div>
                                                                                <div class="col-xs-4">
                                                                                    <!-- LEAVE EMPTY -->
                                                                                </div>
                                                                                <div
                                                                                    class="col-xs-4 pm-certified col-xs-4 text-center">
                                                                                    <span
                                                                                        class="pm-credits-text block sans">Date
                                                                                        Completed</span>
                                                                                    <span
                                                                                        class="pm-empty-space block underline"></span>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary"
                                                        id="printCertificateButton">Print</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            
                            @php $reviewSubmitted = App\Models\RatingReview::where(['student_id'=>Auth::guard('student')->user()->id, 'course_id'=>$course->id])->latest()->first(); @endphp
                            
                            @if(!$reviewSubmitted)
                            <div class="card mt-4">
                                <div class="card-body">
                                    

                                    <div class="mt-4">
                                        <div class="course__form">
                                            
                                            <div class="supaviews">
                                            	<div class="supaviews__gradient"></div>
                                            	<div class="supaviews__add">
                                            		<div class="supaview">
                                            			<h3 class="supaview__title">Add a new review</h3>
                                            			<form id="review" action="{{ route('student.reviewsubmit', $course->id) }}" method="POST">
                                            			    @csrf
                                            				<fieldset class="supaview__rating mt-4">
                                            					<input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
                                            					<input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
                                            					<input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
                                            					<input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
                                            					<input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
                                            				</fieldset>
                                            				<div class="supaview__copy mb-4">
                                            					<textarea name="review" placeholder="Message" rows="5"></textarea>
                                            				</div>
                                            				<button type="submit" class="supaview__submit">Submit review</button>
                                            			</form>
                                            		</div>
                                            	</div>
                                            </div>
                                            

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            @else
                            
                            <div class="card mt-4 pb-4">
                                <div class="card-body">
                                    Your have submitted Review
                                    <div class="float-end">
                                        <p>
                                            @for($i=1; $i<=5; $i++)
                                                @if($reviewSubmitted->rating>=$i)
                                                <i class="fa fa-star text-warning"></i> 
                                                @else
                                                <i class="fa fa-star text-secondary"></i> 
                                                @endif
                                            @endfor
                                        </p>
                                    </div>
                                    <h3 class="mt-3 text-end">{{ $reviewSubmitted->review }}</h3>
                                </div>
                                @php $review_replies = App\Models\ReviewReply::where('review_id', $reviewSubmitted->id)->get() @endphp
                                
                                
                                <div class="col-10 mx-auto my-4" >
                                    <form action="{{ route('student.replysubmit') }}" method="POST" class="d-flex rounded-0">
                                        @csrf
                                        <input type="hidden" name="review_id" value="{{ $reviewSubmitted->id }}">
                                        <textarea class="form-control border-primary" name="reply"></textarea>
                                        <button type="submit" class="btn bg-gradient-info text-light rounded-0">Reply</button>
                                    </form>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-10 mx-auto">
                                        @foreach($review_replies->reverse() as $reply)
                                        
                                            @if($reply->student_id)
                                            <div class="col-12">
                                                <div class="card bg-info text-white text-dark float-end my-2" style="width:80%">
                                                    <div class="card-body">
                                                        {{ $reply->reply }}
                                                    </div>
                                                    <p class="text-end mx-2 mb-0 text-light">{{ $reply->updated_at->diffForhumans() }}</p>
                                                </div>
                                            </div>
                                            @else
                                            <div class="col-12">
                                                <div class="card bg-gradient-olive my-2" style="width:80%">
                                                    <div class="card-body">
                                                        {{ $reply->reply }}
                                                    </div>
                                                    <p class="text-end mx-2 mb-0 text-secondary">{{ $reply->updated_at->diffForhumans() }}</p>
                                                </div>
                                            </div>
                                            @endif
                                        
                                        @endforeach
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->
                                </div>

                                
                            </div>
                            
                            @endif
                            
                            @endif
                        </div>
                        <div class="col-lg-5 d-none d-md-block">
                            <div class="card shadow-sm">
                                <div class="card-header bg-transparent d-flex justify-content-between">
                                    <h3 class="py-2"><i class="mdi mdi-content-duplicate me-2"></i>{{ $course->name }} </h3>
                                    
                                    <div class="my-auto d-flex">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#supportModal">
                                          Supports
                                        </button>
                                        
                                        @if($course->student_notices->count()>0)
                                        <button style="margin-left:10px;" type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#noticeModal">
                                          Notices
                                        </button>
                                        
                                        <div class="modal fade" id="noticeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="card-footer mt-2">
                                                    <ol class="list-group list-group-numbered">
                                                      
                                                      @foreach($course->student_notices->reverse() as $notice)
                                                      <li class="list-group-item d-flex justify-content-between align-items-start">
                                                        <div class="ms-2 me-auto">
                                                          <div class="fw-bold">{{ $notice->title }}</div>
                                                          {!! $notice->description !!}
                                                        </div>
                                                        <span class="badge rounded-pill mt-2 bg-success">
                                                            {{ $notice->created_at->diffForhumans() }}
                                                        </span>
                                                      </li>
                                                      @endforeach
                                                      
                                                    </ol>
                                                </div>
                                                
                                            </div>
                                          </div>
                                        </div>
                                        
                                        @endif
                                    </div>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="supportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="/student/get-support" method="POST">
                                                @csrf
                                                  <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Get Support</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                        <input type="hidden" name="instructor_id" value="{{ $course->instructor->id }}">
                                                        <div class="mb-3">
                                                          <label for="subject" class="form-label">Subject</label>
                                                          <input type="text" class="form-control" id="subject" name="subject" placeholder="">
                                                        </div>
                                                        <div class="mb-3">
                                                          <label for="description" class="form-label">Description</label>
                                                          <textarea class="form-control" id="description"  name="description" rows="3"></textarea>
                                                        </div>
                                                        <div class="float-end">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                  </div>
                                                  
                                            </form>
                                            
                                            @if($course->supports->count()>0)
                                            <div class="card-footer mt-2">
                                                
                                                <h3 class="text-center"> Previous Supports </h3>
                                                
                                                <ol class="list-group list-group-numbered">
                                                  
                                                  @foreach($course->supports->reverse() as $support)
                                                  <li class="list-group-item d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto">
                                                      <div class="fw-bold">{{ $support->subject }}</div>
                                                      {{ $support->description }}
                                                    </div>
                                                    <span class="badge rounded-pill mt-2 @if($support->status) bg-success @else bg-danger @endif">
                                                        @if($support->status) Resolved @else Pending @endif
                                                    </span>
                                                  </li>
                                                  @endforeach
                                                  
                                                </ol>
                                            </div>
                                            
                                            @endif
                                            
                                        </div>
                                      </div>
                                    </div>
                                    
                                    

                                </div>
                                <div class="card-body pt-3">

                                    <div>
                                        <div class="faq-container">
                                            @foreach ($course->modules as $key => $module)
                                                <div class="faq @if (isset($current_video) && in_array($current_video->lesson_id, $module->lessons->pluck('id')->toArray())) active @endif">
                                                    <h3 class="faq-title text-dark">{{ $module->name }}</h3>

                                                    @php $lessonCompleted = true @endphp
                                                    @foreach ($module->lessons as $lesson)
                                                    
                                                    @php 
                                                    $allquizSubmitted = false;
                                                    
                                                    $lesson_quizIds = App\Models\Quiz::where(
                                                                'lesson_id',
                                                                $lesson->id,
                                                            )->pluck('id');
                                                            
                                                    $lessonquiz_submitsCount = App\Models\Quizsubmit::whereIn(
                                                                'quiz_id',
                                                                $lesson_quizIds,
                                                            )->where('student_id', Auth::guard('student')->user()->id)->count();
                                                    $allquizSubmitted = $lesson_quizIds->count() <= $lessonquiz_submitsCount;
                                                            
                                                    @endphp
                                                    
                                                        <p class="faq-text">
                                                          <?php
                                                        $pdf =  DB::table('pdf')->where('lession_id',$lesson->id)->where('status',1)->get();
                                                           ?>
                                                           
                                                           
                                                            <a style="font-weight:bold;" class="text-decoration-none text-dark"
                                                                data-bs-toggle="collapse"
                                                                @if ($lessonCompleted) href="#collapse{{ $lesson->id }}" @endif
                                                                role="button" aria-expanded="false"
                                                                aria-controls="collapse{{ $lesson->id }}">
                                                                    <span style="background-color:#7d37ce !important;" class="rounded-circle border border-2 m-1 px-1 @if($allquizSubmitted && $lessonCompleted) bg-success text-white @endif">@if($allquizSubmitted && $lessonCompleted) &check; @else &nbsp;&nbsp; @endif</span>
                                                                    {{ $lesson->name }}
                                                                <span class="float-end">
                                                                    @if ($lessonCompleted)
                                                                        <i class="fas fa-caret-down"></i>
                                                                    @else
                                                                        <i class="fas fa-lock"
                                                                            style="color: #fc7474;"></i>
                                                                    @endif
                                                                </span>
                                                                
                                                            </a>
                                                            
                                                        </p>

                                                        <div class="collapse @if (isset($current_video) && $current_video->lesson_id === $lesson->id) show @endif"
                                                            id="collapse{{ $lesson->id }}">
                                                            <div class="card p-3 mt-2">
                                                                
                                                                <ol>
                                                                    @foreach ($lesson->videos as $video)
                                                                        <div class="py-1">
                                                                            <li>
                                                                                <a style="color:black;" href="?video={{ base64_encode($video->id) }}"
                                                                                    class="text-decoration-none @if (isset($current_video) && $current_video->id === $video->id) text-success @else text-dark @endif"><i class="fa-solid fa-video"></i> {{ $video->name }}</a>
                                                                            </li>
                                                                        </div>
                                                                    @endforeach
                                                                    <hr>
                                                                    <h4 style="color:black;" class="py-1"><i class="fas fa-caret-right"></i>
                                                                        Quizes <i class="fa-solid fa-puzzle-piece"></i></h4>
                                                                    <ol>
                                                                        @foreach ($lesson->quizzes as $quiz)
                                                                            <div class="py-1">
                                                                                <li>
                                                                                    <a style="color:#000000a8;"
                                                                                        href="/student/enrolled/quiz/{{ base64_encode($quiz->id) }}">
                                                                                        {{ $quiz->name }}
                                                                                    </a>
                                                                                </li>
                                                                            </div>
                                                                        @endforeach
                                                                    </ol>
                                                                     <hr>
                                                                    <h4 style="color:black;" class="py-1"><i class="fas fa-caret-right"></i>
                                                                        PDF <i class="fas fa-file-pdf"></i></h4>
                                                                    <ol>
                                                                        @forelse($pdf as $pdf)
                                                           <div class="py-1">
                                                            <li>
                                                               <a style="color:#000000a8;" href="{{ asset($pdf->pdf) }}" download>
                                                                    Download {{ basename($pdf->pdf) }}
                                                                </a>
                                                            </li>
                                                        </div>
                                                            @empty
                                                            
                                                            @endforelse
                                                                    </ol>
                                                                    
                                                                </ol>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $quizIds = App\Models\Quiz::where(
                                                                'lesson_id',
                                                                $lesson->id,
                                                            )->pluck('id');
                                                            $submitsCount = App\Models\Quizsubmit::whereIn(
                                                                'quiz_id',
                                                                $quizIds,
                                                            )->where('student_id', Auth::guard('student')->user()->id)->count();
                                                            $lessonCompleted = $quizIds->count() <= $submitsCount;
                                                        @endphp
                                                    @endforeach
                                                    
                                                       <button class="faq-toggle">
                                                            <i class="fas fa-chevron-down"></i>
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                        {{-- @if ($enrolled->module_completed >= $key + 1)
                                                        <button class="faq-toggle">
                                                            <i class="fas fa-chevron-down"></i>
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    @else
                                                        <button class="faq-toggle-lock">
                                                            <i class="fas fa-lock" style="color: #74C0FC;"></i>
                                                        </button>
                                                    @endif  --}} 

                                                </div>
                                            @endforeach 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                              <div class="offcanvas-header">
                                    <h3 class="py-2"><i class="mdi mdi-content-duplicate me-2"></i>{{ $course->name }} </h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                              </div>
                              
                              <div class="offcanvas-body">
                                    <div class="mb-5 pb-5">
                                        <div class="faq-container">
                                            @foreach ($course->modules as $key => $module)
                                                <div class="faq @if (isset($current_video) && in_array($current_video->lesson_id, $module->lessons->pluck('id')->toArray())) active @endif">
                                                    <h3 class="faq-title text-dark">{{ $module->name }}</h3>

                                                    @php $lessonCompleted = true @endphp
                                                    @foreach ($module->lessons as $lesson)
                                                    
                                                    @php 
                                                    $allquizSubmitted = false;
                                                    
                                                    $lesson_quizIds = App\Models\Quiz::where(
                                                                'lesson_id',
                                                                $lesson->id,
                                                            )->pluck('id');
                                                            
                                                    $lessonquiz_submitsCount = App\Models\Quizsubmit::whereIn(
                                                                'quiz_id',
                                                                $lesson_quizIds,
                                                            )->where('student_id', Auth::guard('student')->user()->id)->count();
                                                    $allquizSubmitted = $lesson_quizIds->count() <= $lessonquiz_submitsCount;
                                                            
                                                    @endphp
                                                    
                                                        <p class="faq-text">
                                                          <?php
                                                        $pdf =  DB::table('pdf')->where('lession_id',$lesson->id)->where('status',1)->get();
                                                           ?>
                                                           
                                                           
                                                            <a style="font-weight:bold;" class="text-decoration-none text-dark"
                                                                data-bs-toggle="collapse"
                                                                @if ($lessonCompleted) href="#collapse{{ $lesson->id }}" @endif
                                                                role="button" aria-expanded="false"
                                                                aria-controls="collapse{{ $lesson->id }}">
                                                                    <span class="rounded-circle border border-2 m-1 px-1 @if($allquizSubmitted && $lessonCompleted) bg-success text-white @endif">@if($allquizSubmitted && $lessonCompleted) &check; @else &nbsp;&nbsp; @endif</span>
                                                                    {{ $lesson->name }}
                                                                <span class="float-end">
                                                                    @if ($lessonCompleted)
                                                                        <i class="fas fa-caret-down"></i>
                                                                    @else
                                                                        <i class="fas fa-lock"
                                                                            style="color: #fc7474;"></i>
                                                                    @endif
                                                                </span>
                                                                
                                                            </a>
                                                            
                                                        </p>

                                                        <div class="collapse @if (isset($current_video) && $current_video->lesson_id === $lesson->id) show @endif"
                                                            id="collapse{{ $lesson->id }}">
                                                            <div class="card p-3 mt-2">
                                                                
                                                                <ol>
                                                                    @foreach ($lesson->videos as $video)
                                                                        <div class="py-1">
                                                                            <li>
                                                                                <a href="?video={{ base64_encode($video->id) }}"
                                                                                    class="text-decoration-none @if (isset($current_video) && $current_video->id === $video->id) text-success @else text-dark @endif"><i class="fa-solid fa-video"></i> {{ $video->name }}</a>
                                                                            </li>
                                                                        </div>
                                                                    @endforeach
                                                                    <hr>
                                                                    <h4 class="py-1"><i class="fas fa-caret-right"></i>
                                                                        Quizes <i class="fa-solid fa-puzzle-piece"></i></h4>
                                                                    <ol>
                                                                        @foreach ($lesson->quizzes as $quiz)
                                                                            <div class="py-1">
                                                                                <li>
                                                                                    <a
                                                                                        href="/student/enrolled/quiz/{{ base64_encode($quiz->id) }}">
                                                                                        {{ $quiz->name }}
                                                                                    </a>
                                                                                </li>
                                                                            </div>
                                                                        @endforeach
                                                                    </ol>
                                                                     <hr>
                                                                    <h4 class="py-1"><i class="fas fa-caret-right"></i>
                                                                        PDF <i class="fas fa-file-pdf"></i></h4>
                                                                    <ol>
                                                                        @forelse($pdf as $pdf)
                                                           <div class="py-1">
                                                            <li>
                                                               <a href="{{ asset($pdf->pdf) }}" download>
                                                                    Download {{ basename($pdf->pdf) }}
                                                                </a>
                                                            </li>
                                                        </div>
                                                            @empty
                                                            
                                                            @endforelse
                                                                    </ol>
                                                                    
                                                                </ol>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $quizIds = App\Models\Quiz::where(
                                                                'lesson_id',
                                                                $lesson->id,
                                                            )->pluck('id');
                                                            $submitsCount = App\Models\Quizsubmit::whereIn(
                                                                'quiz_id',
                                                                $quizIds,
                                                            )->where('student_id', Auth::guard('student')->user()->id)->count();
                                                            $lessonCompleted = $quizIds->count() <= $submitsCount;
                                                        @endphp
                                                    @endforeach
                                                    
                                                     <button class="faq-toggle">
                                                            <i class="fas fa-chevron-down"></i>
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                   {{-- @if ($enrolled->module_completed >= $key + 1)
                                                        <button class="faq-toggle">
                                                            <i class="fas fa-chevron-down"></i>
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    @else
                                                        <button class="faq-toggle-lock">
                                                            <i class="fas fa-lock" style="color: #74C0FC;"></i>
                                                        </button>
                                                    @endif --}}

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                              </div>
                            </div>
                        </div>

                    </div>
                @endif

            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const faqToggles = document.querySelectorAll('.faq-text a');

    faqToggles.forEach(function (toggle) {
        toggle.addEventListener('click', function (e) {
            const targetId = toggle.getAttribute('href');
            
            // Close all collapses except the one clicked
            document.querySelectorAll('.collapse').forEach(function (collapse) {
                if ('#' + collapse.id !== targetId) {
                    collapse.classList.remove('show');
                }
            });
        });
    });
});

    </script>

<script>
    document.querySelectorAll('.faq-toggle').forEach(toggle => {
    toggle.addEventListener('click', function () {
        // Hide all collapse elements within the current FAQ container
        const faqContainer = this.closest('.faq');
        faqContainer.querySelectorAll('.collapse.show').forEach(collapse => {
            collapse.classList.remove('show');
        });

        // Toggle the FAQ visibility
        faqContainer.classList.toggle('active');
    });
});
</script>

     <script>
    //     const toggles = document.querySelectorAll(".faq-toggle");

    //     toggles.forEach((toggle) => {
    //         toggle.addEventListener("click", () => {
    //             toggle.parentElement.classList.toggle("active");
    //         });
    //     });
    // </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const weekschedule = @json($course->schedules);

            const courseData = {
                id: @json($course->id),
                name: @json($course->name)
            };

            const container = document.querySelector('.container-grid');
            const ref = document.querySelector('.container-main');

            const days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
            const times = ["08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00",
                "17:00"
            ];
            const colours = ["#8bbba2", "#b488df", "#f77650", "#f2b699", "#b15a59", "#d0b7e8", "#f5ceb4",
                "#8b5a59"
            ];

            const divs = [];

            days.forEach((day, index) => {
                divs.push({
                    className: "days",
                    data: day,
                    row: 1,
                    col: index + 2,
                    row1: 2,
                    col1: index + 3
                });
            });

            times.forEach((time, index) => {
                divs.push({
                    className: "time",
                    data: time,
                    row: index + 2,
                    col: 1,
                    row1: index + 3,
                    col1: 2
                });
            });

            // Add schedule items
            weekschedule.forEach(item => {
                const dayIndex = days.findIndex(day => day.toLowerCase().startsWith(item.weekday.substring(
                    0, 3).toLowerCase()));
                const startTimeIndex = times.indexOf(item.start_time.slice(0, 5));
                const endTimeIndex = times.indexOf(item.end_time.slice(0, 5));

                if (dayIndex !== -1 && startTimeIndex !== -1 && endTimeIndex !== -1) {
                    divs.push({
                        className: "grid-item",
                        data: item.title,
                        row: startTimeIndex + 2,
                        col: dayIndex + 2,
                        row1: endTimeIndex + 2,
                        col1: dayIndex + 3,
                        backgroundColor: colours[item.course_id % colours.length]
                    });
                }
            });

            divs.forEach(div => {
                const divElement = document.createElement('div');
                divElement.className = div.className;
                divElement.style.gridArea = `${div.row} / ${div.col} / ${div.row1} / ${div.col1}`;
                if (div.backgroundColor) {
                    divElement.style.backgroundColor = div.backgroundColor;
                }
                divElement.textContent = div.data;
                container.appendChild(divElement);
            });

            document.documentElement.style.setProperty('--lineWidth', ref.offsetWidth - 60 + 'px');
            ref.style.gridTemplateRows = `25px repeat(${times.length}, 1fr)`;
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#printCertificateButton').on('click', function() {
                var container = $('#pm-certificate-container').clone();
                var originalBody = $('body').html();

                $('body').empty();

                var printDiv = $('<div id="printDiv"></div>').appendTo('body');

                printDiv.append(container);
                window.print();

                $('body').html(originalBody);
            });
        });
    </script>
     <script>
        // PHP will output the video link dynamically into the script
        const videoLink = `<?= $videoLink ?? '' ?>`;

        // Function to extract the video ID from various YouTube URL formats
        function extractVideoID(url) {
            const regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
            const match = url.match(regex);
            return match ? match[1] : null;
        }

        // Extract the video ID from the provided link
        const videoId = extractVideoID(videoLink);

        if (videoId) {
            // Construct the embed URL with ?rel=0 to disable related videos
            const embedUrl = `https://www.youtube.com/embed/${videoId}?rel=0`;

            // Create the iframe element
            const iframe = document.createElement('iframe');
            iframe.width = '560';
            iframe.height = '280';
            iframe.src = embedUrl;
            iframe.frameBorder = '0';
            iframe.allowFullscreen = true;

            // Append the iframe to the container
            const container = document.getElementById('video-container');
            container.appendChild(iframe);
        } else {
            console.error('Invalid YouTube URL provided.');
        }
    </script>

@endsection
