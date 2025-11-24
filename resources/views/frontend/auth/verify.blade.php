@extends('frontend.layout.theme')
@section('content')
    <main>

        <!-- sign up area start -->
        <section class="signup__area po-rel-z1 pt-100 pb-145">
            <div class="sign__shape">
                <img class="man-1" src="../../../assets/frontend/img/icon/sign/man-1.png" alt="">
                <img class="man-2" src="../../../assets/frontend/img/icon/sign/man-2.png" alt="">
                <img class="circle" src="../../../assets/frontend/img/icon/sign/circle.png" alt="">
                <img class="zigzag" src="../../../assets/frontend/img/icon/sign/zigzag.png" alt="">
                <img class="dot" src="../../../assets/frontend/img/icon/sign/dot.png" alt="">
                <img class="bg" src="../../../assets/frontend/img/icon/sign/sign-up.png" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                        <div class="section__title-wrapper text-center mb-55">
                            <h2 class="section__title bn-font">Please verify</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div class="sign__wrapper white-bg">

                            <div class="sign__form">
                                <form action="/student/verify" method="POST">
                                    @csrf
                                    <div class="sign__input-wrapper mb-25">
                                        <h5 class="bn-font">OTP <small class="fst-italic">sent to your mobile</small> </h5>
                                        <div class="sign__input">
                                            <input type="text" placeholder="Enter OTP" name="otp">
                                            <i class="fas fa-key"></i>
                                        </div>
                                    </div>
                                    
                                    <button class="e-btn  w-100"> <span></span> Submit </button>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- sign up area end -->

    </main>
@endsection
