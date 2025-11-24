<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller {
    public function showCartTable() {
        $courses  = session()->get('cart');
        $discount = session()->get('discount');

        return view('frontend.cart', compact('courses', 'discount'));
    }

    public function addToCart($id) {
        $course = Course::find($id);

        if (!$course) {
            abort(404);
        }

        $cart = session()->get('cart');

        if (!$cart) {

            $cart = [
                $id => [
                    "name"     => $course->name,
                    "quantity" => 1,
                    "price"    => $course->price,
                    "photo"    => $course->thumbnil_image,
                ],
            ];

            session()->put('cart', $cart);

            return redirect()->to('/cart')->with('success', 'Course added to cart successfully!');
        }

        if (isset($cart[$id])) {

// $cart[$id]['quantity']++;

            // session()->put('cart', $cart);

            return redirect()->to('/cart')->with('success', 'Already exist in cart!');
        }

        $cart[$id] = [
            "name"     => $course->name,
            "quantity" => 1,
            "price"    => $course->price,
            "photo"    => $course->thumbnil_image,
        ];

        session()->put('cart', $cart);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Course added to cart successfully!']);
        }

        return redirect()->to('/cart')->with('success', 'Course added to cart successfully!');
    }

    public function removeCartItem(Request $request) {

        if ($request->id) {

            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Course removed successfully');
        }

        return redirect()->back();

    }

    public function clearCart() {
        session()->forget('cart');

        return redirect()->back();
    }

    public function showCourses() {
        $courses = Course::all();

        return view('welcome', compact('courses'));
    }

    public function couponApply(Request $request) {
        session()->forget('discount');
        session()->forget('coupon_code');

        $coupon = Coupon::where(['coupon_code' => $request->coupon_code])->first();

        if (!$coupon) {
            return redirect()->back()->with('error', 'Coupon code is not available!');
        } elseif ($coupon->coupon_date < Carbon::now()->toDateString()) {
            return redirect()->back()->with('error', 'Coupon expired!');
        }

        if ($coupon->coupon_type == 1) {
            $totalPrice = 0;

            $courses = session()->get('cart');

            foreach ($courses as $course) {
                $totalPrice += $course['price'];
            }

            $discount = $totalPrice * ($coupon->coupon_discount / 100);
        } else {
            $discount = $coupon->coupon_discount;
        }

        session()->put('discount', $discount);
        session()->put('coupon_code', $coupon->coupon_code);

        return redirect()->back()->with('success', 'Coupon applied successfully');
    }

}
