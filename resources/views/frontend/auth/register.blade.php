@extends('frontend.layout.theme')
{{--@section('content')

    <main>

        <!-- sign up area start -->
        <section class="signup__area po-rel-z1 pt-100 pb-145">
            <div class="sign__shape">
                <img class="man-1" src="../../../assets/frontend/img/icon/sign/man-3.png" alt="">
                <img class="man-2 man-22" src="../../../assets/frontend/img/icon/sign/man-2.png" alt="">
                <img class="circle" src="../../../assets/frontend/img/icon/sign/circle.png" alt="">
                <img class="zigzag" src="../../../assets/frontend/img/icon/sign/zigzag.png" alt="">
                <img class="dot" src="../../../assets/frontend/img/icon/sign/dot.png" alt="">
                <img class="bg" src="../../../assets/frontend/img/icon/sign/sign-up.png" alt="">
                <img class="flower" src="../../../assets/frontend/img/icon/sign/flower.png" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                        <div class="section__title-wrapper text-center mb-55">
                            <h2 class="section__title bn-font">Create a New Student Account <br> Completely Free</h2>
                            <p class="bn-normal">Purchase any course and access all class, study, and data in the same panel</p>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div class="sign__wrapper white-bg">
                           
                            <div class="sign__form">
                                <form action="/student/register" method="POST">
                                    @csrf
                                    <div class="sign__input-wrapper mb-25">
                                        <h5 class="bn-font">Full Name</h5>
                                        <div class="sign__input">
                                            <input type="text" placeholder="Full name" name="name">
                                            <i class="fal fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="sign__input-wrapper mb-25">
                                        <h5 class="bn-font">Email</h5>
                                        <div class="sign__input">
                                            <input type="text" placeholder="Enter your email" name="email">
                                            <i class="fal fa-envelope"></i>
                                        </div>
                                    </div>

                                    <div class="sign__input-wrapper mb-25">
                                        <h5 class="bn-font">Number</h5>
                                        <div class="sign__input">
                                            <input type="text" placeholder="Enter your Number" name="phone">
                                            <i class="fal fa-phone"></i>
                                        </div>
                                    </div>

                                    <div class="sign__input-wrapper mb-25">
                                        <h5 class="bn-font">Password</h5>
                                        <div class="sign__input">
                                            <input type="password" placeholder="password" name="password">
                                            <i class="fal fa-lock"></i>
                                        </div>
                                    </div>

                                    <div class="sign__action d-flex justify-content-between mb-30">
                                        <div class="sign__agree d-flex align-items-center">
                                            <input class="m-check-input" type="checkbox" id="m-agree">
                                            <label class="m-check-label" for="m-agree">I agree to follow all your <a href="#">Terms and Conditions</a></label>

                                        </div>
                                    </div>
                                    <button class="e-btn w-100"> <span></span> Register Now</button>
                                    <div class="sign__new text-center mt-20">
                                        <p class="bn-normal">Already have an account? <a href="{{ url('login') }}">Login</a></p>

                                    </div>
                                </form>
                            </div>
                            <div class="mt-4 text-center">
                                <a href="{{ route('google.login') }}" class="login-with-google-btn">Sign in with Google</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- sign up area end -->

    </main>






@endsection
--}}



