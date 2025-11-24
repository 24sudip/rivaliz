<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CvAchievement;
use App\Models\CvEducation;
use App\Models\CvInterest;
use App\Models\CvLanguage;
use App\Models\CvReference;
use App\Models\CvSkill;
use App\Models\CvSocial;
use App\Models\Enroll;
use App\Models\ReviewReply;
use App\Models\Instructor;
use App\Models\Notice;
use App\Models\Lesson;
use App\Models\Support;
use App\Models\RatingReview;
use App\Models\Liveclass;
use App\Models\McqOption;
use App\Models\McqQuestion;
use App\Models\Module;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Quiz;
use App\Models\Quizsubmit;
use App\Models\QuizsubmitAnswer;
use App\Models\Resume;
use App\Models\Student;
use App\Models\Ebook;
use App\Models\Ebookenroll;
use App\Models\Video;
use App\Models\UserDevice;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Knp\Snappy\Image;
use Laravel\Socialite\Facades\Socialite;
use Gloudemans\Shoppingcart\Facades\Cart;

class StudentController extends Controller {
    public function register(Request $request) {

      
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'phone'    => 'required',
            'email'    => 'required',
            'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $exist = Student::where('email', $request->email)->orWhere('phone', $request->phone)->first();
        if($exist){
            return redirect()->back()->with('error', 'You already have an account');
        }
    
        
        $verifyToken          = rand(1111, 9999);
 
        //  dd($request->all());
        $student              = new Student();
        $student->name        = $request->name;
        $student->email       = $request->email;
        $student->phone       = $request->phone;
        $student->verifyToken = 1;   
        // $verifyToken
        $student->password    = Hash::make($request->password);
        $student->save();

        
        // return redirect()->back()->with('success', 'Account created successfully');
        $resume             = new Resume();
        $resume->student_id = $student->id;
        $resume->save();

        // $verifyData["message"] = "Dear $student->name\r\nSuccessfully boarded your account. Your verified token is $student->verifyToken.\r\nRegards,\r\nLearnengwithshahan";
        // $verifyData["phone"]       = $student->phone;
        // $this->sendSMS($verifyData);

        // Session::put('verifyPhone', $student->phone);

        // return redirect('/verify')->with('success', 'Account created! Verify here..');

        return redirect()->to('/login')->with('success', 'Account created successfully');;

    }

    // public function login(Request $request) {
    //     $validator = Validator::make($request->all(), [
    //         'email'    => 'required',
    //         'password' => 'required',
    //     ]);


      

    //     if ($validator->fails()) {
    //         return back()->with('error', $validator->messages()->first())->withInput();
    //     }

    //     $student = Student::where('email', $request->email)->first();

    //     if (!$student) {
    //         return redirect()->back()->with('error', 'This email has no account!!');
    //     }

    //     if($student->password == null){
    //         return redirect()->back()->with('error', 'You have used different login method');
    //     }

    //     if ($student->verifyToken != 1) {
    //         Session::put('verifyPhone', $student->phone);

    //         $verifyToken          = rand(1111, 9999);
    //         $student->verifyToken = $verifyToken;
    //         $student->save();

    //         $verifyData["message"] = "Dear $student->name\r\nSuccessfully boarded your account. Your verified token is $student->verifyToken.\r\nRegards,\r\nLearnengwithshahan";
    //         $verifyData["phone"]       = $student->phone;
    //         $this->sendSMS($verifyData);

    //         return redirect()->to('/verify')->with('error', 'Please verify your account');
    //     }

    //     if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
           
    //         return redirect()->to('/student/dashboard')->with('success', 'Student Login successfully!');
    //     }


     
    //     return redirect()->back()->with('error', 'Invalid Credentitials!!');
    // }
    
