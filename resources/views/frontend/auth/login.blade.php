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
                            <img src="https://learnengwithshahan.com/assets/frontend/images/signup-banner-2x.png" class="w-100" alt="">
                        </div>
                        <div class="quikctech-img-text">
                            @php
                                use App\Models\Page;
                                $pages = Page::orderBy('id', 'DESC')->get();
                                $terms = Page::where('id', 3)->first();
                                $policy = Page::where('id', 4)->first();
                            @endphp

                            <h3>Join Learn with Shahan and learn with us</h3>
                            <h4>Log in to Learn with Shahan to get started!</h4>

                            <p>By logging in to Learn with Shahan, you agree to our 
                                <a href="{{ route('pagesdetails', $terms->name) }}">Terms of use</a> 
                                and 
                                <a href="{{ route('pagesdetails', $policy->name) }}">Privacy Policy.</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="quikctch-login-inner">
                        <div class="w-100">
                            <h2 class="mb-4">Log in</h2>

                            {{-- Flash Messages --}}
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="d-grid quikctech-login-with gap-2 mb-3">
                                <button class="btn btn-light border" type="button">
                                    <a href="{{ route('google.login') }}" class="login-with-google-btn">
                                        <img src="../../../assets/frontend/images/search.png" class="me-2" alt="Google">
                                        Continue with Google
                                    </a>
                                </button>
                            </div>

                            <form action="/student/login" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email or username <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <a href="{{ route('forgetpassword') }}" class="text-decoration-none">Forgot password?</a>
                                </div>
                                <button type="submit" class="btn btn-secondary w-100">Log in</button>
                            </form>

                            <p class="text-center mt-3">
                                Need a Learn with Shahan account? 
                                <a href="{{ route('রেজিস্ট্রেশন করুন') }}" class="text-decoration-none">Create an account</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login -->

    {{-- Auto-hide alerts after a few seconds --}}
    <script>
        setTimeout(function () {
            let alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('hide');
            }
        }, 4000);
    </script>
@endsection