@section('content')
    @section('meta_content')
    <title>Register - {{ env('APP_NAME') }}</title>
    @endsection

    

    <!-- register -->
   <section id="quikctech-register" class="pt-100">
    <div class="container">
      <div class="row gapp">
        <div class="col-lg-6 order-2 order-lg-1">
          <div class="quicktech-sign-in-img-inner">
            <div class="quikctech-sign-in-img">
              <img src="../../../assets/frontend/images/signup-banner-2x.png" class="w-100" alt="">
            </div>
            <div class="quikctech-img-text">
                @php
                use App\Models\Page;
                $pages = Page::orderBy('id', 'DESC')->get();
                $terms = Page::where('id',3)->first();
                $policy = Page::where('id',4)->first();
              @endphp
               
              <h3>Join Learn with Shahan to activate your teaching</h3>
              <h4>Log in to Learn with Shahan to get started!</h4>
              <p>By Signing up in to Learn with Shahan, you agree to our <a href="{{route('pagesdetails',$terms->name)}}">Terms of use</a> and <a href="{{route('pagesdetails',$policy->name)}}">Privacy Policy.</a></p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
         <div class="quikctch-login-inner">
          <div class="w-100">
            <h2>Sign Up</h2>
            <p>Join Learn with Shahan for free as a</p>
            <div id="login-options">
                <ul class="nav quikctech-tabs nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-student-tab" data-bs-toggle="pill" data-bs-target="#pills-student" type="button" role="tab" aria-controls="pills-student" aria-selected="true">Student</button>
                  </li>
                  {{-- <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-teacher-tab" data-bs-toggle="pill" data-bs-target="#pills-teacher" type="button" role="tab" aria-controls="pills-teacher" aria-selected="false">Teacher</button>
                  </li> --}}
                </ul>
              
                <div class="tab-content mt-4" id="pills-tabContent">
                    <!-- Student Tab -->
                    <div class="tab-pane fade show active" id="pills-student" role="tabpanel" aria-labelledby="pills-student-tab" tabindex="0">
                        <div class="d-grid quikctech-login-with gap-2 mb-3">
                            <button class="btn btn-light border" type="button">
                                <a href="{{ route('google.login') }}" class="login-with-google-btn">  <img src="../../../assets/frontend/images/search.png" class="me-2" alt="Google"> Continue with Google</a>
                            </button>
                         
                            
                           
                        </div>
                        
                        <!-- Student Form -->
                        <form  action="/student/register" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="student-name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="student-name" name="name" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="student-email" class="form-label">Your Email</label>
                                <input type="email" class="form-control" id="student-email" name="email" placeholder="example@email.com">
                            </div>
                            <div class="mb-3">
                                <label for="student-phone" class="form-label">Your Phone</label>
                                <input type="phone" class="form-control" id="student-phone" name="phone" placeholder="+8801234567890">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="student-birthday" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="student-birthday">
                            </div> --}}
                            <div class="mb-3">
                                <label for="student-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="student-password" name="password" placeholder="At least 8 characters">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="student-confirmpassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="student-confirmpassword" placeholder="Re-enter your password">
                            </div> --}}
                            <div class="quikctech-sign-up-btn">
                                <button type="submit" class="btn btn-primary w-50">Sign Up</button>
                            </div>
                        </form>
                    </div>
                    <p class="text-center mt-3">
                        Already have an account? <a href="{{route('লগইন করুন')}}" class="text-decoration-none">Sign In</a>
                    </p>
                    <!-- Teacher Tab -->
                    <div class="tab-pane fade" id="pills-teacher" role="tabpanel" aria-labelledby="pills-teacher-tab" tabindex="0">
                        <div class="d-grid quikctech-login-with gap-2 mb-3">
                            <button class="btn btn-light border" type="button">
                                <img src="../../../assets/frontend/images/search.png" class="me-2" alt="Google"> Continue with Google
                            </button>
                        </div>
                        
                        <!-- Teacher Form -->
                        <form>
                            <div class="mb-3">
                                <label for="teacher-name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="teacher-name" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="teacher-email" class="form-label">Your Email</label>
                                <input type="email" class="form-control" id="teacher-email" placeholder="example@email.com">
                            </div>
                            <div class="mb-3">
                                <label for="teacher-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="teacher-password" placeholder="At least 8 characters">
                            </div>
                            <div class="mb-3">
                                <label for="teacher-confirmpassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="teacher-confirmpassword" placeholder="Re-enter your password">
                            </div>
                            <div class="quikctech-sign-up-btn">
                                <button type="submit" class="btn btn-primary w-50">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
              
              </div>
        </div>
         </div>
        </div>
      </div>
    </div>
   </section>


 <!-- register -->

@endsection