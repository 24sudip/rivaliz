
@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>Ebook Details - {{ env('APP_NAME') }}</title>
    @endsection
    





   <!-- ebook details -->
  
  <section style="background: url(./images/bannn.jpg) center center / cover no-repeat;" id="quikctech-teachers-title" class="pt-100">
    <div class="overlay">
        <div class="container">
            <div class="row">
             <div class="col-lg-12">
             <div class="quikctech-teachers-head text-center">
               <h1>Ebook Details</h1>
               <h5><i class="fa-solid fa-house"></i> Home / Ebook Details</h5>
                </div> 
                </div>
            </div>
        </div>
    </div>

 </section>

 <section id="quikctch-course-details-main">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-8 col-md-7">
               <div class="quicktech-course-details-inner">
                <h1>{{$ebook->title}}</h1>
                <img src="{{asset($ebook->photo)}}" class="w-100" alt="">
 
                <div class="quicktech-course-tabs mt-5 mb-5">
                    <ul class="nav nav-pills quicktech-tabs-course mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link quikctech-nav-course-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">Description</button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                          <button class="nav-link quikctech-nav-course-link" id="pills-curriculum-tab" data-bs-toggle="pill" data-bs-target="#pills-curriculum" type="button" role="tab" aria-controls="pills-curriculum" aria-selected="false">Assignment</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link quikctech-nav-course-link" id="pills-instructor-tab" data-bs-toggle="pill" data-bs-target="#pills-instructor" type="button" role="tab" aria-controls="pills-instructor" aria-selected="false">Instructor Details</button>
                        </li> -->
                        <li class="nav-item" role="presentation">
                          <button class="nav-link quikctech-nav-course-link" id="pills-review-tab" data-bs-toggle="pill" data-bs-target="#pills-review" type="button" role="tab" aria-controls="pills-review" aria-selected="false">Review</button>
                        </li>
                      </ul>
                      
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab" tabindex="0">
                          <div class="quicktech-description-course">
                            <p>{!!$ebook->description!!}</p>
                            {{-- <ul class="description-check">
                                <li><i class="fa-solid fa-check"></i> Metus interdum metus</li>
                                <li><i class="fa-solid fa-check"></i> Metus interdum metus</li>
                                <li><i class="fa-solid fa-check"></i> Metus interdum metus</li>
                                <li><i class="fa-solid fa-check"></i> Metus interdum metus</li>
                                <li><i class="fa-solid fa-check"></i> Metus interdum metus</li>
                                <li><i class="fa-solid fa-check"></i> Metus interdum metus</li>
                            </ul> --}}
                          </div>
                        </div>
                       
                        <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab" tabindex="0">
                          <div class="quicktech-review">


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



                                                          
                                                          {{-- submit review--}}
                                                          @if(auth()->guard('student')->check()) 
                                                          @php
                                                              $student = auth()->guard('student')->user();
                                                              $isEnrolled = \App\Models\Ebookenroll::where('student_id', $student->id)
                                                                  ->where('ebook_id', $ebook->id)
                                                                  ->exists();
                                                                  // dd( $isEnrolled);
                                                          @endphp
                                                      
                                                          @if($isEnrolled)
                                                              <div class="add-review mt-4">
                                                                  <form action="{{ route('ebookreviews.store', $ebook->id) }}" method="POST">
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
                      <div class="course-title">Ebook Details</div>
                    <ul class="course-list">
                      <li class="course-list-item">
                        <i>&#128101;</i>
                        <strong>Viewed :</strong> 1200 students
                      </li>
                     
                    </ul>
                    </div>
                    <div class="quikctech-pp">
                      <div class="course-price">Price: {{$ebook->price}}Tk</div>
                      {{-- <button class="course-button">View Ebook</button> --}}
                      <a class="course-button" href="{{ route('ebook.Checkout', $ebook->id) }}">Ebook Purchase</a>
                      {{-- <a class="course-button" href="">View Ebook</a> --}}
                    </div>
                  </div>

                  <div class="quicktech-recent-course mt-5">
                    <h3>Suggested Ebooks</h3>
                   <div class="quikctech-in-cour">

                    @forelse ( $suggestedebooks as  $suggestedebook )
                    <div class="quicktech-recent-inner mt-3 d-flex gap-3">
                        <a href="{{ route('ebookdetails', $suggestedebook->id) }}">
                            <div class="quikcteck-recent-img">
                                <img src="{{asset($suggestedebook->photo)}}" alt="">
                             </div>
                             <div class="quikctech-recent-details">
                                <h4>{{$suggestedebook->title}}<br>  <p>{{ Str::limit($suggestedebook->description, 10) }}</p></h4>
                                <div class="quikctech-enroll-btnn mt-2">
                                    <p>{{$suggestedebook->price}} tk</p>
                                    <a class="quikctech-entrolll" href="{{ route('ebookdetails', $suggestedebook->id) }}">View Now</a>
                                  </div>
                             </div>
                        </a>
                       </div>
                      
                    @empty
                        <h6>No Ebook found</h6>
                    @endforelse
                   
                      
                       
                          
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
            <h1>Recent Ebooks</h1>
          </div>
        </div>
      </div>
     
  
      <div class="row mt-4 mb-5">
        <div class="col-lg-12">
          <!-- Slider main container -->
  <div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">

        @forelse ($relatedebooks as  $relatedebook)
        <div class="swiper-slide">
            <a href="{{route('ebookdetails',$relatedebook->id)}}">
             <div class="quicktech-ebooks-inner">
              <div class="quikctech-ebook-img">
                <img src="{{asset($relatedebook->photo)}}" class="w-100" alt="">
              </div>
              <div class="quicktech-ebook-text">
                <h4>{{$relatedebook->title}}</h4>
                <p>{{Str::limit($relatedebook->description,10)}} </p>
              </div>
              <div class="quikctech-enroll-btn mt-5">
                <p>{{$relatedebook->price}} tk</p>
                <a class="quikctech-entroll" href="{{ route('ebookdetails', $relatedebook->id) }}">View Now</a>
              </div>
             </div>
            </a>
          </div>
        @empty
        <h6>No Ebooks</h6>
            
        @endforelse
        
         
      
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
   <!-- ebook course -->

   @endsection