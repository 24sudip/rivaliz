<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\AffiliateClickCount;
use App\Models\OrderDetails;
use App\Models\ShareLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AffiliateManagementController extends Controller {
    public function register(Request $request) {
        DB::beginTransaction();

        try {

            $validator = Validator::make($request->all(), [
                'name'        => 'required',
                'email'       => 'required|unique:affiliates',
                'password'    => 'required',
                'phone '      => 'required|unique:affiliates',
                'gender'      => 'required',
                'dob'         => 'required',
                'profession'  => 'required',
                'institution' => 'required',
                'department'  => 'required',
                'address'     => 'required',
            ]);

            $affiliate = Affiliate::create([
                'name'           => $request->name,
                'email'          => $request->email,
                'password'       => bcrypt($request->password),
                'phone'          => $request->phone,
                'mobile_banking' => $request->mobile_banking,
                'gender'         => $request->gender,
                'dob'            => $request->dob,
                'profession'     => $request->profession,
                'institution'    => $request->institution,
                'department'     => $request->department,
                'address'        => $request->address,
                'status'         => 1,
            ]);

            DB::commit();

            return response()->json([
                'status'    => true,
                'message'   => 'Your account created successfully!!',
                'affiliate' => $affiliate,
            ]);
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th,
            ]);
        }

    }

    public function login(Request $request) {
        try {
            $request->validate([
                'email'    => 'required',
                'password' => 'required',
            ]);

            if (!Auth::guard('affiliate')->attempt([
                'email'    => $request->email,
                'password' => $request->password,
                'status'   => 1,
            ])) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Invalid email or unauthorized account!!',
                ]);
            }

            $user = Auth::guard('affiliate')->user();
            $user->tokens()->delete(); //deleting all previous token

            $tokenResult = $user->createToken('affAuthToken')->plainTextToken;

            return response()->json([
                'status'       => true,
                'token_type'   => 'Bearer',
                'access_token' => $tokenResult,
                'user' => $user,
                'auth_type'    => 'email',
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status'  => false,
                'message' => 'Error in Login',
            ]);
        }

    }

    public function profileUpdate(Request $request) {
        DB::beginTransaction();

        try {

            $validator = Validator::make($request->all(), [
                'name'        => 'required',
                'email'       => 'required|unique:affiliates,email,' . Auth::id(),
                'phone '      => 'required|unique:affiliates,phone,' . Auth::id(),
                'gender'      => 'required',
                'dob'         => 'required',
                'profession'  => 'required',
                'institution' => 'required',
                'department'  => 'required',
                'address'     => 'required',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);

            $profile = Affiliate::find(Auth::id());

            if ($request->hasFile('image')) {

                $image_file = $request->file('image');

                if ($image_file) {

                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/affiliate/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());

                    $img_name    = $img_gen . '.' . $image_ext;
                    $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                    $image_file->move($image_url, $img_name);
                    $profile->update(
                        [
                            'image' => $final_name1,
                        ]
                    );
                }

            }

            $profile->update([
                'name'           => $request->name,
                'email'          => $request->email,
                'phone'          => $request->phone,
                'mobile_banking' => $request->mobile_banking,
                'gender'         => $request->gender,
                'dob'            => $request->dob,
                'profession'     => $request->profession,
                'institution'    => $request->institution,
                'department'     => $request->department,
                'address'        => $request->address,
            ]);

            DB::commit();

            return response()->json([
                'status'    => true,
                'message'   => 'Your account updated successfully!!',
                'affiliate' => $profile,
            ]);
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th,
            ]);
        }

    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'new_password' => 'required',
        ]);

        $affiliate = Affiliate::where('id', Auth::id())->first();

        if ($affiliate) {
            $affiliate->update([
                'password' => bcrypt($request->new_password),
                'status'   => 0,
            ]);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Password reset successfully',
            'data'    => $affiliate,
        ]);
    }

    public function makeShareLink(Request $request) {
        $affiliate = Affiliate::find(Auth::id());

        if (!$affiliate->percentage && !$affiliate->validity) {
            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong.',
            ]);
        }

        $check = ShareLink::where('affiliate_id', Auth::id())->where('course_id', $request->course_id)->where('validity', '>=', today())->first();

        if ($check) {
            return response()->json([
                'status'  => false,
                'message' => 'You have a valid link for this course.',
            ]);
        }

        ShareLink::create([
            'affiliate_id'   => $affiliate->id,
            'course_id'      => $request->course_id,
            'shareable_link' => substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 10),
            'validity'       => date('Y-m-d', strtotime(date("Y-m-d") . ' + 5 day')),
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Shareable link created successfully',
        ]);
    }

    public function dashboard() {
        $data               = [];
        $data['total_sale'] = (int)OrderDetails::where('affiliate_id', Auth::id())->sum('price');

        $courses      = OrderDetails::where('affiliate_id', Auth::id())->get();
        $sale_earning = 0;

        foreach ($courses as $item) {
            $sale_earning += (($item->price * $item->affiliate_percentage) / 100);
        }

        $data['sale_earning'] = $sale_earning;
        $data['total_click']  = AffiliateClickCount::select('click')->where('affiliate_id', Auth::id())->first()->click;

        return $data;
    }
}
