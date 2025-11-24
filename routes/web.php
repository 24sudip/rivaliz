<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Backend\AdController;
use App\Http\Controllers\Backend\AdminForgotPasswordController;
use App\Http\Controllers\Backend\AdminLoginController;
use App\Http\Controllers\Backend\AdminRegistrationController;
use App\Http\Controllers\Backend\AdminResetPasswordController;
use App\Http\Controllers\Backend\AffiliateManagementController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildcategoryController;
use App\Http\Controllers\Backend\ChildsubcategoryController;
use App\Http\Controllers\Backend\CompanyInfoController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CourseController as AdminCourseController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\NoticeController;
use App\Http\Controllers\Backend\InstructorController;
use App\Http\Controllers\Backend\LiveclassController as AdminLiveclassController;
use App\Http\Controllers\Backend\LiveCourseController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PromovideoController;
use App\Http\Controllers\Backend\StudentbenefitController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\ShoppingCartController;
use App\Http\Controllers\frontend\{StudentController, ContactController, SliderController, AboutController};
use App\Http\Controllers\{GeneralController, WrittenController, PackageController};
use App\Http\Controllers\Instructor\CourseController;
use App\Http\Controllers\Instructor\ExamController;
use App\Http\Controllers\Instructor\SupportController;
use App\Http\Controllers\Instructor\InstructorDashboardController;
use App\Http\Controllers\Instructor\InstructorForgotPasswordController;
use App\Http\Controllers\Instructor\InstructorLoginController;
use App\Http\Controllers\Instructor\InstructorRegisterController;
use App\Http\Controllers\Instructor\InstructorResetPasswordController;
use App\Http\Controllers\Instructor\LiveclassController;
use App\Http\Controllers\Instructor\LiveCourseController as InstructorLiveCourseController;
use App\Http\Controllers\Instructor\StudentController as InstructorStudentController;
use App\Http\Controllers\Admin\{PodcastController, EbookController};
use Illuminate\Support\Facades\{Auth, Route, Session};
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\{AboutItem, Subcategory, Slider, AboutTab, Coupon, UserDevice};
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

//  use App\Http\Controllers\AuthController;
//  Route::get('/hello', [PaymentController::class, 'hello']);

//  Route::get('/hello', function () {
//     return response()->json([
//         'message' => 'Hello, welcome to the Payment API!'
//     ]);
// });
//  Route::post('register', [AuthController::class, 'register']);
//  Route::post('login', [AuthController::class, 'login']);

//  Route::middleware('auth:api')->group(function() {
//      Route::post('logout', [AuthController::class, 'logout']);
//      Route::get('profile', [AuthController::class, 'profile']);
//  });


use App\Models\Student;
Route::get('/successpage',[PaymentController::class,'successpage'])->name('success.page');
Route::get('/cancelpage',[PaymentController::class,'cancelpage'])->name('cancel.page');
Route::get('/success',[PaymentController::class,'success'])->name('success');
Route::get('/cancel',[PaymentController::class,'cancel'])->name('cancel');
// Route::get('/autologin/{student}', function (Student $student) {
//     Auth::guard('student')->login($student); // Use custom guard

//     return redirect('/student/enrolled/courses');
// })->middleware('signed')->name('student.autologin');
//Auth


//Device restriction
Route::get('/autologin/{student}', function (Request $request, Student $student) {
    $currentIP = Request::ip();
    $currentAgent = Request::userAgent();

    // Count active devices for the student
    $activeDevices = UserDevice::where('user_id', $student->id)->count();

    // Check if current device is already registered
    $existingDevice = UserDevice::where('user_id', $student->id)
        ->where('device_ip', $currentIP)
        ->where('device_agent', $currentAgent)
        ->exists();
    //
    if ($activeDevices >= $student->max_device && !$existingDevice) {
        // return redirect()->route('student.login')->with('error', 'Device limit reached. You can only log in from one device.');
        return redirect()->to('https://learnengwithshahan.com/login')
    ->with('error', 'Device limit reached. You can only log in from one device.');
    }
    if($activeDevices === 1){
        $firstDevice = UserDevice::where('user_id', $student->id)->first();
        $firstType = preg_match('/(android|iphone|ipad|ipod|blackberry|windows phone|opera mini|mobile)/i', $firstDevice->device_agent)
        ? 'Mobile' : 'Desktop';
        $currentType = preg_match('/(android|iphone|ipad|ipod|blackberry|windows phone|opera mini|mobile)/i', $currentAgent)
        ? 'Mobile' : 'Desktop';
        if($firstType === $currentType){
            Auth::guard('student')->logout();
            Request::session()->invalidate();
            Request::session()->regenerateToken();
            return redirect()->to('https://learnengwithshahan.com/login')->with('error', 'You can not use same type of device to login.');
        }
    }
    if($activeDevices === 2){
        $firstDevice = UserDevice::where('user_id', $student->id)->first();
        $secondDevice = UserDevice::where('user_id', $student->id)->latest()->first();
        $firstType = preg_match('/(android|iphone|ipad|ipod|blackberry|windows phone|opera mini|mobile)/i', $firstDevice->device_agent)
        ? 'Mobile' : 'Desktop';
        $secondType = preg_match('/(android|iphone|ipad|ipod|blackberry|windows phone|opera mini|mobile)/i', $secondDevice->device_agent)
        ? 'Mobile' : 'Desktop';
        $currentType = preg_match('/(android|iphone|ipad|ipod|blackberry|windows phone|opera mini|mobile)/i', $currentAgent)
        ? 'Mobile' : 'Desktop';
        if($firstType === $currentType || $secondType === $currentType){
            Auth::guard('student')->logout();
            Request::session()->invalidate();
            Request::session()->regenerateToken();
            return redirect()->back()->with('error', 'You can not use same type of device to login.');
        }
    }
    // Log the student in using custom guard
    Auth::guard('student')->login($student);

    // Register the device if not already registered
    if (!$existingDevice) {
        UserDevice::create([
            'user_id' => $student->id,
            'device_ip' => $currentIP,
            'device_agent' => $currentAgent
        ]);
    }

    return redirect('/student/enrolled/courses');
})->middleware('signed')->name('student.autologin');


// Search suggestions route
Route::get('/search-suggestions', [FrontendController::class, 'searchSuggestions']);
Route::get('/register', [FrontendController::class, 'register'])->name('রেজিস্ট্রেশন করুন');
Route::get('/login', [FrontendController::class, 'login'])->name('লগইন করুন');
Route::get('/verify', [FrontendController::class, 'verify'])->name('Verify');
Route::get('/search', [FrontendController::class, 'search'])->name('search');
Route::get('/forget-password', [FrontendController::class, 'forgetpassword'])->name('forgetpassword');
Route::get('/password-reset', [FrontendController::class, 'passwordReset'])->name('passwordReset');

