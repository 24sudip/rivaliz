<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Models\{Student, PackageOrder, PackagePayment, Package};
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('hello', [AuthController::class, 'hello']);
// Route::get('/hello', function () {
//     return response()->json([
//         'message' => 'Hello, welcome to the Payment API!'
//     ]);
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('verify', [AuthController::class, 'verify']);
Route::post('login', [AuthController::class, 'login']);
Route::post('/resend/login/otp', [AuthController::class, 'resendLoginOtp']);
Route::post('googlelogin', [AuthController::class, 'googlelogin']);

Route::middleware('auth:api')->group(function() {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);

    Route::get('coursedetails/{id}', [QuizController::class, 'coursedetails']);
    Route::post('practice/calculate-score/{quizId}', [QuizController::class, 'calculateScore']);
    Route::post('course/enroll', [QuizController::class, 'orderSaveApi']);
    Route::get('practice-score', [QuizController::class, 'examscore']);
    Route::post('/subscribe/package', [SubscriptionController::class, 'subscribePackage']);
});

Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset/password', [AuthController::class, 'resetpassword']);
Route::post('/resend/password/otp', [AuthController::class, 'resendPasswordOtp']);

//EXAM
Route::get('quiz', [QuizController::class, 'quiz']);

// Route::post('practice/calculate-score/{quizId}', [QuizController::class, 'calculateScore']);
Route::get('top-students', [QuizController::class, 'getTopStudents']);

//Course Enroll
Route::get('practicecatgeory', [QuizController::class, 'quizcatgeory']);
Route::get('catgeorywisequiz/{id}', [QuizController::class, 'catgeorywiseqquiz']);
Route::get('subcatgeorywisepractice/{id}', [QuizController::class, 'subcatgeorywiseqquiz']);
// Route::post('course/enroll', [QuizController::class, 'orderSaveApi']);

// //Review store
Route::post('/courses/reviews/{courseId}', [QuizController::class, 'reviewStore']);

//Courses
Route::get('coursecatgeory', [QuizController::class, 'coursecatgeory']);
Route::get('trendingcourse', [QuizController::class, 'trendingcourse']);
//coursedetails

// Route::get('coursedetails/{id}', [QuizController::class, 'coursedetails']);

Route::get('subcatgeorywisecourse/{id}', [QuizController::class, 'subcatgeorywisecourse']);
Route::get('written/of/subcatgeory/{quizsubcategory_id}', [QuizController::class, 'writtenOfSubcatgeory']);
//sms

//Banner
Route::get('sliders', [QuizController::class, 'sliders']);
Route::get('sliderwisecourse/{id}', [QuizController::class, 'sliderwisecourse']);
Route::get('pages', [QuizController::class, 'pages']);

Route::get('/send-sms', function (Request $request) {
    // Manual validation to handle error response
    $validator = Validator::make($request->all(), [
        'phone' => 'required|string|min:10|max:15',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422); // 422 = Unprocessable Entity
    }

    // Generate OTP
    $otp = rand(111111, 999999);

    $phone = $request->phone;
    $message = "Your OTP code is $otp.\nThank you for using our service.";

    // $url  = "https://a2p.solutionsclan.com/api/sms/send";
    $url  = "https://gbarta.gennet.com.bd/api/v1/smsapi";

    // $data = [
    //      "message_id"    => "458829848",
    //     // "apiKey"         => "A000092b606144c-5cc3-4399-b167-2395f919e004",
    //       "apiKey"         => '$2y$12$M4I.85UfZGBydjaxHfWrdeRqi9Df5/Qg3uuRNM/yWrsvJdfPvZ2yO',
    //     "type"           => "Text",
    //     "contactNumbers" => $phone,
    //     "senderId"       => "BulkSms",
    //     "textBody"       => $message,
    // ];

     $data = [
        "api_key"  => '$2y$12$M4I.85UfZGBydjaxHfWrdeRqi9Df5/Qg3uuRNM/yWrsvJdfPvZ2yO',
        "type"     => "text",
        "senderid" => "8809612342003",
        "msg"      => $message,
        "numbers"  => $phone,
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        return response()->json([
            'message' => 'Failed to send OTP',
            'error' => $error,
        ], 500);
    }

    $apiResponse = json_decode($response, true);

    if (isset($apiResponse['status']) && $apiResponse['status'] != 'SUCCESS') {
        return response()->json([
            'message' => 'Failed to send OTP',
            'api_response' => $apiResponse,
        ], 500);
    }

    return response()->json([
        'message' => 'Otp has been sent successfully',
        'otp' => $otp,
    ], 200);
});

Route::get('/all/packages', [SubscriptionController::class, 'allPackages']);

