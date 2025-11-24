
@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>Sign in - {{ env('APP_NAME') }}</title>
    @endsection
    

    
 <!-- login -->
 <section id="quikctech-login" class="pt-100">
    <div class="container">
      <div class="row gapp">
        <div class="col-lg-6 order-2 order-lg-1">
          <div class="quicktech-sign-in-img-inner">
            <div class="quikctech-sign-in-img">
              <img src="images/signup-banner-2x.png" class="w-100" alt="">
            </div>
            <div class="quikctech-img-text">
              <h3>Join Learn with Shahan and learn with us</h3>
              <h4>Log in to Learn with Shahan to get started!</h4>
              <p>By logging in to Learn with Shahan, you agree to our <a href="#">Terms of use</a> and <a href="#">Privacy Policy.</a></p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
         <div class="quikctch-login-inner">
          <div class="w-100">
            <h2 class="mb-4">Log in</h2>

            <div class="d-grid quikctech-login-with gap-2 mb-3">
                <button class="btn btn-light border" type="button">
                    <img src="images/search.png" class="me-2" alt="Google"> Continue with Google
                </button>
               
                <button class="btn btn-light border" type="button">
                    <img src="images/apple-logo.png" class="me-2" alt="Apple"> Continue with Apple
                </button>
            </div>

            <p class="text-danger small mb-1 my-4 mb-3">* indicates a required field.</p>

            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Email or username <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password" placeholder="">
                </div>
                <div class="mb-3">
                    <a href="forgot.html" class="text-decoration-none">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-secondary w-100">Log in</button>
            </form>

            <p class="text-center mt-3">
                Need a Learn with Shahan account? <a href="{{route('signup')}}" class="text-decoration-none">Create an account</a>
            </p>
        </div>
         </div>
        </div>
      </div>
    </div>
   </section>

 <!-- login -->


@endsection