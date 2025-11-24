


@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>Sign in - {{ env('APP_NAME') }}</title>
    @endsection

    

    <!-- register -->
   <section id="quikctech-register" class="pt-100">
    <div class="container">
      <div class="row gapp">
        <div class="col-lg-6 order-2 order-lg-1">
          <div class="quicktech-sign-in-img-inner">
            <div class="quikctech-sign-in-img">
              <img src="images/signup-banner-2x.png" class="w-100" alt="">
            </div>
            <div class="quikctech-img-text">
              <h3>Join Learn with Shahan to activate your teaching</h3>
              <h4>Log in to Learn with Shahan to get started!</h4>
              <p>By Signing up in to Learn with Shahan, you agree to our <a href="#">Terms of use</a> and <a href="#">Privacy Policy.</a></p>
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
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-teacher-tab" data-bs-toggle="pill" data-bs-target="#pills-teacher" type="button" role="tab" aria-controls="pills-teacher" aria-selected="false">Teacher</button>
                  </li>
                </ul>
              
                <div class="tab-content mt-4" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-student" role="tabpanel" aria-labelledby="pills-student-tab" tabindex="0">
                    <div class="d-grid quikctech-login-with gap-2 mb-3">
                        <button class="btn btn-light border" type="button">
                            <img src="images/search.png" class="me-2" alt="Google"> Continue with Google
                        </button>
                        <button class="btn btn-light border" type="button">
                            <img src="images/apple-logo.png" class="me-2" alt="Apple"> Continue with Apple
                        </button>
                      <button class="btn btn-light border" type="button" id="email-student">
                        <img src="images/mail.png" class="me-2" alt="Email"> Continue with Email
                      </button>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="pills-teacher" role="tabpanel" aria-labelledby="pills-teacher-tab" tabindex="0">
                    <div class="d-grid quikctech-login-with gap-2 mb-3">
                        <button class="btn btn-light border" type="button">
                            <img src="images/search.png" class="me-2" alt="Google"> Continue with Google
                        </button>
                        <button class="btn btn-light border" type="button">
                            <img src="images/apple-logo.png" class="me-2" alt="Apple"> Continue with Apple
                        </button>
                      <button class="btn btn-light border" type="button" id="email-teacher">
                        <img src="images/mail.png" class="me-2" alt="Email"> Continue with Email
                      </button>
                    </div>
                  </div>
                </div>
                <p class="text-center mt-3">
                    Already have an account? <a href="{{route('signin')}}" class="text-decoration-none">Sign In</a>
                </p>
              </div>
              
              <div id="student-form" class="d-none">
                <form>
                    <div class="mb-3">
                        <label for="first-name" class="form-label">Full name</label>
                        <input type="text" class="form-control" id="first-name" placeholder="Enter your name">
                      </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Your email</label>
                    <input type="email" class="form-control" id="email" placeholder="example@email.com">
                  </div>
                  <div class="mb-3">
                    <label for="birthday" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="birthday">
                  </div>
                 
                  <div class="mb-3">
                    <label for="password" class="form-label">Password <br> <p class="quikctech-pass-text">Passwords should be at least 8 characters long and should contain a mixture of letters, numbers, and other characters.
                    </p></label>
                    <input type="password" class="form-control" id="password" placeholder="At least 8 characters">
                  </div>
                  <div class="mb-3">
                    <label for="confirmpassword" class="form-label">Confirm password</label>
                    <input type="password" class="form-control" id="confirmpassword" placeholder="Re-enter your password">
                  </div>
                  <div class="quikctech-sign-up-btn">
                    <a id="back-button-student">Back</a>
                    <button type="submit" class="btn btn-primary w-50">Sign up</button>
                  </div>
                  
                </form>
              </div>
              
              <div id="teacher-form" class="d-none">
                <form>
                    <div class="mb-3">
                        <label for="first-name" class="form-label">Full name</label>
                        <input type="text" class="form-control" id="first-name" placeholder="Enter your name">
                      </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Your email</label>
                    <input type="email" class="form-control" id="email" placeholder="example@email.com">
                  </div>
              
                 
                  <div class="mb-3">
                    <label for="password" class="form-label">Password <br> <p class="quikctech-pass-text">Passwords should be at least 8 characters long and should contain a mixture of letters, numbers, and other characters.
                    </p></label>
                    <input type="password" class="form-control" id="password" placeholder="At least 8 characters">
                  </div>
                  <div class="mb-3">
                    <label for="confirmpassword" class="form-label">Confirm password</label>
                    <input type="password" class="form-control" id="confirmpassword" placeholder="Re-enter your password">
                  </div>
                  <div class="quikctech-sign-up-btn">
                    <a id="back-button-teacher">Back</a>
                    <button type="submit" class="btn btn-primary w-50">Sign up</button>
                  </div>
                  
                </form>
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