Route::get('bkash/callback', function (Request $request) {
    $paymentID = $request->get('paymentID');
    $status = $request->get('status');

    if ($status === 'failure') {
        return view('bkash.fail', ['message' => 'Payment failed']);
    }
    if ($status === 'cancel') {
        return view('bkash.fail', ['message' => 'Payment cancelled']);
    }
    if (!$paymentID) {
        return view('bkash.fail', ['message' => 'Payment ID missing']);
    }

    $token = Cache::get('bkash_token_' . $paymentID);
    $partnerId = Cache::get('bkash_partner_' . $paymentID);
    $amount = Cache::get('bkash_amount_' . $paymentID);

    if (!$token || !$partnerId) {
        return view('bkash.fail', ['message' => 'Token or partner ID not found']);
    }
    //sandbox
    // $base_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta';

    //Live
  $base_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta';

    $headers = [
        'Content-Type:application/json',
        'Authorization:' . $token,
        'X-APP-Key:' . env('BKASH_CHECKOUT_URL_APP_KEY')
    ];
    $body = json_encode(['paymentID' => $paymentID]);

    $curl = curl_init($base_url . '/tokenized/checkout/execute');
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    $response = curl_exec($curl);

    // dd($response);
    curl_close($curl);

    $arr = json_decode($response, true);

    if (isset($arr['statusCode']) && $arr['statusCode'] !== '0000') {
        return view('bkash.fail', ['message' => $arr['statusMessage'] ?? 'Unknown error']);
    }

    // // Save the payment
    // PartnerTransection::create([
    //     'name'       => 'Add Credit',
    //     'partner_id' => $partnerId,
    //     'paymentID' => $paymentID,
    //     'trxID' => $arr['trxID'],
    //     'token'      => $token,
    //     'amount'     => $amount,
    //     'type'       => 'credit',
    //     'status'     => 'approved'
    // ]);

    // BalanceHistory::create([
    //     'name'       => 'Add Credit',
    //     'partner_id' => $partnerId,
    //     'amount'     => $amount,
    //     'added_by'   => $partnerId
    // ]);

    // Clear cache
    Cache::forget('bkash_token_' . $paymentID);
    Cache::forget('bkash_partner_' . $paymentID);
    Cache::forget('bkash_amount_' . $paymentID);

    // âœ… Return success page
    return view('bkash.success', [
        'amount'     => $amount,
        'trxID'      => $arr['trxID'] ?? null,
        'paymentID'  => $paymentID,
        'message'    => 'Payment executed & credited successfully'
    ]);
})->name('api-bkash-callbackssss');
Route::get('bkash/callback', function (Request $request) {

    $paymentID = $request->paymentID;
    $status = $request->status;

    if ($status === 'failure') {
        return view('bkash.fail', ['message' => 'Payment failed']);
    }
    if ($status === 'cancel') {
        return view('bkash.fail', ['message' => 'Payment cancelled']);
    }

    if (!$paymentID) {
        return view('bkash.fail', ['message' => 'Payment ID missing']);
    }

    $token = Cache::get('bkash_token_' . $paymentID);
    $student_id = Cache::get('bkash_student_' . $paymentID);
    $package_id = Cache::get('bkash_package_' . $paymentID);
    $amount = Cache::get('bkash_amount_' . $paymentID);

    if (!$token || !$student_id || !$package_id) {
        return view('bkash.fail', ['message' => 'Missing payment data']);
    }

    $headers = [
        'Content-Type:application/json',
        'Authorization:' . $token,
        'X-APP-Key:' . env('BKASH_CHECKOUT_URL_APP_KEY')
    ];

    $body = json_encode(['paymentID' => $paymentID]);

    // $curl = curl_init('https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/checkout/execute');
    $curl = curl_init('https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized/checkout/execute');

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
    $response = curl_exec($curl);
    curl_close($curl);

    $arr = json_decode($response, true);

    if (!isset($arr['statusCode']) || $arr['statusCode'] !== '0000') {
        return view('bkash.fail', ['message' => $arr['statusMessage'] ?? 'Unknown error']);
    }

    // ðŸ”¥ STEP 1: INSERT PackagePayment
    $payment = PackagePayment::create([
        'student_id' => $student_id,
        'package_id' => $package_id,
        'total_amount' => $amount,
        'invoice_no' => 'Ittadi' . mt_rand(10000000, 99999999),
        'order_date' => now()->format('d F Y'),
        'order_month' => now()->format('F'),
        'order_year' => now()->format('Y'),
        'trxID' => $arr['trxID'],
        'paymentID' => $paymentID,
        // 'trxID' => $arr['trxID'],
        'token'      => $token,
        'payment_method' => 'Bkash',
        'status' => 1
    ]);

    // ðŸ”¥ STEP 2: UPDATE PackageOrder or create new
    $package = Package::find($package_id);
    $expired_at = now()->addMonths($package->duration_month);

    PackageOrder::updateOrCreate(
        [
            'student_id' => $student_id
        ],
        [
            'package_payment_id' => $payment->id,
            'package_id' => $package_id,
            'expired_at' => $expired_at
        ]
    );

    // ✅ STEP 3: SEND PUSH NOTIFICATION + SAVE TO DB
$student = Student::find($student_id);

if ($student) {

    $title = 'Package Purchased Successfully 🎉';
    $body  = 'Your package has been activated successfully.';

    // 🔔 Save notification in DB
    Notification::create([
        'title'   => $title,
        'body'    => $body,
        'user_id' => $student->id,
    ]);

    // 🔔 Send Firebase push notification
    if ($student->device_token) {
        try {
            $firebase = new FirebaseService ();

            $firebase->sendNotification(
                $student->device_token,
                $title,
                $body

            );
        } catch (\Exception $e) {
            Log::error('Firebase push failed', [
                'student_id' => $student->id,
                'error'      => $e->getMessage()
            ]);
        }
    }
}

    // Cleanup cache
    Cache::forget('bkash_token_' . $paymentID);
    Cache::forget('bkash_student_' . $paymentID);
    Cache::forget('bkash_package_' . $paymentID);
    Cache::forget('bkash_amount_' . $paymentID);

    return view('bkash.success', [
        'amount' => $amount,
        'trxID' => $arr['trxID'],
        'paymentID' => $paymentID,
        'message' => 'Payment Successful'
    ]);
})->name('api-bkash-callback');

Route::post('/bkash/create', [SubscriptionController::class, 'apicreatePayment']);
// Route::get('bkash/callback', [PartnerController::class, 'apiCallback'])->name('api-bkash-callback');
Route::post('bkash/execute', [SubscriptionController::class, 'apiExecutePayment']);