//Student
Route::get('/signin', [FrontendController::class, 'signin'])->name('signin');
Route::get('/signup', [FrontendController::class, 'signup'])->name('signup');
Route::get('/profile', [FrontendController::class, 'profile'])->name('profile');
//test sms
Route::get('/test-sms', function (Request $request) {
    // Generate a random 4-digit OTP
    $otp = rand(1111, 9999);

    $verifyData = [
        "phone" => '01315595248', // Replace with your test phone number
        "message" => "Your OTP code is $otp.\nThank you for using our service.",
    ];

    $phone = $verifyData["phone"];
    $message = $verifyData["message"];

    $url  = "https://a2p.solutionsclan.com/api/sms/send";
    $data = [
        "apiKey"         => "A000092b606144c-5cc3-4399-b167-2395f919e004",
        "type"           => "Text",
        "contactNumbers" => $phone,
        "senderId"       => "BulkSms",
        "textBody"       => $message,
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($ch);
    curl_close($ch);

    // Return the API response and the OTP
    return response()->json([
        'api_response' => json_decode($response),
        'otp' => $otp,
    ]);
});

//Surjo pay
Route::get('/surjo',[PaymentController::class,'surjo'])->name('surjo');
Route::get('/payment',[PaymentController::class,'payment'])->name('payment');

// Route::get('/hello', function () {
//     return response()->json([
//         'message' => 'Hello, welcome to the Payment API!'
//     ]);
// });

Route::post('/reviews/{courseId}', [FrontendController::class, 'reviewstore'])->name('reviews.store');
Route::post('/ebookreviews/{id}', [FrontendController::class, 'ebookreviewstore'])->name('ebookreviews.store');
//Page
Route::get('/pages/{pageName}', [FrontendController::class, 'pagesdetails'])->name('pagesdetails');
//Pages
// Route::get('/', [FrontendController::class, 'index'])->name('হোম');
Route::get('/', function () {
    return "<h1>No Web</h1>";
})->name('home');
Route::get('/categories/{id}', [FrontendController::class, 'categories'])->name('ক্যাটেগরি');
Route::get('/subcategories/{id}', [FrontendController::class, 'subcategories'])->name('সাবক্যাটাগরি');
Route::get('/childcategories/{id}', [FrontendController::class, 'childcategories'])->name('চাইল্ডক্যাটাগরি');
Route::get('/categories/course/{id}', [FrontendController::class, 'course'])->name('কোর্স');
Route::get('/instructors', [FrontendController::class, 'instructors'])->name('সকল ইন্সট্রাক্টর');
Route::get('/instructors/instructor/{id}', [FrontendController::class, 'instructor'])->name('ইন্সট্রাক্টর');
Route::get('/events', [FrontendController::class, 'events'])->name('সকল ইভেন্ট');
Route::get('/events/event/{id}', [FrontendController::class, 'eventDetails'])->name('ইভেন্ট');
Route::get('/contact', [FrontendController::class, 'contact'])->name('যোগাযোগ');
Route::get('/about', [FrontendController::class, 'about'])->name('আমাদের সম্পর্কে');
Route::get('/blog', [FrontendController::class, 'blog'])->name('ব্লগ');
Route::get('/blog-details/{id}', [FrontendController::class, 'blogDetails'])->name('ব্লগ ভিউ');
Route::post('/certification/check', [FrontendController::class, 'checkCertificate'])->name('checkCertificate');

//
Route::get('/about/details/{slug}', [FrontendController::class, 'AboutDetails'])->name('about.details');
// Route::get('/aboutdetails', [FrontendController::class, 'aboutdetails'])->name('aboutdetails');
// Route::get('/allcourse', [FrontendController::class, 'allcourse'])->name('allcourse');

Route::get('/allcourse', [FrontendController::class, 'allcourse'])->name('allcourse');
Route::get('/allcourse/{id?}', [FrontendController::class, 'allcourse'])->name('allcourse.categorywise');
Route::get('/coursedetails/{id}', [FrontendController::class, 'coursedetails'])->name('coursedetails');
Route::get('/allebook', [FrontendController::class, 'allebook'])->name('allebook');
Route::get('/ebookdetails/{id}', [FrontendController::class, 'ebookdetails'])->name('ebookdetails');
Route::get('/ebookviews/{id}', [FrontendController::class, 'ebookviews'])->name('ebookviews');
Route::get('/allexam', [FrontendController::class, 'allexam'])->name('allexam');
Route::get('/examdetails/{id}', [FrontendController::class, 'examdetails'])->name('examdetails');
Route::get('/examstart/{id}', [FrontendController::class, 'examstart'])->middleware('auth:student')->name('examstart');
// Route::get('/examstart/{id}', [FrontendController::class, 'examstart'])->middleware('auth')->name('examstart');
// Submit answers (POST)
Route::post('/quizresult', [FrontendController::class, 'quizresult'])->name('quizresult.submit');

// Display quiz results (GET)
Route::get('/quizresult', [FrontendController::class, 'quizresultView'])->name('quizresult.view');

Route::get('/allevent', [FrontendController::class, 'allevent'])->name('allevent');
Route::get('/eventdetails/{id}', [FrontendController::class, 'eventdetails'])->name('eventdetails');
Route::get('/allinstructor', [FrontendController::class, 'allinstructor'])->name('allinstructor');

//podcast
Route::get('/podcast', [FrontendController::class, 'podcast'])->name('podcast');
Route::get('/podcast/detail/{id}', [FrontendController::class, 'podcastDetail'])->name('podcast.detail');

//podcastcategory
Route::get('/podcast', [FrontendController::class, 'podcast'])->name('podcast');

Route::get('/gallery', [FrontendController::class, 'gallery'])->name('gallery');
Route::get('/videos', [FrontendController::class, 'videos'])->name('videos');
Route::get('/videos/{id}', [FrontendController::class, 'videosbycategory'])->name('videos.category');
Route::get('/podcast/{id}', [FrontendController::class, 'podcastbycategory'])->name('podcast.category');
//

Route::get('/add-to-cart/{id}', [ShoppingCartController::class, 'addToCart']);
Route::post('/remove-from-cart', [ShoppingCartController::class, 'removeCartItem']);
Route::get('/clear-cart', [ShoppingCartController::class, 'clearCart']);
Route::post('/coupon/apply', [ShoppingCartController::class, 'couponApply']);

Route::post('/student/register', [StudentController::class, 'register']);
Route::post('/student/login', [StudentController::class, 'login']);
Route::post('/student/verify', [StudentController::class, 'verify']);
Route::post('/student/forget-password', [StudentController::class, 'forgetpassword']);
Route::post('/student/reset-password', [StudentController::class, 'resetpassword']);
//Course order
Route::get('/guest/checkout/{id}', [FrontendController::class, 'GuestCheckout'])->name('অতিথি-চেকআউট');
Route::post('/guest/coupon-apply', [FrontendController::class, 'CouponApply']);
//Ebook Order
Route::get('/ebook/checkout/{id}', [FrontendController::class, 'ebookCheckout'])->name('ebook.Checkout');

Route::get('/coupon-calculation', [FrontendController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [FrontendController::class, 'CouponRemove']);
Route::post('/billing/store', [FrontendController::class, 'BillingStore'])->name('billing.store');
Route::get('/order/page', [FrontendController::class, 'OrderPage'])->name('order.page');
Route::get('/test', function () {
    // Session::forget('coupon');
    // return "<h1>Session Cleared</h1>";
    // Auth::guard('student')->logout();
    // if (Auth::guard('student')->check()) {
    //     return "<h1>Logged Student</h1>";
    // } else {
    //     return "<h1>Guest Already Logout</h1>";
    // }
    // $coupon = Coupon::where('coupon_code','Sudip24')->where('coupon_date','>=', Carbon::now())->first();
    // $discount_amount = 0;
    // $total_amount = 0;
    // if ($coupon) {
    //     if ($coupon->coupon_type == 1) {
    //         $discount_amount = round(Cart::total() * $coupon->coupon_discount / 100);
    //         $total_amount = round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100);
    //     } elseif($coupon->coupon_type == 2) {
    //         $discount_amount = round($coupon->coupon_discount);
    //         $total_amount = round(Cart::total() - $coupon->coupon_discount);
    //     }
    //     Session::put('coupon', [
    //         'coupon_code' => $coupon->coupon_code,
    //         'coupon_discount' => $coupon->coupon_discount,
    //         'discount_amount' => $discount_amount,
    //         'total_amount' => $total_amount
    //     ]);
        // $se_cop = Session::get('coupon');
        // return $se_cop;
    // }
    // $coupon_type = 0;
    // if ($coupon->coupon_type == 1) {
    //     $coupon_type = 1;
    // } elseif($coupon->coupon_type == 2) {
    //     $coupon_type = 2;
    // }
    $carts = Cart::content();
    return "<h1>$carts</h1>";
    // $cartTotal = Cart::total();
    // $cartQty = Cart::count();
    // foreach ($carts as $value) {
    //     print_r($value->rowId);
    //     Cart::remove($value->rowId);
    // }
    // return response()->json(array(
    //     'carts' => $carts,
    //     'cartTotal' => $cartTotal,
    //     'cartQty' => $cartQty
    // ));
});

Route::middleware('auth:student')->group(function () {
    Route::get('/cart', [ShoppingCartController::class, 'showCartTable'])->name('কার্ট');
    Route::get('/checkout', [FrontendController::class, 'checkout'])->name('চেকআউট');
    Route::post('/order/save', [StudentController::class, 'ordersave'])->name('ordersave');
});

//student
Route::prefix('/student')->as('student.')->middleware('auth:student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/enrolled/courses', [StudentController::class, 'courses'])->name('courses');
    Route::get('/enrolled/ebooks', [StudentController::class, 'ebooks'])->name('ebooks');



    Route::get('/enrolled/live-classes', [StudentController::class, 'liveclasses'])->name('liveclasses');
    Route::get('/enrolled/course/{id}', [StudentController::class, 'coursedetails'])->name('coursedetails');
    Route::post('/enrolled/course/{id}/reviewsubmit', [StudentController::class, 'reviewsubmit'])->name('reviewsubmit');
    Route::post('/enrolled/course/review/reply-submit', [StudentController::class, 'replysubmit'])->name('replysubmit');
    Route::get('/enrolled/instructors', [StudentController::class, 'instructors'])->name('instructors');
    Route::get('/enrolled/quiz/{id}', [StudentController::class, 'quiz'])->name('quiz');
    Route::get('/enrolled/quiz/{id}/questions', [StudentController::class, 'quizquestion'])->name('quizquestion');
    Route::post('/enrolled/quiz/submit', [StudentController::class, 'quizsubmit'])->name('quizsubmit');
    Route::get('/enrolled/quiz/{id}/answers', [StudentController::class, 'quizanswer'])->name('quizanswer');
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [StudentController::class, 'editprofile'])->name('editprofile');
    Route::post('/profile/update', [StudentController::class, 'profileupdate'])->name('profileupdate');
    Route::get('/resume/edit', [StudentController::class, 'editresume'])->name('editresume');
    Route::post('/resume/update', [StudentController::class, 'resumeupdate'])->name('resumeupdate');
    Route::get('/resume', [StudentController::class, 'resume'])->name('resume');
    Route::get('/settings', [StudentController::class, 'settings'])->name('settings');
    Route::post('/changepassword', [StudentController::class, 'changepassword'])->name('changepassword');


    Route::post('/get-support', [StudentController::class, 'getSupport'])->name('getSupport');

    Route::get('/resume/education/create', [StudentController::class, 'educationcreate'])->name('educationcreate');
    Route::post('/resume/education/store', [StudentController::class, 'educationstore'])->name('educationstore');
    Route::get('/resume/education/{id}/edit', [StudentController::class, 'educationedit'])->name('educationedit');
    Route::post('/resume/education/update', [StudentController::class, 'educationupdate'])->name('educationupdate');
    Route::get('/resume/education/{id}/delete', [StudentController::class, 'educationdelete'])->name('educationdelete');

    Route::get('/resume/skill/create', [StudentController::class, 'skillcreate'])->name('skillcreate');
    Route::post('/resume/skill/store', [StudentController::class, 'skillstore'])->name('skillstore');
    Route::get('/resume/skill/{id}/edit', [StudentController::class, 'skilledit'])->name('skilledit');
    Route::post('/resume/skill/update', [StudentController::class, 'skillupdate'])->name('skillupdate');
    Route::get('/resume/skill/{id}/delete', [StudentController::class, 'skilldelete'])->name('skilldelete');

    Route::get('/resume/interest/create', [StudentController::class, 'interestcreate'])->name('interestcreate');
    Route::post('/resume/interest/store', [StudentController::class, 'intereststore'])->name('intereststore');
    Route::get('/resume/interest/{id}/edit', [StudentController::class, 'interestedit'])->name('interestedit');
    Route::post('/resume/interest/update', [StudentController::class, 'interestupdate'])->name('interestupdate');
    Route::get('/resume/interest/{id}/delete', [StudentController::class, 'interestdelete'])->name('interestdelete');

    Route::get('/resume/language/create', [StudentController::class, 'languagecreate'])->name('languagecreate');
    Route::post('/resume/language/store', [StudentController::class, 'languagestore'])->name('languagestore');
    Route::get('/resume/language/{id}/edit', [StudentController::class, 'languageedit'])->name('languageedit');
    Route::post('/resume/language/update', [StudentController::class, 'languageupdate'])->name('languageupdate');
    Route::get('/resume/language/{id}/delete', [StudentController::class, 'languagedelete'])->name('languagedelete');

    Route::get('/resume/achievement/create', [StudentController::class, 'achievementcreate'])->name('achievementcreate');
    Route::post('/resume/achievement/store', [StudentController::class, 'achievementstore'])->name('achievementstore');
    Route::get('/resume/achievement/{id}/edit', [StudentController::class, 'achievementedit'])->name('achievementedit');
    Route::post('/resume/achievement/update', [StudentController::class, 'achievementupdate'])->name('achievementupdate');
    Route::get('/resume/achievement/{id}/delete', [StudentController::class, 'achievementdelete'])->name('achievementdelete');

    Route::get('/resume/social/create', [StudentController::class, 'socialcreate'])->name('socialcreate');
    Route::post('/resume/social/store', [StudentController::class, 'socialstore'])->name('socialstore');
    Route::get('/resume/social/{id}/edit', [StudentController::class, 'socialedit'])->name('socialedit');
    Route::post('/resume/social/update', [StudentController::class, 'socialupdate'])->name('socialupdate');
    Route::get('/resume/social/{id}/delete', [StudentController::class, 'socialdelete'])->name('socialdelete');

    Route::get('/resume/reference/create', [StudentController::class, 'referencecreate'])->name('referencecreate');
    Route::post('/resume/reference/store', [StudentController::class, 'referencestore'])->name('referencestore');
    Route::get('/resume/reference/{id}/edit', [StudentController::class, 'referenceedit'])->name('referenceedit');
    Route::post('/resume/reference/update', [StudentController::class, 'referenceupdate'])->name('referenceupdate');
    Route::get('/resume/reference/{id}/delete', [StudentController::class, 'referencedelete'])->name('referencedelete');

    Route::get('/resume/download', [StudentController::class, 'resumedownload'])->name('resumedownload');
    Route::get('/resume/save-image', [StudentController::class, 'resumesave'])->name('resumesave');

    Route::get('/quiz/grades', [StudentController::class, 'grades'])->name('grades');

    Route::get('/quiz/exams', [StudentController::class, 'exams'])->name('exams');

    Route::get('/logout', [StudentController::class, 'logout'])->name('logout');
});

