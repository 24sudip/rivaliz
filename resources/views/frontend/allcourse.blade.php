@extends('frontend.layout.theme')
@section('content')
  
  
   <!-- desktop navbar -->

   <!-- all courses -->
     <section style="background: url(./images/bannn.jpg) center center / cover no-repeat;" id="quikctech-teachers-title" class="pt-100">
        <div class="overlay">
            <div class="container">
                <div class="row">
                 <div class="col-lg-12">
                 <div class="quikctech-teachers-head text-center">
                   <h1>Courses</h1>
                   <h5> <i class="fa-solid fa-house"></i> Home / Courses</h5>
                 </div> 
                 </div>
                </div>
            </div>
        </div>
      
     </section>

     <section id="quicktech-all-courses">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="quicktech-filter d-flex justify-content-end align-items-center gap-3 text-end">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Filter
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">Paid</a></li>
                              <li><a class="dropdown-item" href="#">Free</a></li>
                            </ul>
                          </div>
                          <div class="quicktech-advance">
                            <select name="skillLevel" id="skillLevel">
                                <option value="" disabled selected>Skill level</option>
                                <option value="beginner">Beginner</option>
                                <option value="advanced">Advanced</option>
                            </select>
                          </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3 mb-5 gapp">

            @foreach($allcourses as $course)
                <div class="col-lg-4 col-sm-6">
                    <a href="{{route('coursedetails',$course->id)}}">
                        <div class="quicktech-course-inner">
                          <div class="quikctech-course-img">
                            <img src="{{asset($course->thumbnil_image)}}" class="w-100" alt="">
                          </div>
                          <div class="quicktech-course-text">
                            <span>Web Design</span>
                            <h3>{{$course->name}}</h3>
                            <div class="quikctech-enroll-btn mt-5">
                              <p>{{$course->price}}tk</p>
                              <a class="quikctech-entroll" href="checkout.html">Enroll Now</a>
                            </div>
                          </div>
                        </div>
                      </a>
                </div>
            @endforeach
<!-- 
                <div class="col-lg-4 col-sm-6">
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

                <div class="col-lg-4 col-sm-6">
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
                <div class="col-lg-4 col-sm-6">
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
                <div class="col-lg-4 col-sm-6">
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
                <div class="col-lg-4 col-sm-6">
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
        </div>
     </section>  

   <!-- all courses -->







 @endsection