 //for device login
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }
    
        $student = Student::where('email', $request->email)->first();
    
        if (!$student) {
            return redirect()->back()->with('error', 'This email has no account!!');
        }
    
        if ($student->password == null) {
            return redirect()->back()->with('error', 'You have used a different login method');
        }
    
        if ($student->verifyToken != 1) {
            Session::put('verifyPhone', $student->phone);
    
            $verifyToken          = rand(1111, 9999);
            $student->verifyToken = $verifyToken;
            $student->save();
    
            $verifyData["message"] = "Dear $student->name,\r\nSuccessfully boarded your account. Your verification token is $student->verifyToken.\r\nRegards,\r\nLearnengwithshahan";
            $verifyData["phone"]   = $student->phone;
            $this->sendSMS($verifyData);
    
            return redirect()->to('/verify')->with('error', 'Please verify your account');
        }
    
        // Attempt Login
        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            $user = Auth::guard('student')->user();
            $currentIP = $request->ip();
            $currentAgent = $request->userAgent();
    
            // Count active logins for the user
            $activeDevices = UserDevice::where('user_id', $user->id)->count();
    
            // Check if the current device is already registered
            $existingDevice = UserDevice::where('user_id', $user->id)
                ->where('device_ip', $currentIP)
                ->where('device_agent', $currentAgent)
                ->exists();
            // 
            if ($activeDevices >= $user->max_device && !$existingDevice) {
                Auth::guard('student')->logout();
                return redirect()->back()->with('error', 'You have exceeded the device login limit (1 devices).');
            }
            if($activeDevices === 1){
                $firstDevice = UserDevice::where('user_id', $user->id)->first();
                $firstType = preg_match('/(android|iphone|ipad|ipod|blackberry|windows phone|opera mini|mobile)/i', $firstDevice->device_agent) 
                ? 'Mobile' : 'Desktop';
                $currentType = preg_match('/(android|iphone|ipad|ipod|blackberry|windows phone|opera mini|mobile)/i', $currentAgent) 
                ? 'Mobile' : 'Desktop';
                if($firstType === $currentType){
                    Auth::guard('student')->logout();
                    // Request::session()->invalidate();
                    // Request::session()->regenerateToken();
                    return redirect()->back()->with('error', 'You can not use same type of device to login.');
                }
            }
            if($activeDevices === 2){
                $firstDevice = UserDevice::where('user_id', $user->id)->first();
                $secondDevice = UserDevice::where('user_id', $user->id)->latest()->first();
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
            
            // Register the new device if not already registered
            if (!$existingDevice) {
                UserDevice::create([
                    'user_id' => $user->id,
                    'device_ip' => $currentIP,
                    'device_agent' => $currentAgent
                ]);
            }
    
            return redirect()->to('/student/dashboard')->with('success', 'Logged in successfully!');
        }
    
        return redirect()->back()->with('error', 'Invalid Credentials!!');
    }
    
    public function verify(Request $request) {
        $phone = Session::get('verifyPhone');

        $student = Student::where('phone', $phone)->first();

        if ($student->verifyToken != $request->otp) {
            return redirect()->back()->with('error', 'Invalid token');
        }

        $student->verifyToken = 1;
        $student->save();

        return redirect()->to('/login')->with('success', "Accound verified. Please login");
    }

    public function forgetpassword(Request $request){
        $student = Student::where('phone', $request->phone)->first();

        if(!$student){
            return redirect()->back()->with('error', 'This phone number has no account');
        }

        $passresetToken          = rand(1111, 9999);
        $student->passresetToken = $passresetToken;
        $student->save();

        $verifyData["message"] = "Password Reset token is $student->passresetToken.\r\nRegards,\r\nLearnengwithshahan";
        $verifyData["phone"]       = $student->phone;
        $this->sendSMS($verifyData);

        Session::put('passresetPhone', $student->phone);

        return redirect('/password-reset')->with('success', 'Reset your password here..');
    }

    public function resetpassword(Request $request){
        $phone = Session::get('passresetPhone');

        $student = Student::where('phone', $phone)->first();

        if ($student->passresetToken != $request->passresetToken) {
            return redirect()->back()->with('error', 'Invalid token');
        }

        $student->password    = Hash::make($request->password);
        $student->passresetToken = 1;
        $student->save();

        return redirect()->to('/login')->with('success', "Password reset successfull. Please login");
    }

    public function dashboard() {
        $enrolled = Enroll::where('student_id', Auth::guard('student')->user()->id)->get();

        $courseIds = $enrolled->pluck('course_id');
        $moduleIds = Module::whereIn('course_id', $courseIds)->pluck('id');
        $lessonIds = Lesson::whereIn('module_id', $moduleIds)->pluck('id');

        $quizSubmit = Quizsubmit::where('student_id', Auth::guard('student')->user()->id);
        $quizRightAnswer   = $quizSubmit->sum('rightanswer');
        $quizTotalQuestion = $quizSubmit->sum('totalquestion');
        $quizSubmitAvg = $quizTotalQuestion>0 ? $quizRightAnswer * 100 / $quizTotalQuestion : 0;

        $videoCount      = Video::whereIn('lesson_id', $lessonIds)->count();
        $quizCount       = Quiz::whereIn('lesson_id', $lessonIds)->count();
        $quizSubmitCount = $quizSubmit->count();
        $liveClassCount  = Liveclass::whereIn('course_id', $courseIds)->count();

        $totalModule = $moduleIds->count();
        $moduleCompleted = $enrolled->sum('module_completed') - $enrolled->count();
        if($totalModule == 0) {
            $moduleCompleteAvg = 0;
        } else {
            $moduleCompleteAvg = $moduleCompleted*100/$totalModule;
        }

        $courses       = Course::whereIn('id', $courseIds)->get();
        $instructorIds = $courses->pluck('instructor_id')->unique();

        $instructors = Instructor::whereIn('id', $instructorIds)->get();
        $notices = Notice::whereIn('sent_to', [0, 2])->where('status', 1)->whereNull('course_id')->orderBy('id', 'DESC')->get();

        return view('frontend.student.dashboard', compact('courses', 'instructors', 'videoCount', 'quizCount', 'quizSubmitCount', 'liveClassCount', 'quizSubmitAvg', 'moduleCompleteAvg', 'notices'));
    }

    public function logout(Request $request) {
        Auth::guard('student')->logout();

        return redirect()
            ->to('/login')
            ->with('success', 'Logout Successful!!');
    }

    public function ordersave(Request $request) {

            // dd($request->all());

        //      $carts = Cart::content();
        //      dd($carts);
           
        // $cartcontents = Session::get('cart');
        // $subtotal     = 0;

        // foreach ($cartcontents as $cart) {
        //     $subtotal += $cart['price'];
        // }

        // $discount    = Session::get('discount');
        // $coupon_code = Session::get('coupon_code');

        // $total = $subtotal - $discount;

        // $order              = new Order();
        // $order->student_id  = Auth::guard('student')->user()->id;
        // $order->total       = $total;
        // $order->subtotal    = $subtotal;
        // $order->discount    = $discount;
        // $order->coupon_code = $coupon_code;
        // $order->note        = $request->note;
        // $res                = $order->save();

        // if ($res) {

        //     foreach ($cartcontents as $id => $cart) {
        //         $orderdetails            = new OrderDetails();
        //         $orderdetails->order_id  = $order->id;
        //         $orderdetails->course_id = $id;
        //         $orderdetails->price     = $cart['price'];
        //         $res                     = $orderdetails->save();

        //         if ($res) {
        //             $enroll             = new Enroll();
        //             $enroll->student_id = Auth::guard('student')->user()->id;
        //             $enroll->course_id  = $id;
        //             $enroll->save();

        //             $course               = Course::find($enroll->course_id);
        //             $instructor_commision = ($course->instructor_commision / 100) * $orderdetails->price;
        //             $course->enrolled += 1;
        //             $course->revenue += $orderdetails->price - $instructor_commision;
        //             $course->commision_amount += $instructor_commision;
        //             $course->commision_due += $instructor_commision;
        //             $course->commision_paystatus = null;
        //             $course->save();
        //         }

        //     }

        //     Session::forget('cart');
        //     Session::forget('discount');
        //     Session::forget('coupon_code');

        //     return redirect()->to('/student/dashboard')->with('success', 'Course enrolled successfully!');
        // }

        // return redirect()->back()->with('error', 'Something went wrong!');


        $student_id = $request->student_id;
        $total= $request->total_amount;
        $subtotal =$request->course_price;
        $coupon_code = $request->coupon_code;
        $discount =  $request->discount_amount;
        $course_id = $request->course_id ?? null;
        $ebook_id = $request->ebook_id ?? null;
     
        $order              = new Order();
        $order->student_id  =  $student_id;
        $order->total       = $total;
        $order->subtotal    = $subtotal;
        $order->discount    = $discount;
        $order->coupon_code = $coupon_code;
        $order->note        = $request->note ?? null;
        $order->payment_method        = $request->payment_method ;
        $res                = $order->save();
        // dd($res);    


            if ($res) {

            
                $orderdetails            = new OrderDetails();
                $orderdetails->order_id  = $order->id;
                $orderdetails->course_id =  $course_id ?? null;
                $orderdetails->ebook_id =  $ebook_id ?? null;
                $orderdetails->price     = $total;
                $res                     = $orderdetails->save();

                if( $course_id){
                    // return $course_id;

                    $enroll             = new Enroll();
                    $enroll->student_id = Auth::guard('student')->user()->id;
                    $enroll->course_id  =  $course_id;
                    $enroll->save();

                                $course   = Course::find($enroll->course_id);
                                $instructor_commision = ($course->instructor_commision / 100) * $orderdetails->price;
                                $course->enrolled += 1;
                                $course->revenue += $orderdetails->price - $instructor_commision;
                                $course->commision_amount += $instructor_commision;
                                $course->commision_due += $instructor_commision;
                                $course->commision_paystatus = null;
                                $course->save();
                   
                }
                // dd( $res  );
                // if ($res) {
                //     $enroll             = new Enroll();
                //     $enroll->student_id = Auth::guard('student')->user()->id;
                //     $enroll->course_id  =  $course_id;
                //     $enroll->save();

                //                 $course   = Course::find($enroll->course_id);
                //                 $instructor_commision = ($course->instructor_commision / 100) * $orderdetails->price;
                //                 $course->enrolled += 1;
                //                 $course->revenue += $orderdetails->price - $instructor_commision;
                //                 $course->commision_amount += $instructor_commision;
                //                 $course->commision_due += $instructor_commision;
                //                 $course->commision_paystatus = null;
                //                 $course->save();

                // }

                else{
                    // return  $ebook_id;
                    $enroll             = new Ebookenroll();
                    $enroll->student_id = Auth::guard('student')->user()->id;
                    $enroll->ebook_id  = $ebook_id;
                    $enroll->save();
                    $ebook  = Ebook::find($enroll->ebook_id);
                    $ebook->enrolled += 1;
                    $ebook->revenue += $orderdetails->price ;
                    $ebook->save();

                   
                }
            

         }
              Session::forget('cart');
            Session::forget('discount');
            Session::forget('coupon_code');

         return redirect()->to('/student/dashboard')->with('success', 'Course enrolled successfully!');
}

    // public function courses() {
    //     $courseIds = Enroll::where('student_id', Auth::guard('student')->user()->id)->pluck('course_id');
    //     $courses   = Course::whereIn('id', $courseIds)->get();

    //     return view('frontend.student.courses', compact('courses'));
    // }


    public function courses() {
        // $courseIds = Enroll::where('student_id', Auth::guard('student')->user()->id)->pluck('course_id');
        //         $courses   = Course::whereIn('id', $courseIds)->get();
          
        // //   dd(  $student);
        //      $student = Auth::guard('student')->user();
        //     //   dd($student);
        //      $enrolledCourseIds = json_decode($student->enrolledcourse);
        //      $courses   = Course::whereIn('id', $enrolledCourseIds)->get();
        // //   dd( $courses);
   $student = Auth::guard('student')->user();

    // 1. Get course IDs from Enroll model
    $courseIdsFromEnroll = Enroll::where('student_id', $student->id)->pluck('course_id')->toArray();

    // 2. Get course IDs from enrolledcourse field
    $courseIdsFromField = json_decode($student->enrolledcourse, true) ?? [];

    // 3. Merge both arrays and remove duplicates
    $mergedCourseIds = array_unique(array_merge($courseIdsFromEnroll, $courseIdsFromField));

    // 4. Fetch all matching courses
    $courses = Course::whereIn('id', $mergedCourseIds)->get();

        return view('frontend.student.courses', compact('courses'));
    }

    public function ebooks(){
        $ebookIds = Ebookenroll::where('student_id', Auth::guard('student')->user()->id)->pluck('ebook_id');
        $ebooks   = Ebook::whereIn('id', $ebookIds)->get();

        // dd($ebooks);

     
        return view('frontend.student.ebooks',compact('ebooks'));
    }

    public function coursedetails(Request $request, $id) {

        $enrolled = Enroll::where(['student_id' => Auth::guard('student')->user()->id, 'course_id' => $id])->first();

        // if (!$enrolled) {
        //     return redirect()->back()->with('error', 'Course is not enrolled yet');
        // }
        // $enrolled = Course::where('id', $id)->first();

        $course = Course::where('id', $id)->with('modules', 'modules.lessons', 'modules.lessons.videos', 'modules.lessons.quizzes')->first();
//       $lessonIds = [];

// // Loop through the modules and lessons to extract the lesson IDs
// if ($course) {
//     foreach ($course->modules as $module) {
//         foreach ($module->lessons as $lesson) {
//             $lessonIds[] = $lesson->id;
//         }
//     }
// }

// // Return or use the lesson IDs as needed
// return $lessonIds;

        if ($request->video) {
            $current_video = Video::find(base64_decode($request->video));

            $enrolled->current_video = base64_decode($request->video);
            $enrolled->save();
        } elseif ($enrolled->current_video) {
            $current_video = Video::find($enrolled->current_video);
        } else {
            $current_video = null;
        }

        return view('frontend.student.coursedetails', compact('course', 'current_video', 'enrolled'));
    }

    public function quiz(Request $request, $id) {
        $quiz = Quiz::find(base64_decode($request->id));

        $submitted = Quizsubmit::with('submitanswers')->where(['quiz_id' => $quiz->id, 'student_id' => Auth::guard('student')->user()->id])->latest()->first();

        if ($submitted) {
            $totalQuestion = $submitted->totalquestion;
            $correct       = $submitted->rightanswer;
            $totalAnswer   = $submitted->submitanswers->count();

            return view('frontend.student.quizsubmit', compact('totalQuestion', 'correct', 'totalAnswer', 'quiz'));
        }

        $question = McqQuestion::where('quiz_id', $quiz->id)->count();

        return view('frontend.student.quiz', compact('quiz', 'question'));
    }

    public function quizquestion(Request $request, $id) {
        $quiz = Quiz::find($request->id);

        $questions = McqQuestion::with('options')->where('quiz_id', $quiz->id)->get();

        return view('frontend.student.quizquestion', compact('quiz', 'questions'));
    }

    public function quizsubmit(Request $request) {
        $data = $request->all();

        $quizId = $data['quiz_id'];
        $quiz   = Quiz::find($quizId);

        $submitted = Quizsubmit::with('submitanswers')->where(['quiz_id' => $quizId, 'student_id' => Auth::guard('student')->user()->id])->latest()->first();

        if ($submitted) {
            $totalQuestion = $submitted->totalquestion;
            $correct       = $submitted->rightanswer;
            $totalAnswer   = $submitted->submitanswers->count();

            return view('frontend.student.quizsubmit', compact('totalQuestion', 'correct', 'totalAnswer', 'quiz'));
        }

        $filteredData  = array_diff_key($data, array_flip(['_token', 'quiz_id']));
        $totalQuestion = McqQuestion::where('quiz_id', $quizId)->count();
        $totalAnswer   = count($filteredData);
        $correct       = 0;

        foreach ($filteredData as $questionId => $optionId) {

            $correct += McqOption::where([
                'quiz_id'     => $quizId,
                'mcq_ques_id' => $questionId,
                'id'          => $optionId,
                'isAnswer'    => true,
            ])->count();

        }

        $quizSubmit = Quizsubmit::create([
            'student_id'    => Auth::guard('student')->user()->id,
            'quiz_id'       => $quizId,
            'totalquestion' => $totalQuestion,
            'rightanswer'   => $correct,
        ]);

        foreach ($filteredData as $questionId => $optionId) {

            $rightOption = McqOption::where(['mcq_ques_id' => $questionId, 'isAnswer' => true])->first();

            QuizsubmitAnswer::create([
                'student_id'   => Auth::guard('student')->user()->id,
                'quiz_id'      => $quizId,
                'question_id'  => $questionId,
                'option_id'    => $optionId,
                'submit_id'    => $quizSubmit->id,
                'right_option' => $rightOption->id,
                'isRight'      => $optionId == $rightOption->id,
            ]);
        }

        $studentId = Auth::guard('student')->user()->id;

        $quiz     = Quiz::with('lesson.module.course')->find($quizId);
        $module   = $quiz->lesson->module;
        $courseId = $module->course_id;

        $lessonIds = $module->lessons->pluck('id');
        $quizIds   = Quiz::whereIn('lesson_id', $lessonIds)->pluck('id');

        $quizSubmittedCount = Quizsubmit::whereIn('quiz_id', $quizIds)
            ->where('student_id', $studentId)
            ->count();

        $moduleCount = Module::where('course_id', $courseId)->count();
        $enroll      = Enroll::firstOrCreate(
            ['student_id' => $studentId, 'course_id' => $courseId]
        );

        if ($quizIds->count() == $quizSubmittedCount) {
            $enroll->increment('module_completed');

            $enroll->certification = $moduleCount <= $enroll->module_completed;
            $enroll->certificateNo = 'LMS' . rand(11111, 99999);
            $enroll->save();
        }

        return view('frontend.student.quizsubmit', compact('totalQuestion', 'correct', 'totalAnswer', 'quiz'));
    }

    public function quizanswer($id) {
        $quizSubmit    = Quizsubmit::with('submitanswers')->where(['quiz_id' => $id, 'student_id' => Auth::guard('student')->user()->id])->latest()->first();
        $submitanswers = QuizsubmitAnswer::where('submit_id', $quizSubmit->id)->get();

        $quiz      = Quiz::find($id);
        $questions = McqQuestion::with('options')->where('quiz_id', $quiz->id)->get();

        return view('frontend.student.quizanswer', compact('quiz', 'questions', 'quizSubmit', 'submitanswers'));
    }

    public function grades() {
        $submitted = Quizsubmit::with('quiz')->whereHas('quiz', function ($query) {
            $query->where('exam_status', null);
        })->where(['student_id' => Auth::guard('student')->user()->id])->latest()->get();

        return view('frontend.student.grades', compact('submitted'));
    }

    public function exams() {
        $submitted = Quizsubmit::with('quiz')->whereHas('quiz', function ($query) {
            $query->where('exam_status', 1);
        })->where(['student_id' => Auth::guard('student')->user()->id])->latest()->get();

        return view('frontend.student.exams', compact('submitted'));
    }


    public function instructors() {
        $courseIds     = Enroll::where('student_id', Auth::guard('student')->user()->id)->pluck('course_id');
        $instructorIds = Course::whereIn('id', $courseIds)->pluck('instructor_id')->unique();

        $instructors = Instructor::whereIn('id', $instructorIds)->get();

        return view('frontend.student.instructors', compact('instructors'));
    }

    public function liveclasses() {
        $courseIds = Enroll::where('student_id', Auth::guard('student')->user()->id)->pluck('course_id');

        $classes = Liveclass::with('course', 'instructor')
            ->whereIn('course_id', $courseIds)
            ->orderBy('scheduled_at', 'ASC')
            ->get();

        return view('frontend.student.liveclasses', compact('classes'));
    }

    public function profile() {
        $profile = Student::find(Auth::guard('student')->user()->id);

        $resume = Resume::with('educations')->where('student_id', Auth::guard('student')->user()->id)->first();

        return view('frontend.student.profile', compact('profile', 'resume'));
    }

    public function editprofile() {
        $profile = Student::find(Auth::guard('student')->user()->id);

        return view('frontend.student.editprofile', compact('profile'));
    }

    public function profileupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $profile = Student::find(Auth::guard('student')->user()->id);

        if ($request->image) {
            $file = $request->file('image');

            if ($file) {

                $extension = hexdec(uniqid());
                $path      = 'images/student/';
                $name      = strtolower($file->getClientOriginalExtension());

                $img_name = $extension . '.' . $name;
                $image    = $path . $extension . '.' . $name;

                $file->move($path, $img_name);
                $profile->image = $image;
            }

        }

        $profile->name     = $request->name;
        $profile->email    = $request->email;
        $profile->phone    = $request->phone;
        $profile->address  = $request->address;
        $profile->gender   = $request->gender;
        $profile->religion = $request->religion;
        $profile->blood    = $request->blood;
        $profile->save();

        return redirect()->to('/student/profile')->with('success', 'Profile Updated');
    }

    public function settings(){
        return view('frontend.student.settings');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $student = Auth::guard('student')->user();

        if (!Hash::check($request->old_password, $student->password)) {
            return redirect()->back()->with('error', 'The provided password does not match your current password.');
        }

        $student->password = Hash::make($request->new_password);
        $student->save();

        return redirect()->route('student.profile')->with('success', 'Password changed successfully.');
    }


    public function resume() {
        $resume = Resume::where('student_id', Auth::guard('student')->user()->id)->first();

        return view('frontend.student.resume.index', compact('resume'));
    }

    public function resumedownload(Request $request) {
        $resume = Resume::where('student_id', Auth::guard('student')->user()->id)->with(['student', 'skills', 'socials', 'references', 'educations', 'achievements', 'interests', 'languages'])->first();

        if (!$resume) {
            abort(404, 'Resume not found');
        }

        $pdf = PDF::loadView('frontend.student.resume.download', compact('resume'));

        return $pdf->download('resume.pdf');
    }

    public function resumesave(Request $request) {
        $resume = Resume::where('student_id', Auth::guard('student')->user()->id)->with(['student', 'skills', 'socials', 'references', 'educations', 'achievements', 'interests', 'languages'])->first();

        if (!$resume) {
            abort(404, 'Resume not found');
        }

        $snappy = new Image();

        $png = $snappy->getOutputFromHtml(view('frontend.student.resume.download', compact('resume'))->render());

        return response($png)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="resume.png"');
    }

    public function editresume() {
        $resume = Resume::where('student_id', Auth::guard('student')->user()->id)->first();

        return view('frontend.student.resume.editresume', compact('resume'));
    }

    public function resumeupdate(Request $request) {
        $resume = Resume::where('student_id', Auth::guard('student')->user()->id)->first();

        if (!$resume) {
            $resume = new Resume();
        }

        $resume->title       = $request->title;
        $resume->designation = $request->designation;
        $resume->summary     = $request->summary;
        $resume->student_id  = Auth::guard('student')->user()->id;
        $resume->save();

        return redirect()->to('/student/profile')->with('success', 'Resume Updated');
    }

    public function educationcreate() {
        return View('frontend.student.resume.educationcreate');
    }

    public function educationstore(Request $request) {
        $resume                = Resume::where('student_id', Auth::guard('student')->user()->id)->first();
        $education             = new CvEducation();
        $education->resume_id  = $resume->id;
        $education->institute  = $request->institute;
        $education->degree     = $request->degree;
        $education->study      = $request->study;
        $education->grade      = $request->grade;
        $education->start_date = $request->start_date;
        $education->end_date   = $request->end_date;
        $education->save();

        return redirect()->to('/student/profile')->with('success', 'Education Added');
    }

    public function educationedit($id) {
        $education = CvEducation::find($id);

        return View('frontend.student.resume.educationedit', compact('education'));
    }

    public function educationupdate(Request $request) {
        $education             = CvEducation::find($request->hidden_id);
        $education->institute  = $request->institute;
        $education->degree     = $request->degree;
        $education->study      = $request->study;
        $education->grade      = $request->grade;
        $education->start_date = $request->start_date;
        $education->end_date   = $request->end_date;
        $education->save();

        return redirect()->to('/student/profile')->with('success', 'Education Updated');
    }

    public function educationdelete($id) {
        $education = CvEducation::find($id);
        $education->delete();

        return redirect()->to('/student/profile')->with('success', 'Education Deleted');

    }

    public function skillcreate() {
        return View('frontend.student.resume.skillcreate');
    }

    public function skillstore(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'level' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $resume           = Resume::where('student_id', Auth::guard('student')->user()->id)->first();
        $skill            = new CvSkill();
        $skill->resume_id = $resume->id;
        $skill->name      = $request->name;
        $skill->details   = $request->details;
        $skill->level     = $request->level;
        $skill->save();

        return redirect()->to('/student/profile')->with('success', 'Skill Added');
    }

    public function skilledit($id) {
        $skill = CvSkill::find($id);

        return View('frontend.student.resume.skilledit', compact('skill'));
    }

    public function skillupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'level' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $skill          = CvSkill::find($request->hidden_id);
        $skill->name    = $request->name;
        $skill->details = $request->details;
        $skill->level   = $request->level;
        $skill->save();

        return redirect()->to('/student/profile')->with('success', 'Skill Updated');
    }

    public function skilldelete($id) {
        $skill = CvSkill::find($id);
        $skill->delete();

        return redirect()->to('/student/profile')->with('success', 'Skill Deleted');
    }

    public function interestcreate() {

        return View('frontend.student.resume.interestcreate');
    }

    public function intereststore(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $resume              = Resume::where('student_id', Auth::guard('student')->user()->id)->first();
        $interest            = new CvInterest();
        $interest->resume_id = $resume->id;
        $interest->name      = $request->name;

        $interest->save();

        return redirect()->to('/student/profile')->with('success', 'Interest Added');
    }

    public function interestedit($id) {
        $interest = CvInterest::find($id);

        return View('frontend.student.resume.interestedit', compact('interest'));
    }

    public function interestupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $interest       = CvInterest::find($request->hidden_id);
        $interest->name = $request->name;

        $interest->save();

        return redirect()->to('/student/profile')->with('success', 'Interest Updated');
    }

    public function interestdelete($id) {
        $interest = CvInterest::find($id);
        $interest->delete();

        return redirect()->to('/student/profile')->with('success', 'Interest Deleted');
    }

    public function languagecreate() {

        return View('frontend.student.resume.languagecreate');
    }

    public function languagestore(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $resume              = Resume::where('student_id', Auth::guard('student')->user()->id)->first();
        $language            = new CvLanguage();
        $language->resume_id = $resume->id;
        $language->name      = $request->name;

        $language->save();

        return redirect()->to('/student/profile')->with('success', 'Language Added');
    }

    public function languageedit($id) {
        $language = CvLanguage::find($id);

        return View('frontend.student.resume.languageedit', compact('language'));
    }

    public function languageupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $language       = CvLanguage::find($request->hidden_id);
        $language->name = $request->name;

        $language->save();

        return redirect()->to('/student/profile')->with('success', 'Language Updated');
    }

    public function languagedelete($id) {
        $language = CvLanguage::find($id);
        $language->delete();

        return redirect()->to('/student/profile')->with('success', 'Language Deleted');
    }

    public function achievementcreate() {
        return View('frontend.student.resume.achievementcreate');
    }

    public function achievementstore(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $resume                 = Resume::where('student_id', Auth::guard('student')->user()->id)->first();
        $achievement            = new CvAchievement();
        $achievement->resume_id = $resume->id;
        $achievement->name      = $request->name;
        $achievement->details   = $request->details;
        $achievement->link      = $request->link;
        $achievement->save();

        return redirect()->to('/student/profile')->with('success', 'Achievement Added');
    }

    public function achievementedit($id) {
        $achievement = CvAchievement::find($id);

        return View('frontend.student.resume.achievementedit', compact('achievement'));
    }

    public function achievementupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $achievement          = CvAchievement::find($request->hidden_id);
        $achievement->name    = $request->name;
        $achievement->details = $request->details;
        $achievement->link    = $request->link;
        $achievement->save();

        return redirect()->to('/student/profile')->with('success', 'Achievement Updated');
    }

    public function achievementdelete($id) {
        $achievement = CvAchievement::find($id);
        $achievement->delete();

        return redirect()->to('/student/profile')->with('success', 'Achievement Deleted');
    }

    //==================Social Accounts==============================\\

    public function socialcreate() {
        return View('frontend.student.resume.socialcreate');
    }

    public function socialstore(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $resume            = Resume::where('student_id', Auth::guard('student')->user()->id)->first();
        $social            = new CvSocial();
        $social->resume_id = $resume->id;
        $social->name      = $request->name;
        $social->icon      = $request->icon;
        $social->link      = $request->link;
        $social->save();

        return redirect()->to('/student/profile')->with('success', 'Social Added');
    }

    public function socialedit($id) {
        $social = CvSocial::find($id);

        return View('frontend.student.resume.socialedit', compact('social'));
    }

    public function socialupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $social       = CvSocial::find($request->hidden_id);
        $social->name = $request->name;
        $social->icon = $request->icon;
        $social->link = $request->link;
        $social->save();

        return redirect()->to('/student/profile')->with('success', 'Social Updated');
    }

    public function socialdelete($id) {
        $social = CvSocial::find($id);
        $social->delete();

        return redirect()->to('/student/profile')->with('success', 'Social Deleted');
    }

