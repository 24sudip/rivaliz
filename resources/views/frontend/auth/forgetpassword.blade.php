@extends('frontend.layout.theme')

@section('content')
<style>
    .sign__input input::placeholder {
    color: #999;
    font-style: italic;
}

.sign__wrapper {
    transition: all 0.3s ease-in-out;
}

.sign__wrapper:hover {
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}


.custom-btn {
    background: linear-gradient(135deg, #4f46e5, #3b82f6);
    border: none;
    color: #fff;
    padding: 12px 24px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
    position: relative;
    overflow: hidden;
}

.custom-btn:hover {
    background: linear-gradient(135deg, #3b82f6, #4f46e5);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
}

.custom-btn i {
    margin-right: 6px;
    transition: transform 0.3s ease;
}

.custom-btn:hover i {
    transform: translateX(3px);
}

</style>
<main>
    <!-- forget password area start -->
    <section class="signup__area po-rel-z1 pt-100 pb-145">
        <div class="sign__shape">
            <img class="man-1" src="{{ asset('assets/frontend/img/icon/sign/man-1.png') }}" alt="">
            <img class="man-2" src="{{ asset('assets/frontend/img/icon/sign/man-2.png') }}" alt="">
            <img class="circle" src="{{ asset('assets/frontend/img/icon/sign/circle.png') }}" alt="">
            <img class="zigzag" src="{{ asset('assets/frontend/img/icon/sign/zigzag.png') }}" alt="">
            <img class="dot" src="{{ asset('assets/frontend/img/icon/sign/dot.png') }}" alt="">
            <img class="bg" src="{{ asset('assets/frontend/img/icon/sign/sign-up.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                    <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title bn-font">Forgot Password</h2>
                        <p class="mt-10 text-muted">Enter your phone number and we’ll send you instructions to reset your password.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-6 col-lg-8">
                    <div class="sign__wrapper white-bg shadow p-4 rounded-4">
                        <div class="sign__form">
                            <form action="/student/forget-password" method="POST">
                                @csrf
                                <div class="sign__input-wrapper mb-30">
                                    <h5 class="bn-font">Phone Number</h5>
                                    <div class="sign__input">
                                        <input type="text" name="phone" placeholder="01XXXXXXXXX" required>
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>

                                <button type="submit" class="custom-btn w-100 mt-5">
                                    <i class="fas fa-paper-plane me-2"></i> Send OTP
                                </button>
                                
                                <div class="text-center mt-3">
                                    <a href="{{ route('লগইন করুন') }}" class="text-primary small">Back to login</a>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- forget password area end -->
</main>
@endsection
