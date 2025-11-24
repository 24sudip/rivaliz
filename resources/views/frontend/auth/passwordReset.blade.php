@extends('frontend.layout.theme')

@section('content')
<style>
    .custom-btn-sm {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    border: none;
    color: #fff;
    padding: 8px 20px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 6px;
    transition: all 0.3s ease-in-out;
    position: relative;
    overflow: hidden;
    line-height: 1.4;
}

.custom-btn-sm:hover {
    background: linear-gradient(135deg, #16a34a, #22c55e);
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(34, 197, 94, 0.25);
}

.custom-btn-sm i {
    margin-right: 4px;
    font-size: 13px;
    transition: transform 0.3s ease;
}

.custom-btn-sm:hover i {
    transform: translateX(2px);
}

</style>
<main>
    <!-- password reset area start -->
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
                    <div class="section__title-wrapper text-center mb-50">
                        <h2 class="section__title bn-font">Reset Your Password</h2>
                        <p class="text-muted mt-2">Enter the new password and token sent to your phone.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-6 col-lg-8">
                    <div class="sign__wrapper white-bg shadow p-4 rounded-4">
                        <div class="sign__form">
                            <form action="/student/reset-password" method="POST">
                                @csrf
                                <div class="sign__input-wrapper mb-30">
                                    <h5 class="bn-font">New Password</h5>
                                    <div class="sign__input">
                                        <input type="password" name="password" placeholder="********" required>
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>

                                <div class="sign__input-wrapper mb-30 mt-2">
                                    <h5 class="bn-font">Verification Token</h5>
                                    <div class="sign__input">
                                        <input type="text" name="passresetToken" placeholder="Enter 6-digit code" required>
                                        <i class="fas fa-key"></i>
                                    </div>
                                </div>

                                <button type="submit" class="custom-btn-sm w-100 mt-2">
                                    <i class="fas fa-check-circle me-1"></i> Confirm Reset
                                </button>

                                <div class="text-center mt-3">
                                    <a href="/student/login" class="text-primary small">Back to login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- password reset area end -->
</main>
@endsection
