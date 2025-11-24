<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();

        return view('backend.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('backend.coupon.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required|unique:coupons',
            'coupon_date' => 'required|after_or_equal:today',
            'coupon_type' => 'required',
            'coupon_discount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        Coupon::create($request->all());

        return redirect()->route('admin.coupons.index')->withToastSuccess('Coupon added successfully!!');

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->back()->withToastSuccess('Coupon deleted successfully!!');
    }
}
