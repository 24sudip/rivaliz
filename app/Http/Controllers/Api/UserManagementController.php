<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\Course;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\ShareLink;
use App\Models\User;
use App\Models\Video;
use App\Models\Wishlist;
use App\Models\Progress;
use App\Models\RatingReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller {
    public function register(Request $request) {
        DB::beginTransaction();

        try {

            $validator = Validator::make($request->all(), [
                'name'             => 'required',
                'certificate_name' => 'required',
                'district'         => 'required',
                'institute'        => 'required',
                'mobile'           => 'required',
                'email'            => 'required|unique:users',
                'password'         => 'required',
            ]);

            $user = User::create([
                'name'             => $request->name,
                'email'            => $request->email,
                'password'         => bcrypt($request->password),
                'certificate_name' => $request->certificate_name,
                'district'         => $request->district,
                'institute'        => $request->institute,
                'mobile'           => $request->mobile,

            ]);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Your account created successfully!!',
                'user'    => $user,
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

            if (!Auth::guard('web')->attempt([
                'email'    => $request->email,
                'password' => $request->password,
            ])) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Invalid email or unauthorized account!!',
                ]);
            }

            $user        = Auth::guard('web')->user();
            $tokenResult = $user->createToken('userAuthToken')->plainTextToken;

            return response()->json([
                'status'       => true,
                'token_type'   => 'Bearer',
                'access_token' => $tokenResult,
                'user' => $user,
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status'  => false,
                'message' => 'Error in Login',
            ]);
        }

    }

    public function orderSave(Request $request) {
        DB::beginTransaction();

        try {
            $order                  = new Order();
            $order->user_id         = auth()->user()->id;
            $order->total           = $request->total;
            $order->discount        = $request->discount;
            $order->coupon_discount = $request->coupon_discount;
            $order->subtotal        = $request->subtotal;
            $order->payment_method  = $request->payment_method;
            $order->save();

            foreach ($request->cart as $key => $item) {
                $link_owner = ShareLink::where('shareable_link', $item["af_shareable_link"])
                    ->where('validity', '>=', today())
                    ->where('course_id', $item["course_id"])
                    ->first();

                $affiliate_id         = null;
                $affiliate_percentage = null;

                if ($link_owner) {
                    $affiliate_id         = $link_owner->affiliate_id;
                    $affiliate_percentage = $link_owner->affiliate->percentage;
                }

                $details                       = new OrderDetails();
                $details->order_id             = $order->id;
                $details->affiliate_id         = $affiliate_id;
                $details->affiliate_percentage = $affiliate_percentage;
                $details->course_id            = $item["course_id"];
                $details->price                = $item["price"];
                $details->save();

                $course           = Course::find($details->course_id);
                $course->enrolled = $course->enrolled + 1;
                $course->save();
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Order saved successfully!!',
            ]);
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ]);
        }

    }

    public function wishlist(Request $request) {
        return Wishlist::where('user_id', Auth::id())->with('user', 'course')->get();
    }

    public function storeWishlist(Request $request) {
        Wishlist::create([
            'user_id'   => auth()->user()->id,
            'course_id' => $request->course_id,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Course added to wishlist!!',
        ]);
    }
    
    public function removeWishlist(Request $request)
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)
            ->where('course_id', $request->course_id)
            ->first();
    
        if ($wishlist) {
            $wishlist->delete();
        }
    
        return response()->json([
            'status' => true,
            'message' => 'Course removed from wishlist!!',
        ]);
    }

    public function paymentHistory() {
        return Order::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->with('details', 'details.course', 'details.affiliate')
            ->paginate();
    }

    public function updateProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'             => 'required',
            'email'            => 'required|unique:users,email,' . Auth::id(),
            'certificate_name' => 'required',
            'district'         => 'required',
            'institute'        => 'required',
            'mobile'           => 'required',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $profile = User::find(Auth::id());

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/user/';
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
            'name'             => $request->name,
            'certificate_name' => $request->certificate_name,
            'email'            => $request->email,
            'district'         => $request->district,
            'institute'        => $request->institute,
            'mobile'           => $request->mobile,
        ]);

        return $profile;

    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'new_password' => 'required',
        ]);

        $user = User::where('id', Auth::id())->first();

        if ($user) {
            $user->update([
                'password' => bcrypt($request->new_password),
                'status'   => 0,
            ]);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Password reset successfully',
            'data'    => $user,
        ]);
    }
    
    public function getOrderedCourses($id)
    {
        $courses = [];
    
        $orders = Order::where('user_id', $id)->get();
    
        foreach ($orders as $order) {
            $orderDetails = OrderDetails::where('order_id', $order->id)->get();
    
            foreach ($orderDetails as $orderDetail) {
                $coursesCollection = Course::where('id', $orderDetail->course_id)->with('instructor', 'videos')->get();
    
                foreach ($coursesCollection as $course) {
                    $reviews = RatingReview::where('course_id', $course->id)->where('status', 1)->get();
                    $numReviews = count($reviews);
                    $sumScores = $reviews->sum('rating');
                    $avgScore = $numReviews > 0 ? $sumScores / $numReviews : 0;
                    $avgScore = round($avgScore, 1);
    
                    $courseData = new \stdClass();
                    $courseData->course = $course;
                    $courseData->numReviews = $numReviews;
                    $courseData->avgScore = $avgScore;
    
                    $courses[] = $courseData;
                }
            }
        }
    
        return response()->json([
            'status'  => true,
            'data'    => $courses,
        ]);
    }

    
    public function storeProgress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'course_id' => 'required',
            'video_id' => 'required|unique:progress,user_id,NULL,id,course_id,'.$request->course_id.',video_id,'.$request->video_id
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }
        else{
    
        DB::beginTransaction();
    
        try {
            $data = Progress::create([
                'user_id'   => $request->user_id,
                'course_id' => $request->course_id,
                'video_id' => $request->video_id,
            ]);
    
            DB::commit();
    
            return response()->json([
                'status'  => true,
                'message' => 'Video watch complete',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
    
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ]);
        }
        }
    }
    
    public function courseProgress(Request $request) {
        DB::beginTransaction();

        try {
            
            $videos = Video::where('course_id', $request->course_id)->count();
            
            $completedVideos = Progress::where('user_id', $request->user_id)->where('course_id', $request->course_id)->count();

            $progress = ($completedVideos / $videos) * 100;

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Your Course Progress in %',
                'progress'=> $progress,
                
            ]);
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ]);
        }

    }

}
