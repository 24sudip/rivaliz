<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\{Auth, Validator};
use App\Models\{PackageOrder, PackagePayment};
use Illuminate\Support\Carbon;

class SubscriptionController extends Controller
{
    // public function checkPackage() {
    //     $package_order = PackageOrder::where('user_id', Auth::id())->first();
    //     if (!$package_order) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Please Subscribe A Free Package First'
    //         ], 422);
    //     } elseif($package_order->expired_at < now()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Your Subscribtion Has Already Expired'
    //         ], 422);
    //     }
    //     $total_prescription = PackagePrescription::where('user_id', Auth::id())->count();
    //     if ($total_prescription >= $package_order->total_prescription) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'You Have Already Reached Maximum Limit'
    //         ], 422);
    //     }
    //     if ($package_order->package_payment->status == 0) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Previous Payment Has Not Been Confirmed By Admin Yet'
    //         ], 422);
    //     }
    // }

    // public function pastMedicalHistoryStore(Request $request) {
    //     $check = $this->checkPackage();
    //     if ($check) {
    //         return $check;
    //     }
    // }

    public function allPackages() {
        return response()->json([
            'packages' => Package::all()
        ]);
    }

    // $total_prescription = PackagePrescription::where('user_id', Auth::id())->count();
    // if ($package->type == 'Free') {
    // } else {
    //     $expired_at = Carbon::now()->addDays($package->day_duration);
    //     PackageOrder::create([

    //     ]);
    //     return response()->json([
    //         'status' => 'error',
    //         'message' => 'Please Subscribe Free Package First'
    //     ], 422);
    // }
    // elseif($package_order->package->type != 'Free' && $package->type == 'Free') {
    //     return response()->json([
    //         'status' => 'error',
    //         'message' => 'Only Beginner Can Use Free Package'
    //     ], 422);
    // } elseif($package_order->package->type == 'Free' && $package->type == 'Free') {
    //     return response()->json([
    //         'status' => 'error',
    //         'message' => 'You Have Already Subscribed Free Package'
    //     ], 422);
    // }
    // elseif ($total_prescription < $package_order->total_prescription && $package_order->expired_at > now()) {
    //     $remain = $package_order->total_prescription - $total_prescription;
    //     return response()->json([
    //         'status' => 'error',
    //         'message' => "You Can Still Create $remain prescriptions"
    //     ], 422);
    // }
    // $total_prescription = $package_order->total_prescription;
    // 'total_prescription'=>$total_prescription + $package->maximum_prescription,
    
    public function subscribePackage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:packages,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'=>'failed',
                'error' => $validator->messages()->first()
            ], 422);
        }
        $package_id = $request->package_id;
        $package = Package::findOrFail($package_id);
        $package_order = PackageOrder::where('student_id', auth('api')->id())->first();
        if (!$package_order) {
            $expired_at = Carbon::now()->addMonths($package->duration_month);
            $package_payment = PackagePayment::create([
                'student_id'=>auth('api')->id(),
                'total_amount'=>$package->price,
                'package_id'=>$package->id,
                'invoice_no'=>'Rivaliz'. mt_rand('10000000','99999999'),
                'order_date'=>now()->format('d F Y'),
                'order_month'=>now()->format('F'),
                'order_year'=>now()->format('Y'),
                'status' => 0
            ]);
            $package_order = PackageOrder::create([
                'package_payment_id'=>$package_payment->id,
                'student_id'=>auth('api')->id(),
                'package_id'=>$package->id,
                'expired_at'=>$expired_at,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'You Have Subscribed Successfully',
                'package_payment'=>$package_payment,
                'package_order'=>$package_order
            ], 200);
        }
        elseif($package_order->package_payment->status == 1) {
            $package_payment = PackagePayment::create([
                'student_id'=>auth('api')->id(),
                'total_amount'=>$package->price,
                'package_id'=>$package->id,
                'invoice_no'=>'Rivaliz'. mt_rand('10000000','99999999'),
                'order_date'=>now()->format('d F Y'),
                'order_month'=>now()->format('F'),
                'order_year'=>now()->format('Y'),
                'status' => 0
            ]);
            $expired_at = Carbon::now()->addMonths($package->duration_month);
            $package_order->update([
                'package_payment_id'=>$package_payment->id,
                'student_id'=>auth('api')->id(),
                'package_id'=>$package->id,
                'expired_at'=>$expired_at,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'You Have Subscribed Successfully',
                'package_payment'=>$package_payment,
                'package_order'=>$package_order
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Previous Payment Is Not Confirmed By Admin Yet'
            ], 422);
        }
    }
}
