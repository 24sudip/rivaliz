@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>All Exams - {{ env('APP_NAME') }}</title>
    @endsection
    
    <!-- teachers -->
    <section style="background: url(./images/bannn.jpg) center center / cover no-repeat;" id="quikctech-teachers-title" class="pt-100">
        <div class="overlay">
            <div class="container">
                <div class="row">
                 <div class="col-lg-12">
                 <div class="quikctech-teachers-head text-center">
                   <h1>Teachers</h1>
                   <h5> <i class="fa-solid fa-house"></i> Home / Teachers</h5>
                 </div> 
                 </div>
                </div>
            </div>
        </div>
     </section>
     <section id="quciketch-teacher-all">
        <div class="container">
            <div class="row gap my-5">
                 @forelse($instructors as $instructor)
                <div class="col-lg-3 col-6">
                  <a href="">
                    <div class="quicktech-course-innerr">
                        <div class="quikctech-mentorr-img">
                          <img src="{{asset($instructor->image)}}" class="w-100" alt="">
                        </div>
                        <div class="quicktech-course-textt">
                          <h3>{{$instructor->name}}</h3>
                          <span>{{$instructor->profession}}</span>
                            <h5><img src="images/multimedia.png" alt=""> 6 courses</h5>
                        </div>
                      </div>
                  </a>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>No ebooks found at the moment.</p>
                    
                   </div>
                @endforelse
                {{-- <div class="col-lg-3 col-6">
                    <a href="teacherdetails.html">
                      <div class="quicktech-course-innerr">
                          <div class="quikctech-mentorr-img">
                            <img src="images/p2.jpg" class="w-100" alt="">
                          </div>
                          <div class="quicktech-course-textt">
                            <h3>Pablo Joseph</h3>
                            <span>Web Developer</span>
                              <h5><img src="images/multimedia.png" alt=""> 6 courses</h5>
                          </div>
                        </div>
                    </a>
                  </div>
                  <div class="col-lg-3 col-6">
                    <a href="teacherdetails.html">
                      <div class="quicktech-course-innerr">
                          <div class="quikctech-mentorr-img">
                            <img src="images/p3.jpg" class="w-100" alt="">
                          </div>
                          <div class="quicktech-course-textt">
                            <h3>Pablo Joseph</h3>
                            <span>Web Designer</span>
                              <h5><img src="images/multimedia.png" alt=""> 6 courses</h5>
                          </div>
                        </div>
                    </a>
                  </div>
                  <div class="col-lg-3 col-6">
                    <a href="teacherdetails.html">
                      <div class="quicktech-course-innerr">
                          <div class="quikctech-mentorr-img">
                            <img src="images/p1.jpg" class="w-100" alt="">
                          </div>
                          <div class="quicktech-course-textt">
                            <h3>Pablo Joseph</h3>
                            <span>Web Designer</span>
                              <h5><img src="images/multimedia.png" alt=""> 6 courses</h5>
                          </div>
                        </div>
                    </a>
                  </div>
                  <div class="col-lg-3 col-6">
                    <a href="teacherdetails.html">
                      <div class="quicktech-course-innerr">
                          <div class="quikctech-mentorr-img">
                            <img src="images/p2.jpg" class="w-100" alt="">
                          </div>
                          <div class="quicktech-course-textt">
                            <h3>Pablo Joseph</h3>
                            <span>Web Designer</span>
                              <h5><img src="images/multimedia.png" alt=""> 6 courses</h5>
                          </div>
                        </div>
                    </a>
                  </div>
                  <div class="col-lg-3 col-6">
                    <a href="teacherdetails.html">
                      <div class="quicktech-course-innerr">
                          <div class="quikctech-mentorr-img">
                            <img src="images/p1.jpg" class="w-100" alt="">
                          </div>
                          <div class="quicktech-course-textt">
                            <h3>Pablo Joseph</h3>
                            <span>Web Designer</span>
                              <h5><img src="images/multimedia.png" alt=""> 6 courses</h5>
                          </div>
                        </div>
                    </a>
                  </div>
                  <div class="col-lg-3 col-6">
                    <a href="teacherdetails.html">
                      <div class="quicktech-course-innerr">
                          <div class="quikctech-mentorr-img">
                            <img src="images/p3.jpg" class="w-100" alt="">
                          </div>
                          <div class="quicktech-course-textt">
                            <h3>Pablo Joseph</h3>
                            <span>Web Designer</span>
                              <h5><img src="images/multimedia.png" alt=""> 6 courses</h5>
                          </div>
                        </div>
                    </a>
                  </div>
                  <div class="col-lg-3 col-6">
                    <a href="teacherdetails.html">
                      <div class="quicktech-course-innerr">
                          <div class="quikctech-mentorr-img">
                            <img src="images/p2.jpg" class="w-100" alt="">
                          </div>
                          <div class="quicktech-course-textt">
                            <h3>Pablo Joseph</h3>
                            <span>Web Designer</span>
                              <h5><img src="images/multimedia.png" alt=""> 6 courses</h5>
                          </div>
                        </div>
                    </a>
                  </div>
              </div> --}}
        </div>
     </section>


   <!-- teachers -->

@endsection