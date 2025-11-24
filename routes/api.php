<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Api\SubscriptionController;
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

