<!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
@extends('frontend.layout.theme')

@section('content')
<section class="pt-5">
    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="quicktech-order-card card p-4">
                    <h5 class="quicktech-order-title card-title mb-4">Your order</h5>
                    <table class="quicktech-order-table table">
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr>
                                <td>{{ $cart->name }}
                                    {{-- <span class="text-muted">× 1</span> --}}
                                </td>
                                <td class="text-end">৳ {{ $cart->price }}</td>
                            </tr>
                            {{-- <tr>
                                <td>Thumbnail</td>
                                <td class="text-end">
                                    <img src="{{ asset($cart->options['image']) }}" alt="image" width="80">
                                </td>
                            </tr>
                            <tr>
                                <td>Instructor</td>
                                <td class="text-end">{{ $cart->options['instructor_id'] }}</td>
                            </tr> --}}
                            @endforeach
                            @if (Session::has('coupon'))
                            <tr>
                                <td>Coupon Code</td>
                                <td class="text-end">{{ session()->get('coupon')['coupon_code'] }}</td>
                            </tr>
                            <tr>
                                <td>Coupon Discount</td>
                                <td class="text-end">
                                {{ session()->get('coupon')['coupon_discount'] }}{{ session()->get('coupon')['discount_symbol'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>Discount Amount</td>
                                <td class="text-end">{{ session()->get('coupon')['discount_amount'] }}</td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td class="text-end">{{ session()->get('coupon')['total_amount'] }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="quicktech-order-card card p-4">
                    <h5 class="quicktech-order-title card-title mb-4">Student Description</h5>
                    <table class="quicktech-order-table table">
                        <tr>
                            <td>Name</td>
                            <td class="text-end">{{ Auth::guard('student')->user()->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td class="text-end">{{ Auth::guard('student')->user()->email }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td class="text-end">{{ Auth::guard('student')->user()->phone }}</td>
                        </tr>
                        <!--<tr>-->
                        <!--    <td>Address</td>-->
                        <!--    <td class="text-end">{{ Auth::guard('student')->user()->address }}</td>-->
                        <!--</tr>-->
                        <tr>
                            <td>Country</td>
                            <td class="text-end">{{ $billing_info->country }}</td>
                        </tr>
                        <!--<tr>-->
                        <!--    <td>Division</td>-->
                        <!--    <td class="text-end">{{ $billing_info->division }}</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--    <td>District</td>-->
                        <!--    <td class="text-end">{{ $billing_info->district }}</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--    <td>Upzilla</td>-->
                        <!--    <td class="text-end">{{ $billing_info->upzilla }}</td>-->
                        <!--</tr>-->
                        <tr>
                            <td>Note</td>
                            <td class="text-end">{{ $billing_info->notes }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="quicktech-order-card card p-4">
                    <h5 class="quicktech-order-title card-title mb-4">Payment Method</h5>

                    @php
                    $student = Auth::guard('student')->user();
                    $enrolledCourses = json_decode($student->enrolledcourse, true) ?? [];
                    $hasCourse = in_array($billing_info->course_id ?? null, $enrolledCourses);
                @endphp

                    <form method="GET" action="{{route('payment')}}" enctype="multipart/form-data" class="quicktech-order-table table">
                        @csrf

                        <input type="hidden" name="student_id"   value="{{ Auth::guard('student')->user()->id }}">
                        <input type="hidden"  name="course_id" value="{{ $billing_info->course_id ?? null}}">
                        <input type="hidden"  name="ebook_id" value="{{  $billing_info->ebook_id ?? null }}">
                        <input type="hidden" name="total_amount"  value="{{ session()->get('coupon')['total_amount']  ?? $billing_info->price }}">
                        <input type="hidden"  name="discount_amount" value="{{ session()->get('coupon')['discount_amount'] ?? null}}">
                        <input type="hidden"  name="coupon_code" value="{{ session()->get('coupon')['coupon_code'] ?? null}}">
                        <input type="hidden"  name="course_price" value="{{ $billing_info->price }}">
                        <input type="hidden"  name="note" value="{{  $billing_info->notes }}">
                        <input type="hidden"  name="payment_method" value="Bkash">
                        {{-- <div class="card">
                            <div class="card-body">
                                <div class="form-check ms-5">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label ms-2" for="flexRadioDefault1">
                                        bKash
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="form-check ms-5">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label ms-2" for="flexRadioDefault2">
                                        SSL Commerz
                                    </label>
                                </div>
                            </div>
                        </div>
                        @if ($hasCourse)
                    <div class="card mt-2">
                <div class="card-body">
                   <div class="form-check ms-5">
                    <input class="form-check-input" type="radio" name="payment_method" value="CashOnDelivery" id="flexRadioCOD"
                        checked>
                    <label class="form-check-label ms-2" for="flexRadioCOD">Cash on Delivery</label>
                   </div>
                 </div>
               </div>
                          @endif --}}

                          @php
    $student = Auth::guard('student')->user();
    $enrolledCourses = json_decode($student->enrolledcourse, true) ?? [];
    $courseId = $billing_info->course_id ?? null;
    $hasCourse = in_array($courseId, $enrolledCourses);
@endphp

<form method="POST" action="{{ route('ordersave') }}" enctype="multipart/form-data" class="quicktech-order-table table">
    @csrf

    <input type="hidden" name="student_id" value="{{ $student->id }}">
    <input type="hidden" name="course_id" value="{{ $courseId }}">
    <input type="hidden" name="ebook_id" value="{{ $billing_info->ebook_id ?? null }}">
    <input type="hidden" name="total_amount" value="{{ session()->get('coupon')['total_amount'] ?? $billing_info->price }}">
    <input type="hidden" name="discount_amount" value="{{ session()->get('coupon')['discount_amount'] ?? null }}">
    <input type="hidden" name="coupon_code" value="{{ session()->get('coupon')['coupon_code'] ?? null }}">
    <input type="hidden" name="course_price" value="{{ $billing_info->price }}">
  <input type="hidden"  name="note" value="{{  $billing_info->notes }}">
    @if ($hasCourse)
        {{-- Show Only Cash on Delivery --}}
        <div class="card mt-2">
            <div class="card-body">
                <div class="form-check ms-5">
                    <input class="form-check-input" type="radio" name="payment_method" value="surjoPay" id="flexRadioCOD" checked>
                    <label class="form-check-label ms-2" for="flexRadioCOD">surjoPay</label>
                </div>
            </div>
        </div>
    @else
        {{-- Show bKash and SSLCommerz only if course is not already enrolled --}}
          <div class="card mt-2">
            <div class="card-body">
                <div class="form-check ms-5">
                    <input class="form-check-input" type="radio" name="payment_method" value="surjoPay" id="flexRadioSSL">
                    <label class="form-check-label ms-2" for="flexRadioSSL">surjoPay</label>
                </div>
            </div>
        </div>

        <!--<div class="card mt-2">-->
        <!--    <div class="card-body">-->
        <!--        <div class="form-check ms-5">-->
        <!--            <input class="form-check-input" type="radio" name="payment_method" value="SSLCommerz" id="flexRadioSSL">-->
        <!--            <label class="form-check-label ms-2" for="flexRadioSSL">SSL Commerz</label>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
    @endif
                        <button class="btn btn-success mt-2">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