//instructor
Route::prefix('/instructor')->as('instructor.')->middleware('guest:instructor')->group(function () {
    Route::get('/register', [InstructorRegisterController::class, 'register'])->name('register');
    Route::post('/register', [InstructorRegisterController::class, 'storeRegister']);

    Route::get('/login', [InstructorLoginController::class, 'login'])->name('login');
    Route::post('/login', [InstructorLoginController::class, 'storeLogin']);

    Route::get('/forgot-password', [InstructorForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [InstructorForgotPasswordController::class, 'storeForgotPassword'])->name('storeForgotPassword');

    Route::get('/reset-password/{token}', [InstructorResetPasswordController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/reset-password', [InstructorResetPasswordController::class, 'storeForgotPassword'])->name('storeResetPassword');
});

Route::prefix('/instructor')->as('instructor.')->middleware('auth:instructor')->group(function () {
    Route::get('/profile', [InstructorRegisterController::class, 'profile'])->name('profile');
    Route::put('/profile/update/{id}', [InstructorRegisterController::class, 'profileUpdate'])->name('profileUpdate');
    Route::post('/logout', [InstructorLoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [InstructorDashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/payrequest', [InstructorDashboardController::class, 'payrequest'])->name('payrequest');

    Route::controller(CourseController::class)->prefix('/courses')->name('courses.')->group(function () {

        Route::get('/', 'courses')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{slug}', 'update')->name('update');
        Route::post('/active/{id}', 'active')->name('active');
        Route::post('/inactive/{id}', 'inactive')->name('inactive');
        Route::delete('/delete/{slug}', 'delete')->name('delete');



        Route::get('/{id}/modules', 'modules')->name('modules');
        Route::get('/{id}/module/add', 'addmodule')->name('addmodule');
        Route::get('/module/{id}/edit', 'moduleedit')->name('moduleedit');
        Route::post('/module/store', 'modulestore')->name('modulestore');
        Route::post('/module/update', 'moduleupdate')->name('moduleupdate');
        Route::post('/module/delete', 'moduledelete')->name('moduledelete');


        Route::get('/{id}/reviews', 'reviews')->name('reviews');
        Route::get('/{id}/review-discussion', 'reviewDiscussion')->name('reviewDiscussion');
        Route::post('/review-reply', 'reviewReply')->name('reviewReply');

        Route::get('/modules/{id}/lessons', 'lessons')->name('module.lessons');
        Route::get('/modules/{id}/lesson/add', 'lessonadd')->name('module.lessonadd');
        Route::get('/module/lesson/{id}/edit', 'lessonedit')->name('module.lessonedit');
        Route::post('/modules/lesson/store', 'lessonstore')->name('module.lessonstore');
        Route::post('/module/lesson/update', 'lessonupdate')->name('module.lessonupdate');
        Route::post('/module/lesson/delete', 'lessondelete')->name('module.lessondelete');

        Route::get('/modules/lesson/{id}/videos', 'videos')->name('module.lesson.videos');
        Route::get('/modules/lesson/{id}/video/add', 'videoadd')->name('module.lesson.videoadd');
        Route::get('/module/lesson/video/{id}/edit', 'videoedit')->name('module.lesson.videoedit');
        Route::post('/modules/lesson/video/store', 'videostore')->name('module.lesson.videostore');
        Route::post('/module/lesson/video/update', 'videoupdate')->name('module.lesson.videoupdate');
        Route::post('/module/lesson/video/delete', 'videodelete')->name('module.lesson.videodelete');

        Route::get('/modules/lesson/{id}/quizzes', 'quizzes')->name('module.lesson.quizzes');
        Route::get('/modules/lesson/{id}/quiz/add', 'quizadd')->name('module.lesson.quizadd');
        Route::get('/module/lesson/quiz/{id}/edit', 'quizedit')->name('module.lesson.quizedit');
        Route::post('/modules/lesson/quiz/store', 'quizzestore')->name('module.lesson.quizzestore');
        Route::post('/module/lesson/quiz/update', 'quizupdate')->name('module.lesson.quizupdate');
        Route::post('/module/lesson/quiz/delete', 'quizdelete')->name('module.lesson.quizdelete');

        Route::get('/modules/lesson/quiz/{id}/questions', 'questions')->name('module.lesson.quiz.questions');
        Route::get('/modules/lesson/quiz/{id}/question/add', 'questionadd')->name('module.lesson.quiz.questionadd');
        Route::get('/module/lesson/quiz/question/{id}/edit', 'questionedit')->name('module.lesson.quiz.questionedit');
        Route::post('/modules/lesson/quiz/question/store', 'questionstore')->name('module.lesson.quiz.questionstore');
        Route::post('/module/lesson/quiz/question/update', 'questionupdate')->name('module.lesson.quiz.questionupdate');
        Route::post('/module/lesson/quiz/question/delete', 'questiondelete')->name('module.lesson.quiz.questiondelete');


        //quiz
        Route::get('/addQuiz/{id}', 'addQuiz')->name('addQuiz');
        Route::post('/storeQuiz/{id}', 'storeQuiz')->name('storeQuiz');

        //question
        Route::get('/addQuestion/{id}', 'addQuestion')->name('addQuestion');
        Route::post('/storeQuestion/{id}', 'storeQuestion')->name('storeQuestion');


        //Author
        Route::get('/addAuthor/{id}', 'addAuthor')->name('addAuthor');
        Route::post('/storeAuthor/{id}', 'storeAuthor')->name('storeAuthor');

        //Video
        Route::get('/addVideo/{id}', 'addVideo')->name('addVideo');
        Route::post('/storeVideo/{id}', 'storeVideo')->name('storeVideo');


        //assignment and assesment route
        Route::get('/courses/assignment/{slug}', 'assignment')->name('courses.assignment');
        Route::post('/courses/assignment/{slug}', 'assignmentStore');
        Route::get('/courses/submitted-assesment', 'submittedAssesment')->name('courses.submittedAssesment');
        Route::get('/courses/unsubmitted-assesment', 'unsubmittedAssesment')->name('courses.unsubmittedAssesment');
        Route::put('/courses/submit-assesment/{id}', 'submitAssesment')->name('courses.submitAssesment');
    });



    Route::controller(InstructorLiveCourseController::class)->prefix('/livecourses')->name('livecourses.')->group(function () {
        Route::get('/', 'courses')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{slug}', 'update')->name('update');

        Route::post('/active/{id}', 'active')->name('active');
        Route::post('/inactive/{id}', 'inactive')->name('inactive');
        Route::post('/delete/{slug}', 'delete')->name('delete');

        Route::post('/schedule/store', 'schedulestore')->name('schedule.store');
        Route::post('/schedule/{id}', 'scheduleedit')->name('schedule.edit');

    });

    Route::controller(LiveclassController::class)->prefix('/liveclass')->name('liveclass.')->group(function () {
        Route::get('/', 'liveclasses')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{slug}', 'update')->name('update');
        Route::post('/active/{id}', 'active')->name('active');
        Route::post('/inactive/{id}', 'inactive')->name('inactive');
        Route::delete('/delete/{slug}', 'delete')->name('delete');
    });

    Route::controller(ExamController::class)->prefix('/exam')->as('exam.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/show/{slug}', 'show')->name('show');
        Route::get('/edit/{slug}', 'edit')->name('edit');
        Route::put('/update/{slug}', 'update')->name('update');
        Route::delete('/delete/{slug}', 'delete')->name('delete');

        Route::get('/quiz/create/{id}', 'createQuiz')->name('createQuiz');
        Route::post('/quiz/store', 'storeQuiz')->name('storeQuiz');
        Route::delete('/quiz/delete/{id}', 'deleteQuiz')->name('deleteQuiz');
    });


    Route::controller(SupportController::class)->prefix('/support')->as('support.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{slug}', 'show')->name('show');
        Route::get('/active/{id}', 'active')->name('active');
        Route::delete('/delete/{slug}', 'delete')->name('delete');
    });


    Route::controller(InstructorStudentController::class)->prefix('/students')->name('students.')->group(function () {
        Route::get('/', 'students')->name('index');
        Route::get('/{student_id}/enrolled', 'enrolled')->name('enrolled');
        Route::get('/enrolled/{enroll_id}/details', 'enrollDetails')->name('enrollDetails');
    });
});

//--instructor

//backend
Route::prefix('/admin')->as('admin.')->middleware('guest:admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('/store-login', [AdminLoginController::class, 'storeLogin'])->name('storeLogin');

    Route::get('/forgot-password', [AdminForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [AdminForgotPasswordController::class, 'storeForgotPassword'])->name('storeForgotPassword');

    Route::get('/reset-password/{token}', [AdminResetPasswordController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/reset-password', [AdminResetPasswordController::class, 'storeForgotPassword'])->name('storeResetPassword');
});

Route::prefix('/admin')->as('admin.')->middleware('auth:admin')->group(function () {
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/supports', [DashboardController::class, 'supports'])->name('supports');

    //admin management
    Route::controller(AdminRegistrationController::class)->group(function () {
        Route::get('/admin-list', 'adminList')->name('adminList');
        Route::get('/create-admin', 'createAdmin')->name('createAdmin');
        Route::post('/store-admin', 'storeAdmin')->name('storeAdmin');
        Route::get('/edit-admin/{admin}', 'editAdmin')->name('editAdmin');
        Route::post('/update-admin/{admin}', 'updateAdmin')->name('updateAdmin');
        Route::post('/admin/active-admin/{admin}', 'activeAdmin')->name('activeAdmin');
        Route::post('/admin/inactive-admin/{admin}', 'inactiveAdmin')->name('inactiveAdmin');
        Route::delete('/delete-admin/{admin}', 'deleteAdmin')->name('deleteAdmin');
    });

    Route::controller(AdminCourseController::class)->prefix('/courses')->name('courses.')->group(function () {
        Route::get('/', 'courses')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/{id}/modules', 'modules')->name('modules');
        Route::get('/{id}/module/add', 'addmodule')->name('addmodule');
        Route::get('/module/{id}/edit', 'moduleedit')->name('moduleedit');
        Route::post('/module/store', 'modulestore')->name('modulestore');
        Route::post('/module/update', 'moduleupdate')->name('moduleupdate');
        Route::post('/module/delete', 'moduledelete')->name('moduledelete');

        Route::put('/update/{slug}', 'update')->name('update');

        Route::get('/modules/{id}/lessons', 'lessons')->name('module.lessons');
        Route::get('/modules/{id}/lesson/add', 'lessonadd')->name('module.lessonadd');
        Route::get('/module/lesson/{id}/edit', 'lessonedit')->name('module.lessonedit');
        Route::get('/module/lesson/{id}/pdf', 'add_pdf')->name('module.add_pdf');
        Route::get('/module/lesson/{id}/pdf/add/page', 'add_pdf_page')->name('module.pdf_add_page');
        Route::post('/module/lesson/pdf_add_post', 'pdf_add_post')->name('module.lesson.pdf_add_post');
        Route::post('/module/lesson/pdf_edit_post', 'pdf_edit_post')->name('module.lesson.pdf_edit_post');
        Route::get('/module/lesson/{id}/pdf/delete', 'delete_pdf')->name('module.lesson.delete');


        Route::post('/modules/lesson/store', 'lessonstore')->name('module.lessonstore');
        Route::post('/module/lesson/update', 'lessonupdate')->name('module.lessonupdate');
        Route::post('/module/lesson/delete', 'lessondelete')->name('module.lessondelete');

        Route::get('/modules/lesson/{id}/videos', 'videos')->name('module.lesson.videos');
        Route::get('/modules/lesson/{id}/video/add', 'videoadd')->name('module.lesson.videoadd');
        Route::get('/module/lesson/video/{id}/edit', 'videoedit')->name('module.lesson.videoedit');
        Route::post('/modules/lesson/video/store', 'videostore')->name('module.lesson.videostore');
        Route::post('/module/lesson/video/update', 'videoupdate')->name('module.lesson.videoupdate');
        Route::post('/module/lesson/video/delete', 'videodelete')->name('module.lesson.videodelete');

        Route::get('/modules/lesson/{id}/quizzes', 'quizzes')->name('module.lesson.quizzes');
        Route::get('/modules/lesson/{id}/quiz/add', 'quizadd')->name('module.lesson.quizadd');
        Route::get('/module/lesson/quiz/{id}/edit', 'quizedit')->name('module.lesson.quizedit');
        Route::post('/modules/lesson/quiz/store', 'quizzestore')->name('module.lesson.quizzestore');
        Route::post('/module/lesson/quiz/update', 'quizupdate')->name('module.lesson.quizupdate');
        Route::post('/module/lesson/quiz/delete', 'quizdelete')->name('module.lesson.quizdelete');

        Route::get('/modules/lesson/quiz/{id}/questions', 'questions')->name('module.lesson.quiz.questions');
        Route::get('/modules/lesson/quiz/{id}/question/add', 'questionadd')->name('module.lesson.quiz.questionadd');
        Route::get('/module/lesson/quiz/question/{id}/edit', 'questionedit')->name('module.lesson.quiz.questionedit');
        Route::post('/modules/lesson/quiz/question/store', 'questionstore')->name('module.lesson.quiz.questionstore');
        Route::post('/module/lesson/quiz/question/update', 'questionupdate')->name('module.lesson.quiz.questionupdate');
        Route::post('/module/lesson/quiz/question/delete', 'questiondelete')->name('module.lesson.quiz.questiondelete');


        Route::post('/active/{id}', 'active')->name('active');
        Route::post('/inactive/{id}', 'inactive')->name('inactive');
        Route::post('/delete/{slug}', 'delete')->name('delete');


        Route::get('/students', 'students')->name('students');
        Route::post('/change/device/{student_id}', 'changeDevice')->name('change.device');
        Route::delete('/student/delete/{id}', 'studentDelete')->name('student.delete');

        //course enroll
        Route::post('/students/enroll', 'courseenroll')->name('enroll');

        Route::get('/addQuiz/{id}', 'addQuiz')->name('addQuiz');
        Route::post('/storeQuiz/{id}', 'storeQuiz')->name('storeQuiz');

        //question
        Route::get('/addQuestion/{id}', 'addQuestion')->name('addQuestion');
        Route::post('/storeQuestion/{id}', 'storeQuestion')->name('storeQuestion');

        //Author
        Route::get('/addAuthor/{id}', 'addAuthor')->name('addAuthor');
        Route::post('/storeAuthor/{id}', 'storeAuthor')->name('storeAuthor');

        //Video
        Route::get('/addVideo/{id}', 'addVideo')->name('addVideo');
        Route::post('/storeVideo/{id}', 'storeVideo')->name('storeVideo');

        //assignment and assesment route
        Route::get('/courses/assignment/{slug}', 'assignment')->name('courses.assignment');
        Route::post('/courses/assignment/{slug}', 'assignmentStore');
        Route::get('/courses/submitted-assesment', 'submittedAssesment')->name('courses.submittedAssesment');
        Route::get('/courses/unsubmitted-assesment', 'unsubmittedAssesment')->name('courses.unsubmittedAssesment');
        Route::put('/courses/submit-assesment/{id}', 'submitAssesment')->name('courses.submitAssesment');


        Route::post('/faq/update', 'faqupdate')->name('faqupdate');
        Route::get('/faq/delete/{id}', 'faqdelete')->name('faqdelete');

        //Exam Category
        Route::get('/examcatgeory', 'examcatgeory')->name('examcatgeory');
        Route::get('/createexamcatgeory', 'createexamcatgeory')->name('createexamcatgeory');
        Route::post('/storeexamcatgeory', 'storeexamcatgeory')->name('storeexamcatgeory');
        Route::get('/editexamcatgeory/{id}', 'editexamcatgeory')->name('editexamcatgeory');
        Route::post('/updateexamcatgeory/{id}', 'updateexamcatgeory')->name('updateexamcatgeory');
        Route::post('/deleteexamcatgeory/{id}', 'deleteexamcatgeory')->name('deleteexamcatgeory');


        //Exam Subcategory
        Route::get('/examsubcatgeory', 'examsubcatgeory')->name('examsubcatgeory');
        Route::get('/createexamsubcatgeory', 'createexamsubcatgeory')->name('createexamsubcatgeory');
        Route::post('/storeexamsubcatgeory', 'storeexamsubcatgeory')->name('storeexamsubcatgeory');
        Route::get('/editexamsubcatgeory/{id}', 'editexamsubcatgeory')->name('editexamsubcatgeory');
        Route::post('/updateexamsubcatgeory/{id}', 'updateexamsubcatgeory')->name('updateexamsubcatgeory');
        Route::post('/deleteexamsubcatgeory/{id}', 'deleteexamsubcatgeory')->name('deleteexamsubcatgeory');

        Route::get('/exam', 'exam')->name('exam');
        Route::get('/addexam', 'addexam')->name('exam.addexam');
        Route::post('/storeexam', 'storeexam')->name('exam.storeexam');
        // Route::post('/modules/lesson/quiz/store', 'quizzestore')->name('module.lesson.quizzestore');

        // exam.addquestions
        Route::get('/exam/{id}/examquestions', 'examquestions')->name('exam.questions');
        Route::get('/exam/{id}/question/add', 'examquestionadd')->name('exam.addquestions');
        Route::post('/exam/question/store', 'examquestionstore')->name('exam.storequestions');

        //Orders
        Route::get('/order', 'order')->name('order');
        Route::get('/review', 'review')->name('review');
        Route::get('/ebookorder', 'ebookorder')->name('ebookorder');

        //Free Videos
        Route::get('/freevideoscategory', 'freevideoscategory')->name('freevideoscategory');
        Route::get('/createfreevideoscategory', 'createfreevideoscategory')->name('createfreevideoscategory');
        Route::post('/storefreevideoscategory', 'storefreevideoscategory')->name('storefreevideoscategory');
        Route::post('/deletefreevideoscategory/{id}', 'deletefreevideoscategory')->name('deletefreevideoscategory');

        Route::get('/freevideos', 'freevideos')->name('freevideos');

        // admin.courses.freevideos
        Route::get('/createfreevideos', 'createfreevideos')->name('createfreevideos');
        Route::post('/storefreevideos', 'storefreevideos')->name('storefreevideos');
        Route::post('/deletefreevideos/{id}', 'deletefreevideos')->name('deletefreevideos');


        // admin.ebook.index

        //Exam Score
        Route::get('/examscore/{id}', 'examscore')->name('examscore');

        //Review

        Route::post('/reviewactive/{id}', 'reviewactive')->name('reviewactive');
        Route::post('/reviewinactive/{id}', 'reviewinactive')->name('reviewinactive');

        //Testimonial

        Route::get('/testimonials', 'testimonials')->name('testimonials');
        Route::get('/createtestimonials', 'createtestimonials')->name('createtestimonials');
        Route::post('/storetestimonials', 'storetestimonials')->name('storetestimonials');


        //Services
        Route::get('/services', 'services')->name('services');
        Route::get('/createservices', 'createservices')->name('createservices');
        Route::post('/storeservices', 'storeservices')->name('storeservices');
        Route::post('/deleteservices/{id}', 'deleteservices')->name('deleteservices');

        //Why Learn
        Route::get('/whylearn', 'whylearn')->name('whylearn');
        Route::get('/createwhylearn', 'createwhylearn')->name('createwhylearn');
        Route::post('/storewhylearn', 'storewhylearn')->name('storewhylearn');
        Route::get('/deletewhylearn', 'deletewhylearn')->name('deletewhylearn');


        //Supporter
        Route::get('/supporter', 'supporter')->name('supporter');
        Route::get('/supportercreate', 'supportercreate')->name('supportercreate');
        Route::post('/supporterstore', 'supporterstore')->name('supporterstore');
        Route::post('/supporterdelete/{id}', 'supporterdelete')->name('supporterdelete');

        //TOGETHER WE
        Route::get('/together', 'together')->name('together');
        Route::get('/togethercreate', 'togethercreate')->name('togethercreate');
        Route::post('/togetherstore', 'togetherstore')->name('togetherstore');

        //Teacher Student Content
        Route::get('/content', 'content')->name('content');
        Route::get('/contentcreate', 'contentcreate')->name('contentcreate');
        Route::post('/contentstore', 'contentstore')->name('contentstore');
        Route::post('/contentdelete/{id}', 'contentdelete')->name('contentdelete');

        //About
        Route::get('/about', 'about')->name('about');
        Route::get('/aboutcreate', 'aboutcreate')->name('aboutcreate');
        Route::post('/aboutstore', 'aboutstore')->name('aboutstore');
        Route::post('/aboutdelete', 'aboutdelete')->name('aboutdelete');
    });

    Route::controller(LiveCourseController::class)->prefix('/livecourses')->name('livecourses.')->group(function () {
        Route::get('/', 'courses')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{slug}', 'update')->name('update');

        Route::post('/active/{id}', 'active')->name('active');
        Route::post('/inactive/{id}', 'inactive')->name('inactive');
        Route::post('/delete/{slug}', 'delete')->name('delete');

        Route::post('/schedule/store', 'schedulestore')->name('schedule.store');
        Route::post('/schedule/{id}', 'scheduleedit')->name('schedule.edit');
    });

    Route::controller(AdminLiveclassController::class)->prefix('/liveclass')->name('liveclass.')->group(function () {
        Route::get('/', 'liveclasses')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{slug}', 'update')->name('update');
        Route::post('/active/{id}', 'active')->name('active');
        Route::post('/inactive/{id}', 'inactive')->name('inactive');
        Route::delete('/delete/{slug}', 'delete')->name('delete');
    });

    Route::controller(EventController::class)->prefix('/events')->name('events.')->group(function () {
        Route::get('/', 'events')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{slug}', 'update')->name('update');
        Route::post('/active/{id}', 'active')->name('active');
        Route::post('/inactive/{id}', 'inactive')->name('inactive');
        // Route::delete('/delete/{slug}', 'delete')->name('delete');
         Route::post('/delete/{id}', 'destroy')->name('delete');

    });

    Route::controller(NoticeController::class)->prefix('/notice')->name('notice.')->group(function () {
        Route::get('/', 'notices')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{slug}', 'update')->name('update');
        Route::post('/active/{id}', 'active')->name('active');
        Route::post('/inactive/{id}', 'inactive')->name('inactive');
        Route::delete('/delete/{slug}', 'delete')->name('delete');

    });

    Route::controller(BannerController::class)->prefix('/banner')->name('banner.')->group(function () {
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
    });

    Route::controller(AdController::class)->prefix('/ads')->name('ads.')->group(function () {
        Route::get('/categories', 'categories')->name('categories');
        Route::get('/category/create', 'categoryCreate')->name('category.create');
        Route::post('/category/store', 'categorystore')->name('category.store');
        Route::post('/category/active/{id}', 'categoryactive')->name('category.active');
        Route::post('/category/inactive/{id}', 'categoryinactive')->name('category.inactive');
        Route::get('/category/edit/{id}', 'categoryedit')->name('category.edit');
        Route::post('/category/update', 'categoryupdate')->name('category.update');
        Route::delete('/category/delete/{id}', 'categorydelete')->name('category.delete');

        Route::get('/manage', 'manage')->name('manage');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('/active/{id}', 'active')->name('active');
        Route::post('/inactive/{id}', 'inactive')->name('inactive');

        //Podcast Active Inactive
        Route::post('/podcast/active/{id}', 'podcastactive')->name('podcast.active');
        Route::post('/podcast/inactive/{id}', 'podcastinactive')->name('podcast.inactive');
        //free videos
        Route::post('/freevideos/active/{id}', 'freevideosactive')->name('freevideos.active');
        Route::post('/freevideos/inactive/{id}', 'freevideosinactive')->name('freevideos.inactive');
    });

    Route::controller(BlogController::class)->prefix('/blogs')->name('blogs.')->group(function () {
        Route::get('/', 'blogs')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{slug}', 'update')->name('update');
        Route::post('/active/{id}', 'active')->name('active');
        Route::post('/inactive/{id}', 'inactive')->name('inactive');
        Route::delete('/delete/{slug}', 'delete')->name('delete');

    });

    Route::controller(InstructorController::class)->prefix('/instructors')->name('instructors.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{instructor}', 'edit')->name('edit');
        Route::put('/update/{instructor}', 'update')->name('update');
        Route::post('/active/{instructor}', 'active')->name('active');
        Route::post('/inactive/{instructor}', 'inactive')->name('inactive');
        Route::post('/destroy/{instructor}', 'destroy')->name('destroy');

        Route::get('/payrequest', 'payrequest')->name('payrequest');
        Route::post('/due-payment/{instructor}', 'duePayment')->name('duePayment');
    });

    Route::controller(CategoryController::class)->prefix('/caetgory')->name('category.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{category}', 'edit')->name('edit');
        Route::put('/update/{category}', 'update')->name('update');
        Route::post('/active/{category}', 'active')->name('active');
        Route::post('/inactive/{category}', 'inactive')->name('inactive');
         Route::post('/delete/{category}', 'delete')->name('delete');
    });

    Route::controller(SubcategoryController::class)->prefix('/subcaetgory')->name('subcategory.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{subcategory}', 'edit')->name('edit');
        Route::put('/update/{subcategory}', 'update')->name('update');
        Route::post('/active/{subcategory}', 'active')->name('active');
        Route::post('/inactive/{subcategory}', 'inactive')->name('inactive');
    });

    Route::controller(ChildcategoryController::class)->prefix('/childcategory')->name('childcategory.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{childcategory}', 'edit')->name('edit');
        Route::put('/update/{childcategory}', 'update')->name('update');
        Route::post('/active/{childcategory}', 'active')->name('active');
        Route::post('/inactive/{childcategory}', 'inactive')->name('inactive');
    });

    Route::controller(ChildsubcategoryController::class)->prefix('/childsubcategory')->name('childsubcategory.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{childsubcategory}', 'edit')->name('edit');
        Route::put('/update/{childsubcategory}', 'update')->name('update');
        Route::post('/active/{childsubcategory}', 'active')->name('active');
        Route::post('/inactive/{childsubcategory}', 'inactive')->name('inactive');
    });

    Route::controller(AffiliateManagementController::class)->prefix('/affiliate')->name('affiliate.')->group(function () {
        Route::get('/', 'affiliateList')->name('affiliateList');
        Route::post('/active/{affiliate}', 'active')->name('active');
        Route::post('/inactive/{affiliate}', 'inactive')->name('inactive');
        Route::delete('/delete/{affiliate}', 'delete')->name('delete');
        Route::post('/set-percentage-abd-validity', 'setPercentageAndValidity')->name('setPercentageAndValidity');
    });

    //site settings
    Route::controller(CompanyInfoController::class)->group(function () {
        Route::get('/site-info', 'showSiteInfo')->name('showSiteInfo');
        Route::post('/store-site-general-info', 'storeSiteGeneralInfo')->name('storeSiteGeneralInfo');
    });
    //pages
    Route::controller(PageController::class)->prefix('/pages')->as('page.')->group(function () {
        Route::get('/pages', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{page}', 'edit')->name('edit');
        Route::put('/update/{page}', 'update')->name('update');
        Route::delete('/delete/{page}', 'delete')->name('delete');
        Route::post('/active/{page}', 'active')->name('active');
        Route::post('/inactive/{page}', 'inactive')->name('inactive');
    });

    Route::controller(ContactController::class)->prefix('/contact')->as('contact.')->group(function () {
        Route::get('/all', 'index')->name('index');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });

    Route::controller(AboutController::class)->prefix('/about-tab')->as('about-tab.')->group(function () {
        Route::get('/all', 'AboutTabIndex')->name('index');
        Route::put('/update/{id}', 'AboutTabUpdate')->name('update');
    });

    Route::resource('/coupons', CouponController::class)->except(['show', 'edit', 'update']);

    Route::resource('/promovideo', PromovideoController::class);
    Route::resource('/studentbenefit', StudentbenefitController::class);

    Route::resource('/sliders', SliderController::class);
    Route::resource('/about-item', AboutController::class);
    Route::resource('/podcast', PodcastController::class)->except(['show']);

    Route::get('/podcastcategory', [PodcastController::class, 'podcastcategory'])->name('podcastcategory.index');
    Route::get('/createpodcastcategory', [PodcastController::class, 'createpodcastcategory'])->name('podcastcategory.create');
    Route::get('/editpodcastcategory/{id}', [PodcastController::class, 'editpodcastcategory'])->name('podcastcategory.edit');

    Route::put('/updatepodcastcategory/{id}', [PodcastController::class, 'updatepodcastcategory'])->name('podcastcategory.update');
    Route::delete('/deletepodcastcategory/{id}', [PodcastController::class, 'deletepodcastcategory'])->name('podcastcategory.delete');
    Route::post('/storepodcastcategory', [PodcastController::class, 'storepodcastcategory'])->name('podcastcategory.store');

    Route::get('/package-order', [PackageController::class, 'PackageOrderList'])->name('package-order.list');
    Route::get('/package-payment', [PackageController::class, 'PackagePaymentList'])->name('package-payment.list');
    Route::post('/package-payment/active/{package_payment}', [PackageController::class, 'PackagePaymentActive'])->name('package-payment.active');
    Route::post('/package-payment/inactive/{package_payment}', [PackageController::class, 'PackagePaymentInactive'])->name('package-payment.inactive');

    Route::resource('/ebook', EbookController::class)->except(['show']);
    Route::resource('/written', WrittenController::class)->except(['show']);

    Route::post('/package/active/{package}', [PackageController::class, 'packageActive'])->name('package.active');
    Route::post('/package/inactive/{package}', [PackageController::class, 'packageInactive'])->name('package.inactive');
    Route::resource('/package', PackageController::class)->except(['show']);
});

Route::controller(GeneralController::class)->prefix('/general')->group(function () {
    Route::get('/subcategory/{id}', 'subcategory');
    Route::get('/quizsubcategory/{id}', 'quizsubcategory');
    Route::get('/childcategory/{id}', 'childcategory');
    Route::get('/childsubcategory/{id}', 'childsubcategory');
});

//custom testing google
Route::get('google/redirect', [StudentController::class, 'google_login'])->name('google.login');
Route::get('google/callback', [StudentController::class, 'google_callback'])->name('google.callback');

Route::post('/contact/store', [ContactController::class, 'ContactStore'])->name('contact.store');

