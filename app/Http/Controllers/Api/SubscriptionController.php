<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\{Auth, Cache, Validator};
use App\Models\{PackageOrder, PackagePayment};
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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

    //BKASH API

    private $base_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta';
    //   private $base_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta';
    // private $base_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta';

    private function curlWithBody($url, $header, $method, $body_data_json)
    {
        $curl = curl_init($this->base_url . $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body_data_json);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    private function grant()
    {
        $header = [
            'Content-Type:application/json',
            'username:' . env('BKASH_CHECKOUT_URL_USER_NAME'),
            'password:' . env('BKASH_CHECKOUT_URL_PASSWORD')
        ];

        $body_data = [
            'app_key' => env('BKASH_CHECKOUT_URL_APP_KEY'),
            'app_secret' => env('BKASH_CHECKOUT_URL_APP_SECRET')
        ];
        $body_data_json = json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/token/grant', $header, 'POST', $body_data_json);

        //   dd($response);
        $tokenData = json_decode($response);

        return !empty($tokenData->id_token) ? $tokenData->id_token : null;
    }

    /**
     * Step 1: Create Payment
     */
    public function apicreatePayment(Request $request)
    {
        // return response()->json(['success' => 'hello'], 200);

        $token = $this->grant();
        if (!$token) {
            return response()->json(['error' => 'Failed to get token'], 500);
        }

        // $package_id = $request->package_id;
        // $package = Package::findOrFail($package_id);
        // dd($package);
        // $package_order = PackageOrder::where('student_id', auth('api')->id())->first();
        // $partner = auth()->guard('partner')->user();
        // if (!$partner) {
        //     return response()->json(['error' => 'Partner not authenticated'], 401);
        // }
        // dd($request->package_id);
        // dd(auth('api')->id());
        // dd($request->amount);

        $header = [
            'Content-Type:application/json',
            'Authorization:' . $token,
            'X-APP-Key:' . env('BKASH_CHECKOUT_URL_APP_KEY')
        ];

        $body_data = [
            'mode' => '0011',
            'payerReference' => '1',
            'callbackURL' => route('api-bkash-callback'),
            'amount' => $request->amount ?? 10,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => "Inv" . Str::random(8)
        ];
        $body_data_json = json_encode($body_data);

        $response = $this->curlWithBody('/tokenized/checkout/create', $header, 'POST', $body_data_json);
        // dd($response);
        $decoded = json_decode($response, true);

        if (!empty($decoded['paymentID'])) {
            // Cache::put('bkash_token_' . $decoded['paymentID'], $token, now()->addMinutes(55));
            // Cache::put('bkash_partner_' . $decoded['paymentID'], $partner->id, now()->addMinutes(55));
            // Cache::put('bkash_partner_' . $decoded['paymentID'], now()->addMinutes(55));
            // Cache::put('bkash_amount_' . $decoded['paymentID'], $request->amount ?? 10, now()->addMinutes(55));

            // Cache::put('bkash_student_' . $decoded['paymentID'], auth('api')->id(), 55);
            // Cache::put('bkash_package_' . $decoded['paymentID'], $request->package_id, 55);
            // Cache::put('bkash_amount_' . $decoded['paymentID'], $request->amount, 55);
            // Cache::put('bkash_token_' . $decoded['paymentID'], $token, 55);

            Cache::put('bkash_student_' . $decoded['paymentID'], auth('api')->id(), now()->addMinutes(60));
            Cache::put('bkash_package_' . $decoded['paymentID'], $request->package_id, now()->addMinutes(60));
            Cache::put('bkash_amount_' . $decoded['paymentID'], $request->amount, now()->addMinutes(60));
            Cache::put('bkash_token_' . $decoded['paymentID'], $token, now()->addMinutes(60));
        }
        // return response()->json($decoded);

        return response()->json([
            'payment_response' => $decoded,
            'stored_token' => $token // Add token here for debugging
        ]);
    }

    /**
     * Step 2: Callback from bKash (GET)
    */

    /**
     * Step 3: Execute Payment
    */
    public function LastapiExecutePayment(Request $request)
    {
        $paymentID = $request->paymentID;

        if (!$paymentID) {
            return response()->json(['error' => 'paymentID required'], 400);
        }

        $token = Cache::get('bkash_token_' . $paymentID);
        if (!$token) {
            return response()->json(['error' => 'Token not found for this paymentID'], 400);
        }

        $header = [
            'Content-Type:application/json',
            'Authorization:' . $token,
            'X-APP-Key:' . env('BKASH_CHECKOUT_URL_APP_KEY')
        ];

        $body_data_json = json_encode(['paymentID' => $paymentID]);
        $response = $this->curlWithBody('/tokenized/checkout/execute', $header, 'POST', $body_data_json);
        $arr = json_decode($response, true);

        if (isset($arr['statusCode']) && $arr['statusCode'] !== '0000') {
            return response()->json([
                'status' => 'error',
                'message' => $arr['statusMessage'] ?? 'Unknown error',
                'raw' => $arr
            ], 400);
        }

        // TODO: Store in DB
        // DB::table('payments')->insert([...]);

        return response()->json([
            'status' => 'success',
            'message' => 'Payment executed successfully',
            'data' => $arr
        ]);
    }

    public function apiExecutePayment(Request $request)
    {
        $paymentID = $request->paymentID;

        $token = Cache::get('bkash_token_' . $paymentID);

        if (!$token) {
            return response()->json(['error' => 'Token expired'], 400);
        }

        $header = [
            'Content-Type:application/json',
            'Authorization:' . $token,
            'X-APP-Key:' . env('BKASH_CHECKOUT_URL_APP_KEY')
        ];

        $body_data_json = json_encode(['paymentID' => $paymentID]);
        $response = $this->curlWithBody('/tokenized/checkout/execute', $header, 'POST', $body_data_json);
        $arr = json_decode($response, true);

        return response()->json($arr);
    }
}

