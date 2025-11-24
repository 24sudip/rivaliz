<!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
@extends('frontend.layout.theme')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- checkout -->
<section style="background: url({{ asset('assets/frontend/images') }}/bannn.jpg) center center / cover no-repeat;" id="quikctech-teachers-title" class="pt-100">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="quikctech-teachers-head text-center">
                        <h1>Checkout</h1>
                        <h5><i class="fa-solid fa-house"></i> Home / Checkout</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="quicktech-checkout">
    <div class="container">
        <form method="POST" action="{{ route('billing.store') }}" enctype="multipart/form-data">
            {{-- <form method="POST" action="order/save" enctype="multipart/form-data"> --}}
            @csrf
            <div class="row gap my-5">
                <div class="col-lg-8">
                    <div class="quikctech-billing-address">
                        <div class="quicktech-billing-head mb-3">
                            <h4>Billing Address</h4>
                        </div>
                        <div class="quicktech-form-group">
                            
                            @if($course->name)
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <input type="hidden" name="course_price" value="{{ $course->price }}">
                            @else
                            <input type="hidden" name="ebook_id" value="{{ $course->id }}">
                            <input type="hidden" name="ebook_price" value="{{ $course->price }}">
                            @endif


                            {{-- <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <input type="hidden" name="course_price" value="{{ $course->price }}"> --}}
                            
                            <input name="name" type="text" class="form-control quicktech-form-control" value="{{auth()->guard('student')->user()->name}}" placeholder="Name *">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="quicktech-form-group">
                        <input type="text" class="form-control quicktech-form-control" placeholder="Company name">
                        </div> --}}
                        <div class="quicktech-form-group">
                            <select name="country" class="form-control quicktech-form-control">
                                <option>Select A Country</option>
                                <option value="Bangladesh" selected>Bangladesh</option>
                                <option value="USA">USA</option>
                                <option value="India">India</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                            </select>
                            @error('country')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--<div class="quicktech-form-group">-->
                        <!--    <input name="division" type="text" class="form-control quicktech-form-control" placeholder="Division">-->
                        <!--    @error('division')-->
                        <!--    <span class="text-danger">{{ $message }}</span>-->
                        <!--    @enderror-->
                        <!--</div>-->
                        <!--<div class="quicktech-form-group">-->
                        <!--    <input name="district" type="text" class="form-control quicktech-form-control" placeholder="District">-->
                        <!--    @error('district')-->
                        <!--    <span class="text-danger">{{ $message }}</span>-->
                        <!--    @enderror-->
                        <!--</div>-->
                        <!--<div class="quicktech-form-group">-->
                        <!--    <input name="upzilla" type="text" class="form-control quicktech-form-control" placeholder="Town / City / Thana / Upzilla">-->
                        <!--    @error('upzilla')-->
                        <!--    <span class="text-danger">{{ $message }}</span>-->
                        <!--    @enderror-->
                        <!--</div>-->
                        <!--<div class="quicktech-form-group">-->
                        <!--    <input name="address" type="text" class="form-control quicktech-form-control" placeholder="House Number And Street Name">-->
                        <!--    @error('address')-->
                        <!--    <span class="text-danger">{{ $message }}</span>-->
                        <!--    @enderror-->
                        <!--</div>-->
                        <!--<div class="quicktech-form-group">-->
                        <!--    <input name="apartment" type="text" class="form-control quicktech-form-control" placeholder="Apartment, suite, unit, etc. (optional)">-->
                        <!--    @error('apartment')-->
                        <!--    <span class="text-danger">{{ $message }}</span>-->
                        <!--    @enderror-->
                        <!--</div>-->
                        {{-- <div class="quicktech-form-group">
                        <input type="text" class="form-control quicktech-form-control" placeholder="ZIP Code *">
                        </div> --}}
                        <div class="quicktech-form-group">
                            <input name="phone" type="tel" value="{{auth()->guard('student')->user()->phone}}" class="form-control quicktech-form-control" placeholder="Phone *">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quicktech-form-group">
                            <input name="email" type="email" class="form-control quicktech-form-control" placeholder="Email address *">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="quicktech-shipping-info mt-5">
                        <div style="align-items: baseline;" class="form-check d-flex gap-2 mb-3">
                            <input type="checkbox" class="form-check-input" id="quicktech-ship-toggle">
                            <label class="form-check-label quicktech-checkbox-label quicktech-shipping-head" for="quicktech-ship-toggle">Ship to a different address?</label>
                        </div>

                        <form id="quicktech-shipping-form" class="quicktech-hidden">
                            <div class="row">
                            <div class="col-md-6 quicktech-form-group">
                                <input type="text" class="form-control quicktech-form-control" placeholder="First name *">
                            </div>
                            <div class="col-md-6 quicktech-form-group">
                                <input type="text" class="form-control quicktech-form-control" placeholder="Last name *">
                            </div>
                            </div>
                            <div class="quicktech-form-group">
                            <input type="text" class="form-control quicktech-form-control" placeholder="Company name">
                            </div>
                            <div class="quicktech-form-group">
                            <select class="form-control quicktech-form-control">
                                <option>United States (US)</option>
                            </select>
                            </div>
                            <div class="quicktech-form-group">
                            <input type="text" class="form-control quicktech-form-control" placeholder="House number and street name">
                            </div>
                            <div class="quicktech-form-group">
                            <input type="text" class="form-control quicktech-form-control" placeholder="Apartment, suite, unit, etc. (optional)">
                            </div>
                            <div class="quicktech-form-group">
                            <input type="text" class="form-control quicktech-form-control" placeholder="Town / City *">
                            </div>
                            <div class="quicktech-form-group">
                            <select class="form-control quicktech-form-control">
                                <option>New York</option>
                            </select>
                            </div>
                            <div class="quicktech-form-group">
                            <input type="text" class="form-control quicktech-form-control" placeholder="ZIP Code *">
                            </div>
                            <div class="quicktech-form-group">
                            <input type="text" class="form-control quicktech-form-control" placeholder="Phone *">
                            </div>
                            <div class="quicktech-form-group">
                            <input type="email" class="form-control quicktech-form-control" placeholder="Email address *">
                            </div>

                        </form>
                    </div> --}}
                    <div class="quicktech-form-group">
                        <label style="padding-left: 10px; padding-bottom: 10px;" for="notes">Order notes (optional)</label>
                        <textarea name="notes" id="notes" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="quicktech-order-card card p-4 shadow-sm">
                        <h5 class="quicktech-order-title card-title mb-4">Your order</h5>
                        <table class="quicktech-order-table table">
                            <tbody>
                                <tr>
                                  <td>{{ $course->name ?? $course->title }} <span class="text-muted">× 1</span></td>
                                  <td class="text-end">৳ {{ $course->price }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td class="text-end">৳ 0.00</td>
                                </tr>
                            </tbody>
                        </table>
                        <style>
                            .crs_btn {
                                cursor: pointer;
                            }
                        </style>
                        <table class="quicktech-order-table table mb-4" id="couponCalField">

                        </table>
                        <div class="quikctech-coupon">
                            @if (Session::has('coupon'))
                            {{-- <pre>
                                {{ json_encode(Session::get('coupon'), JSON_PRETTY_PRINT) }}
                            </pre> --}}
                            @else
                            <form action="#">
                                <div class="quicktech-form-group quikctech-cou-inner" id="couponField">
                                    <input type="text" class="form-control quicktech-form-control" placeholder="Add Coupon" id="coupon_name" name="coupon_name">
                                    <a class="btn btn-primary" type="submit" onclick="applyCoupon()">Apply</a>
                                </div>
                            </form>
                            @endif
                        </div>
                        {{-- <h6 class="quicktech-payment-title mb-3">Direct bank transfer</h6>
                        <p class="quicktech-payment-instructions alert alert-light border">
                          Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                        </p>
                        <div class="quicktech-terms-check form-check mb-4">
                          <input class="quicktech-terms-input form-check-input" type="checkbox" id="quicktechTermsCheckbox">
                          <label class="quicktech-terms-label form-check-label" for="quicktechTermsCheckbox">
                            I have read and agree to the website <a href="#" class="quicktech-terms-link text-danger">terms and conditions</a>
                          </label>
                        </div> --}}
                        <button class="quicktech-place-order-btn btn btn-danger w-100 py-2" id="quicktechPlaceOrderButton"
                        type="submit">
                            Place order
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- checkout -->
@endsection