// ================================================================ \\


    public function getSupport(Request $request){
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $support = new Support();
        $support->student_id = Auth::guard('student')->user()->id;
        $support->course_id = $request->course_id;
        $support->instructor_id = $request->instructor_id;
        $support->subject = $request->subject;
        $support->description = $request->description;
        $support->status = 0;
        $support->save();

        return redirect()->back()->with('success', 'Suppor has been issued. Wait for the Instructor\'s response');

    }


    //==================References==============================\\

    public function referencecreate() {
        return View('frontend.student.resume.referencecreate');
    }

    public function referencestore(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $resume                 = Resume::where('student_id', Auth::guard('student')->user()->id)->first();
        $reference              = new CvReference();
        $reference->resume_id   = $resume->id;
        $reference->name        = $request->name;
        $reference->designation = $request->designation;
        $reference->phone       = $request->phone;
        $reference->email       = $request->email;
        $reference->save();

        return redirect()->to('/student/profile')->with('success', 'Reference Added');
    }

    public function referenceedit($id) {
        $reference = CvReference::find($id);

        return View('frontend.student.resume.referenceedit', compact('reference'));
    }

    public function referenceupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $reference              = CvReference::find($request->hidden_id);
        $reference->name        = $request->name;
        $reference->designation = $request->designation;
        $reference->phone       = $request->phone;
        $reference->email       = $request->email;
        $reference->save();

        return redirect()->to('/student/profile')->with('success', 'Reference Updated');
    }

    public function referencedelete($id) {
        $reference = CvReference::find($id);
        $reference->delete();

        return redirect()->to('/student/profile')->with('success', 'Reference Deleted');
    }

    // ================================================================= \\


    public function reviewsubmit(Request $request){
        $validator = Validator::make($request->all(), [
            'rating' => 'required',
            'review'=> 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $review = new RatingReview();
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->student_id = Auth::guard('student')->user()->id;
        $review->course_id = $request->id;
        $review->status = 1;
        $review->save();

        return redirect()->back()->with('success', 'Review submitted.');
    }

    public function replysubmit(Request $request){
        $validator = Validator::make($request->all(), [
            'reply' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        ReviewReply::create([
            'review_id'     => $request->review_id,
            'student_id' => Auth::guard('student')->user()->id,
            'reply'         => $request->reply,
        ]);

        return redirect()->back()->with('You replied!!');
    }



    public function sendSMS($verifyData) {
        // dd($verifyData);
        $phone       = $verifyData["phone"];
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
    }

    public function google_login() {
        return Socialite::driver('google')
        ->scopes(['openid', 'profile', 'email'])
        ->redirect();
    }

    public function google_callback() {
        $user = Socialite::driver('google')->stateless()->user();
        
         
        $student = Student::where('email', $user->email)->first();
        if(!$student){
            $student              = new Student();
            $student->name        = $user->name;
            $student->email       = $user->email;
            $student->image       = $user->avatar;
            $student->verifyToken = 1;
            $student->save();

            $resume             = new Resume();
            $resume->student_id = $student->id;
            $resume->save();
        }


        Auth::guard('student')->login($student);

        return redirect()->to('/student/dashboard');

    }




}
