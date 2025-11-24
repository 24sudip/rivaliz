<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Childsubcategory;
use App\Models\Course;
use App\Models\Review;
use App\Models\Order;
use App\Models\Instructor;
use App\Models\Supporter;
use App\Models\Lesson;
use App\Models\McqOption;
use App\Models\McqQuestion;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\QuizCategory;
use App\Models\QuizSubCategory;
use App\Models\Faq;
use App\Models\QuizOption;
use App\Models\Subcategory;
use App\Models\Freevideoscategory;
use App\Models\Freevideo;
use App\Models\Video;
use App\Models\Testimonial;
use App\Models\Whylearn;
use App\Models\Service;
use App\Models\Together;
use App\Models\Content;
use App\Models\About;
use App\Models\Student;
use App\Models\Written;
use App\Models\Enroll;
use App\Models\Quizsubmit;
use App\Models\CourseSyllabusFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Mail\CourseEnrolled;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class CourseController extends Controller {

    // public function courseenroll(Request $request)
    // {
    //     // Validate the input
    //     $request->validate([
    //         'student_ids' => 'required|array',  // Ensure multiple student IDs are provided
    //         'course_id' => 'required|exists:courses,id',  // Validate course ID
    //     ]);

    //     // Find the course
    //     $course = Course::findOrFail($request->course_id);

    //     // Loop through each selected student
    //     foreach ($request->student_ids as $studentId) {
    //         $student = Student::findOrFail($studentId);

    //         // Save the course ID to the enrolledcourse field for each student
    //         $student->enrolledcourse = $request->course_id;
    //         $student->save();

    //         // Send email to the student
    //         Mail::to($student->email)->send(new CourseEnrolled($student, $course));
    //     }

    //     return back()->with('success', 'Students enrolled successfully and emails sent!');
    // }

    public function students(){
        $datas = Student::orderBy('id', 'DESC')->get();

        foreach ($datas as $student) {
            // Convert the enrolledcourse string into an array
            $courseIds = json_decode($student->enrolledcourse);

            // Ensure it's an array (in case the field is empty or contains invalid data)
            if (is_array($courseIds) && count($courseIds) > 0) {
                // Get the course names corresponding to the course IDs
                $courseNames = Course::whereIn('id', $courseIds)->pluck('name')->toArray();

                // Assign the course names to the student
                $student->enrolledcourse_names = $courseNames;
            } else {
                // If no valid course IDs, set enrolledcourse_names as an empty array
                $student->enrolledcourse_names = [];
            }
        }
        return view('backend.students.index',compact('datas'));
    }

    public function changeDevice(Request $request, $student_id) {
        $student = Student::where('id', $student_id)->first();
        $student->update([
            'max_device'=>$request->max_device
        ]);
        return redirect()->back()->with('success', 'Device Limit Changed Successfully!');
    }

    public function studentDelete($id) {
        $student = Student::where('id', $id)->first();
        $student->delete();

        return redirect()->back()->with('success', 'Student Deleted Successfully!');
    }

    //bACKUP CODE start
    //     public function courseenroll(Request $request)
    // {
    //     // Validate the input
    //     $request->validate([
    //         'student_ids' => 'required|array',
    //         'course_id' => 'required|exists:courses,id',
    //     ]);
    //     $course = Course::findOrFail($request->course_id);

    //     foreach ($request->student_ids as $studentId) {
    //         $student = Student::findOrFail($studentId);

    //         $enrolledCourses = json_decode($student->enrolledcourse, true) ?? [];

    //         if (!in_array($course->id, $enrolledCourses)) {
    //             $enrolledCourses[] = $course->id;
    //         }
    //         $student->enrolledcourse = json_encode($enrolledCourses);
    //         $student->save();

    //         Mail::to($student->email)->send(new \App\Mail\CourseEnrolled($student, $course));
    //     }
    //     return back()->with('success', 'Students enrolled successfully and emails sent!');
    // }
    //Backup code ends

    //4/15/25 bACKUP CODE start
    public function Bcourseenroll(Request $request)
    {
        $request->validate([
            'student_ids' => 'nullable|array',
            'student_ids.*' => 'exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'email' => 'nullable|email',
        ]);

        $course = Course::findOrFail($request->course_id);
        $studentIds = $request->student_ids ?? [];

        // Handle new email
        if ($request->filled('email')) {
            $existingStudent = Student::where('email', $request->email)->first();

            if ($existingStudent) {
                // Already exists
                $student = $existingStudent;
                $password = null; // Don't send password again
            } else {
                // Create new student
                $name = strstr($request->email, '@', true);
                $randomPassword = Str::random(8);

                $student = new Student();
                $student->name = $name;
                $student->email = $request->email;
                $student->verifyToken = 1;
                $student->password = Hash::make($randomPassword);
                $student->enrolledcourse = json_encode([$course->id]);
                $student->save();

                $password = $randomPassword;
            }

            // Enroll new or existing student
            $enrolledCourses = json_decode($student->enrolledcourse, true) ?? [];

            if (!in_array($course->id, $enrolledCourses)) {
                $enrolledCourses[] = $course->id;
                $student->enrolledcourse = json_encode($enrolledCourses);
                $student->save();
            }

            Mail::to($student->email)->send(new \App\Mail\CourseEnrolled($student, $course, $password));
        }

        // Enroll existing selected students
        foreach ($studentIds as $studentId) {
            $student = Student::findOrFail($studentId);
            $enrolledCourses = json_decode($student->enrolledcourse, true) ?? [];

            if (!in_array($course->id, $enrolledCourses)) {
                $enrolledCourses[] = $course->id;
                $student->enrolledcourse = json_encode($enrolledCourses);
                $student->save();

                Mail::to($student->email)->send(new \App\Mail\CourseEnrolled($student, $course));
            }
        }

        return back()->with('success', 'Students enrolled successfully and emails sent!');
    }
    //4/15/25 bACKUP CODE ends

    //Working codeeeee
    public function courseenroll(Request $request) {
        $request->validate([
            'student_ids' => 'nullable|array',
            'student_ids.*' => 'exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'email' => 'nullable|string', // changed to string to support comma-separated
        ]);

        $course = Course::findOrFail($request->course_id);
        $studentIds = $request->student_ids ?? [];

        // Handle comma-separated emails
        if ($request->filled('email')) {
            $emails = explode(',', $request->email);

            foreach ($emails as $rawEmail) {
                $email = trim($rawEmail);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    continue; // Skip invalid emails
                }

                $existingStudent = Student::where('email', $email)->first();

                if ($existingStudent) {
                    $student = $existingStudent;
                    $password = null;
                } else {
                    $name = strstr($email, '@', true);
                    $randomPassword = Str::random(8);

                    $student = new Student();
                    $student->name = $name;
                    $student->email = $email;
                    $student->verifyToken = 1;
                    $student->password = Hash::make($randomPassword);
                    $student->enrolledcourse = json_encode([$course->id]);
                    $student->save();

                    $password = $randomPassword;
                }

                // Enroll if not already enrolled
                $enrolledCourses = json_decode($student->enrolledcourse, true) ?? [];

                if (!in_array($course->id, $enrolledCourses)) {
                    $enrolledCourses[] = $course->id;
                    $student->enrolledcourse = json_encode($enrolledCourses);
                    $student->save();
                }
                // ✅ Ensure student is enrolled in Enrolls table
                Enroll::firstOrCreate([
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                ]);
                // 🔐 Generate signed login URL
                $signedLoginUrl = URL::signedRoute(
                    'student.autologin',

                    ['student' => $student->id]
                );

                Mail::to($student->email)->send(new \App\Mail\CourseEnrolled($student, $course, $password, $signedLoginUrl));
            }
        }

        // Enroll existing selected students
        foreach ($studentIds as $studentId) {
            $student = Student::findOrFail($studentId);
            $enrolledCourses = json_decode($student->enrolledcourse, true) ?? [];

            if (!in_array($course->id, $enrolledCourses)) {
                $enrolledCourses[] = $course->id;

                $student->enrolledcourse = json_encode($enrolledCourses);
                $student->save();
                Enroll::firstOrCreate([
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                ]);
            }
            // 🔐 Signed URL
            $signedLoginUrl = URL::signedRoute(
                'student.autologin',

                ['student' => $student->id]
            );
            Mail::to($student->email)->send(new \App\Mail\CourseEnrolled($student, $course ,null, $signedLoginUrl));
        }

        return back()->with('success', 'Students enrolled successfully and emails sent!');
    }


    public function order() {
        $orders = Order::orderBy('id', 'DESC')
        ->whereRelation('orderDetails', 'ebook_id', null)
        ->with(['orderDetails', 'student','courses'])->get();

       return view('backend.orders.index', compact('orders'));
    }

    public function  ebookorder() {
        $orders = Order::orderBy('id', 'DESC')->whereRelation('orderDetails', 'course_id', null)
        ->with(['orderDetails', 'student','courses'])->get();
        return view('backend.ebookorders.index', compact('orders'));
    }

    public function review() {
        $reviews = Review::orderBy('id', 'DESC')->where('ebook_id',null)->get();
        return view('backend.reviews.index', compact('reviews'));
    }

    //Exam score
    public function examscore($id) {

    //     $examscores = Quizsubmit::where('quiz_id', $id)
    //     ->with('quiz', 'student')
    //     ->orderByDesc('rightanswer') // Highest score first
    //     ->get()
    //     ->map(function ($score) {
    //         $score->score_percentage = $score->totalquestion > 0
    //             ? round(($score->rightanswer / $score->totalquestion) * 100, 2)
    //             : 0;

    //         $score->total_points = $score->rightanswer; // assuming 1 point per correct answer
    //         return $score;
    //     });
        $examscores = Quizsubmit::where('quiz_id', $id)
        ->with('quiz', 'student')
        ->orderByDesc('rightanswer')  // sorts by rightanswer descending
        ->get()
        ->map(function ($score) {
            $score->score_percentage = $score->totalquestion > 0
                ? round(($score->rightanswer / $score->totalquestion) * 100, 2)
                : 0;
            $score->total_points = $score->rightanswer;
            return $score;
        });
        return view('backend.exams.examscore',compact('examscores'));
    }


//     public function examscore($id)
// {
//     // Group by student_id, sum right answers and total questions
//     $summaries = Quizsubmit::where('quiz_id', $id)
//         ->selectRaw('student_id, quiz_id, SUM(rightanswer) as total_rightanswer, SUM(totalquestion) as total_questions')
//         ->groupBy('student_id', 'quiz_id')
//         ->with(['student', 'quiz']) // load relations
//         ->get()
//         ->map(function ($summary) {
//             $summary->score_percentage = $summary->total_questions > 0
//                 ? round(($summary->total_rightanswer / $summary->total_questions) * 100, 2)
//                 : 0;

//             $summary->total_points = $summary->total_rightanswer;
//             return $summary;
//         })
//         ->sortByDesc('total_rightanswer')
//         ->values(); // reset keys
//     return view('backend.exams.examscore', compact('summaries'));
// }

    public function  freevideoscategory(){
        $categories = Freevideoscategory::orderBy('id','DESC')->get();
        return view('backend.videos.categoryindex',compact('categories'));
    }

    public function createfreevideoscategory(Request $request){
        return view('backend.videos.categorycreate');
    }

    public function storefreevideoscategory(Request $request){
        $data =   new Freevideoscategory;
        $data->name = $request->name;
        $data->save();
        return redirect()->route('admin.courses.freevideoscategory')->with('success', 'Category submitted successfully!!');
    }

    public function deletefreevideoscategory(Request $request,$id){
        $freevideo =   Freevideoscategory::findorFail($id);
        $freevideo->delete();
        return redirect()->route('admin.courses.freevideoscategory')->with('danger', 'Your Free videos successfully!!');
    }

    public function freevideos(){
        $datas =   Freevideo::orderBy('id','DESC')->with('category')->get();
        return view('backend.videos.index',compact('datas'));
    }



    public function testimonials() {
        $datas =   Testimonial::orderBy('id','DESC')->get();
        return view('backend.testimonial.index',compact('datas'));
    }

    public function createtestimonials(){
        return view('backend.testimonial.create');
    }

    public function  storetestimonials(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // 2MB max
        ]);

        // Upload the image directly without store()
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension(); // Generate unique filename
            $imagePath = 'images/testimonials/' . $imageName;
            $request->image->move(public_path('images/testimonials/'), $imageName); // Save to /public/uploads/testimonials
        } else {
            $imageName = null;
        }

        // Store data normally
        Testimonial::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath , // Save only filename in DB
        ]);
        return redirect()->back()->with('success', 'Testimonial added successfully!');
    }



    public function  whylearn() {
        $datas =   Whylearn::orderBy('id','DESC')->get();
        return view('backend.whylearn.index',compact('datas'));
    }


    public function  createwhylearn(){
        return view('backend.whylearn.create');
    }

    public function storewhylearn(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // 2MB max
        ]);

        // Upload the image directly without store()
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension(); // Generate unique filename
            $imagePath = 'images/whylearn/' . $imageName;
            $request->image->move(public_path('images/whylearn/'), $imageName); // Save to /public/uploads/testimonials
        } else {
            $imageName = null;
        }

        // Store data normally
        Whylearn::create([
            'title' => $request->name,
            'description' => $request->description,
            'image' => $imagePath , // Save only filename in DB
        ]);
        return redirect()->back()->with('success', 'Whylearn added successfully!');
    }


    public function  deletewhylearn(Request $request,$id){
        $freevideo = Whylearn::findorFail($id);
        $freevideo->delete();
        return redirect()->route('admin.courses.deletewhylearn')->with('danger', 'Deleted successfully!!');
    }

    public function content(){
        $datas =  Content::orderBy('id','DESC')->get();
        return view('backend.content.index',compact('datas'));
    }

    public function contentcreate(){
        return view('backend.content.create');
    }


public function contentstore(Request $request){


    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // 2MB max
    ]);


    // dd($request->all());

    // Upload the image directly without store()
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension(); // Generate unique filename
        $imagePath = 'images/content/' . $imageName;
        $request->image->move(public_path('images/content/'), $imageName); // Save to /public/uploads/testimonials
    } else {
        $imageName = null;
    }

    // Store data normally
   Content::create([
        'title' => $request->name,
        'description' => $request->description,
        'image' => $imagePath , // Save only filename in DB
    ]);



    return redirect()->back()->with('success', 'Together added successfully!');
 }
 public function  contentdelete(Request $request,$id){
        $freevideo =   Content::findorFail($id);
        $freevideo->delete();
        return redirect()->route('admin.courses.content')->with('danger', 'Content Deleted successfully!!');

    }
    public function together(){
        $datas =   Together::orderBy('id','DESC')->get();
        //   dd($datas);
            return view('backend.together.index',compact('datas'));
    }

    public function togethercreate(){
        return view('backend.together.create');
    }

     public function togetherstore(Request $request){


        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // 2MB max
        ]);


        // dd($request->all());

        // Upload the image directly without store()
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension(); // Generate unique filename
            $imagePath = 'images/together/' . $imageName;
            $request->image->move(public_path('images/together/'), $imageName); // Save to /public/uploads/testimonials
        } else {
            $imageName = null;
        }

        // Store data normally
       Together::create([
            'title' => $request->name,
            'description' => $request->description,
            'image' => $imagePath , // Save only filename in DB
        ]);



        return redirect()->back()->with('success', 'Together added successfully!');
     }

    public function about(){
        $datas =   About::orderBy('id','DESC')->get();
        //   dd($datas);
        return view('backend.about.index',compact('datas'));
    }

    public function aboutcreate(){

        return view('backend.about.create');
    }
     public function aboutdelete($id){
        $datas=  About::findorFail($id);
        $datas->delete();
        return redirect()->route('backend.about.index')->with('danger', 'Your About Deleted successfully!!');
     }



    public function  aboutstore(Request $request){


        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // 2MB max
        ]);


        // dd($request->all());

        // Upload the image directly without store()
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension(); // Generate unique filename
            $imagePath = 'images/about/' . $imageName;
            $request->image->move(public_path('images/about/'), $imageName); // Save to /public/uploads/testimonials
        } else {
            $imageName = null;
        }

        // Store data normally
       About::create([
            'title' => $request->name,
            'description' => $request->description,
            'image' => $imagePath , // Save only filename in DB
        ]);



        return redirect()->back()->with('success', 'About added successfully!');

    }



    public function  services(){

        $datas =   Service::orderBy('id','DESC')->get();
    //   dd($datas);
        return view('backend.services.index',compact('datas'));
    }

    public function  createservices(){


        return view('backend.services.create');

    }


    public function  storeservices(Request $request){


        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // 2MB max
        ]);


        // dd($request->all());

        // Upload the image directly without store()
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension(); // Generate unique filename
            $imagePath = 'images/services/' . $imageName;
            $request->image->move(public_path('images/services/'), $imageName); // Save to /public/uploads/testimonials
        } else {
            $imageName = null;
        }

        // Store data normally
        Service::create([
            'title' => $request->name,
            'description' => $request->description,
            'image' => $imagePath , // Save only filename in DB
        ]);



        return redirect()->back()->with('success', 'Whylearn added successfully!');

    }


    public function deleteservices(Request $request,$id){
        // dd($request->id);
        $freevideo =  Service::findorFail($id);
        $freevideo->delete();
        return redirect()->route('admin.courses.services')->with('danger', 'Your Services Deleted successfully!!');
      }


    public function storefreevideos(Request $request){
        //    dd( $request->all());
            $data =   new Freevideo;
            $data->video = $request->video;
            $data->freevideoscategory_id = $request->category_id;
            $data->save();
            return redirect()->route('admin.courses.freevideos')->with('success', 'Video submitted successfully!!');
        }


    public function createfreevideos(){
        $categories =   Freevideoscategory::orderBy('id','DESC')->get();
        return view('backend.videos.create',compact('categories'));

    }

    public function deletefreevideos(Request $request,$id){
      // dd($request->id);
      $freevideo =  Freevideo::findorFail($id);
      $freevideo->delete();
      return redirect()->route('admin.courses.freevideos')->with('danger', 'Your Free videos successfully!!');
    }



    public function supporter(){
        $supporters = Supporter::orderBy('id', 'DESC')->get();
        // dd($supporters);
        return view('backend.supporters.index', compact('supporters'));
    }
    public function supportercreate(){
        return view('backend.supporters.create');
    }

    public function supporterdelete(Request $request,$id){

        // dd($request->id);
       $supporter =  Supporter::findorFail($id);
       $supporter->delete();

       return redirect()->route('admin.courses.supporter')->with('danger', 'Your Supporter successfully!!');



    }

    public function supporterstore(Request $request){

        // return view('backend.supporters.create');

        $validator = Validator::make($request->all(), [

            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,webp',

        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        if ($request->hasFile('banner')) {

            $image_file = $request->file('banner');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/supporter/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name       = $img_gen . '.' . $image_ext;
                $thumbnil_image = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }
        }
        $supporter = Supporter::create([
            'image'       => $thumbnil_image ?? null,
        ]);
        return redirect()->route('admin.courses.supporter')->with('success', 'Your courses submitted successfully!!');
    }

    public function courses() {
        $courses = Course::orderBy('id', 'desc')->where('category_id', '>', 0)->get();
        // ->where('ebook_id',null)

        return view('backend.courses.index', compact('courses'));
    }


    public function create() {
        $data                = [];
        $data['categories']  = QuizCategory::all();
        // $data['instructors'] = Instructor::where('status', 1)->get();

        return view('backend.courses.create', $data);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'course_name'    => 'required',
            'category_id'    => 'required',
            'subcategory_id' => 'required',
        ]);
        // 'details'        => 'required',
        // 'price'          => 'required',
        // 'thumbnil_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
        // 'details_file'   => 'nullable|mimes:pdf',
        // 'instructor'     => 'required',
        // 'buy' => 'required',
        // 'level' => 'nullable',

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        // if ($request->hasFile('thumbnil_image')) {
        //     $image_file = $request->file('thumbnil_image');
        //     if ($image_file) {

        //         $img_gen   = hexdec(uniqid());
        //         $image_url = 'images/course/';
        //         $image_ext = strtolower($image_file->getClientOriginalExtension());

        //         $img_name       = $img_gen . '.' . $image_ext;
        //         $thumbnil_image = $image_url . $img_gen . '.' . $image_ext;
        //         $image_file->move($image_url, $img_name);
        //     }
        // }

        // if ($request->hasFile('certificate_image')) {
        //     $certificate_image_file = $request->file('certificate_image');
        //     if ($certificate_image_file) {

        //         $img_gen   = hexdec(uniqid());
        //         $image_url = 'images/courses/certificate/';
        //         $image_ext = strtolower($certificate_image_file->getClientOriginalExtension());

        //         $img_name          = $img_gen . '.' . $image_ext;
        //         $certificate_image = $image_url . $img_gen . '.' . $image_ext;
        //         $certificate_image_file->move($image_url, $img_name);
        //     }
        // }

        // if ($request->hasFile('details_file')) {
        //     $image_file = $request->file('details_file');
        //     if ($image_file) {

        //         $img_gen   = hexdec(uniqid());
        //         $image_url = 'images/courses/';
        //         $image_ext = strtolower($image_file->getClientOriginalExtension());

        //         $img_name     = $img_gen . '.' . $image_ext;
        //         $details_file = $image_url . $img_gen . '.' . $image_ext;
        //         $image_file->move($image_url, $img_name);
        //     }
        // }

        $course = Course::create([
            'category_id'          => $request->category_id,
            'subcategory_id'       => $request->subcategory_id,
            'status'             => $request->status ? true : false,
            'name'                 => $request->course_name,
        ]);
        // 'instructor_id'        => $request->instructor,
        // 'childcategory_id'     => $request->childcategory_id,
        // 'childsubcategory_id'  => $request->childsubcategory_id,
        // 'buy'                =>   $request->buy,
        // 'level'                => $request->level,
        // 'price'                => $request->price - $request->discount_price,
        // 'old_price'            => $request->price,
        // 'discount'             => $request->discount,
        // 'discount_price'       => $request->discount_price,
        // 'instructor_commision' => $request->instructor_commision,
        // 'details'              => $request->details,
        // 'details_file'         => $details_file ?? null,
        // 'thumbnil_image'       => $thumbnil_image ?? null,
        // 'certificate_image'    => $certificate_image ?? null,
        // 'certificate_text'     => $request->certificate_text,
        // 'featured'             => $request->featured ? true : false,
        // 'favorite'             => $request->favorite ? true : false,
        // 'common'               => $request->common ? true : false,

        // foreach($request->questions as $index=>$question){
        //     if($question){
        //         $faqs = Faq::create([
        //             'course_id' => $course->id,
        //             'question'  => $question,
        //             'answer'    => $request->answers[$index]
        //         ]);
        //     }
        // }
        return redirect()->route('admin.courses.index')->with('success', 'Your course submitted successfully!!');
    }

    public function edit($id) {
        $course      = Course::where('id', $id)->first();
        $categories  = QuizCategory::all();
        $sub         = QuizSubCategory::where('id', $course->subcategory_id)->first();

        // $child       = Childcategory::where('id', $course->childcategory_id)->where('status', 1)->get();
        // $childsub    = Childsubcategory::where('id', $course->childsubcategory_id)->where('status', 1)->get();
        // $instructors = Instructor::where('status', 1)->get();

        return view('backend.courses.edit', compact('course', 'categories', 'sub'));
        // , 'child', 'childsub', 'instructors'
    }

    public function update(Request $request, $id) {
        $course    = Course::where('id', $id)->first();
        $validator = Validator::make($request->all(), [
            'course_name'    => 'required',
            'category_id'    => 'required',
            'subcategory_id' => 'required'
        ]);
        // 'details'        => 'required',
        // 'price'          => 'required',
        // 'thumbnil_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        // 'details_file'   => 'nullable|mimes:pdf',
        // 'syllabus_file'   => 'nullable|mimes:pdf',
        // 'buy' => 'required',
        // 'level' => 'nullable',

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        // if ($request->hasFile('thumbnil_image')) {
        //     $image_file = $request->file('thumbnil_image');
        //     if ($image_file) {

        //         if ($course->thumbnil_image) {
        //             $thumbnil_image_image_path = public_path($course->thumbnil_image);

        //             if (File::exists($thumbnil_image_image_path)) {
        //                 File::delete($thumbnil_image_image_path);
        //             }
        //         }
        //         $img_gen   = hexdec(uniqid());
        //         $image_url = 'images/courses/';
        //         $image_ext = strtolower($image_file->getClientOriginalExtension());

        //         $img_name       = $img_gen . '.' . $image_ext;
        //         $thumbnil_image = $image_url . $img_gen . '.' . $image_ext;

        //         $image_file->move($image_url, $img_name);
        //         $course->update(['thumbnil_image' => $thumbnil_image]);
        //     }
        // }

        // if ($request->hasFile('certificate_image')) {
        //     $certificate_image_file = $request->file('certificate_image');
        //     if ($certificate_image_file) {

        //         if ($course->certificate_image) {
        //             $certificate_image_image_path = public_path($course->certificate_image);

        //             if (File::exists($certificate_image_image_path)) {
        //                 File::delete($certificate_image_image_path);
        //             }
        //         }
        //         $img_gen   = hexdec(uniqid());
        //         $image_url = 'images/courses/certificate/';
        //         $image_ext = strtolower($certificate_image_file->getClientOriginalExtension());

        //         $img_name          = $img_gen . '.' . $image_ext;
        //         $certificate_image = $image_url . $img_gen . '.' . $image_ext;

        //         $certificate_image_file->move($image_url, $img_name);
        //         $course->update(['certificate_image' => $certificate_image]);
        //     }
        // }

        // if ($request->hasFile('details_file')) {
        //     $image_file = $request->file('details_file');
        //     if ($image_file) {

        //         if ($course->details_file) {
        //             $details_file_image_path = public_path($course->details_file);

        //             if (File::exists($details_file_image_path)) {
        //                 File::delete($details_file_image_path);
        //             }
        //         }
        //         $img_gen   = hexdec(uniqid());
        //         $image_url = 'images/courses/';
        //         $image_ext = strtolower($image_file->getClientOriginalExtension());

        //         $img_name     = $img_gen . '.' . $image_ext;
        //         $details_file = $image_url . $img_gen . '.' . $image_ext;

        //         $image_file->move($image_url, $img_name);
        //         $course->update(['details_file' => $details_file]);
        //     }
        // }

        //     if ($request->hasFile('syllabus_file')) {
        //     $pdf_file = $request->file('syllabus_file');
        //     if ($pdf_file) {
        //
        //         if ($course->syllabus_file) {
        //             $syllabus_file_path = public_path($course->syllabus_file);

        //             if (File::exists($syllabus_file_path)) {
        //                 File::delete($syllabus_file_path);
        //             }
        //         }
        //         $file_name   = hexdec(uniqid()) . '.' . strtolower($pdf_file->getClientOriginalExtension());
        //         $upload_path = 'images/courses/';
        //         $file_path   = $upload_path . $file_name;

        //         $pdf_file->move($upload_path, $file_name);
        //         $course->update(['syllabus_file' => $file_path]);
        //     }
        // }

        // if ($request->hasFile('syllabus_files')) {
        //     foreach ($request->file('syllabus_files') as $file) {
        //         if ($file) {
        //             $file_name   = hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
        //             $upload_path = 'images/courses/';
        //             $file_path   = $upload_path . $file_name;

        //             $file->move($upload_path, $file_name);

        //             CourseSyllabusFile::create([
        //                 'course_id' => $course->id,
        //                 'file_path' => $file_path,
        //             ]);
        //         }
        //     }
        // }

        $course->update([
            'category_id'        => $request->category_id,
            'subcategory_id'     => $request->subcategory_id,
            'name'               => $request->course_name,
            'status'             => $request->status ? true : false,
        ]);
        // 'childcategory_id'     => $request->childcategory_id,
        // 'childsubcategory_id'  => $request->childsubcategory_id,
        // 'price'                => $request->price - $request->discount_price,
        // 'old_price'            => $request->price,
        // 'buy'                =>   $request->buy,
        // 'level'                => $request->level,
        // 'discount'             => $request->discount,
        // 'discount_price'       => $request->discount_price,
        // 'instructor_commision' => $request->instructor_commision,
        // 'details'              => $request->details,
        // 'certificate_text'     => $request->certificate_text,
        // 'featured'             => $request->featured ? true : false,
        // 'favorite'             => $request->favorite ? true : false,
        // 'common'               => $request->common ? true : false,

        // foreach($request->questions as $index=>$question){
        //     if($question){
        //         $faqs = Faq::create([
        //             'course_id' => $course->id,
        //             'question'  => $question,
        //             'answer'    => $request->answers[$index]
        //         ]);

        //     }
        // }
        return to_route('admin.courses.index')->with('success', 'Your course updated successfully!!');
    }

    public function active(Request $request, $id) {
        $course = Course::findOrFail($id);

        $course->status = 1;
        $course->save();

        return redirect()->route('admin.courses.index')->with('success', 'Course activated successfully!!');
    }

    public function inactive(Request $request, $id) {
        $course = Course::findOrFail($id);

        $course->status = 0;
        $course->save();

        return redirect()->route('admin.courses.index')->with('success', 'Course inactivated successfully!!');
    }


    public function reviewactive(Request $request, $id) {
        $review = Review::findOrFail($id);

        $review->status = 1;
        $review->save();

        return redirect()->route('admin.courses.review')->with('success', 'Review inactivated successfully!!');
    }


    public function reviewinactive(Request $request, $id) {
        $review  = Review::findOrFail($id);

        $review->status = 0;
        $review->save();

        return redirect()->route('admin.courses.review')->with('success', 'Review inactivated successfully!!');
    }

    public function delete($id) {
        $author = Author::where('course_id', $id)->delete();

        $course = Course::where('id', $id)
        ->with('modules.lessons.videos', 'modules.lessons.quizzes')
        ->first();

        if ($course) {
            $moduleIds = [];
            $lessonIds = [];
            $videoIds = [];
            $quizIds = [];

            // Loop through modules
            foreach ($course->modules as $module) {
                $moduleIds[] = $module->id;

                // Loop through lessons
                foreach ($module->lessons as $lesson) {
                    $lessonIds[] = $lesson->id;

                    // Get related video IDs
                    foreach ($lesson->videos as $video) {
                        $videoIds[] = $video->id;
                    }
                    // Get related quiz IDs
                    // foreach ($lesson->quizzes as $quiz) {
                    //     $quizIds[] = $quiz->id;

                    //     // Delete related quiz options first
                    //     QuizOption::where('quiz_id', $quiz->id)->delete();
                    // }
                }
            }
            // foreach ($quizIds as $quiz) {
            //     Quiz::find($quiz)->delete();
            // }
            foreach ($videoIds as $video) {
                Video::find($video)->delete();
            }

            foreach ($lessonIds as $lesson) {
                Lesson::find($lesson)->delete();
            }

            foreach ($moduleIds as $module) {
                Module::find($module)->delete();
            }
            if ($course->syllabus_file) {
                $syllabus_file_path = public_path($course->syllabus_file);

                if (File::exists($syllabus_file_path)) {
                    File::delete($syllabus_file_path);
                }
            }
            if ($course->details_file) {
                $details_file_image_path = public_path($course->details_file);

                if (File::exists($details_file_image_path)) {
                    File::delete($details_file_image_path);
                }
            }
            if ($course->certificate_image) {
                $certificate_image_image_path = public_path($course->certificate_image);

                if (File::exists($certificate_image_image_path)) {
                    File::delete($certificate_image_image_path);
                }
            }
            if ($course->thumbnil_image) {
                $thumbnil_image_image_path = public_path($course->thumbnil_image);

                if (File::exists($thumbnil_image_image_path)) {
                    File::delete($thumbnil_image_image_path);
                }
            }
            $course->delete();
        }
        // Redirect back with success message
        return redirect()->back()->with('success', 'Course deleted successfully');
    }

    public function modules($id) {
        $course  = Course::find($id);
        $modules = Module::where('course_id', $id)->get();

        return view('backend.courses.modules', compact('modules', 'course'));
    }

    public function addmodule($id) {
        $course = Course::find($id);

        return view('backend.courses.module-add', compact('course'));
    }

    public function modulestore(Request $request) {
        $validator = Validator::make($request->all(), [
            'names' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        foreach ($request->names as $key => $name) {

            if ($name) {
                $image_file   = null;
                $module_image = null;

                if (isset($request->images[$key])) {
                    $image_file = $request->images[$key];
                }

                if ($image_file) {

                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/modules/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());

                    $img_name     = $img_gen . '.' . $image_ext;
                    $module_image = $image_url . $img_gen . '.' . $image_ext;

                    $image_file->move($image_url, $img_name);
                }

                Module::create([
                    'course_id'   => $request->course_id,
                    'name'        => $name,
                    'description' => $request->descriptions[$key],
                    'image'       => $module_image,
                ]);
            }

        }

        return redirect()->route('admin.courses.modules', $request->course_id)->with('Modules added successfully!!');
    }

    public function moduleedit($id) {
        $module = Module::find($id);

        return view('backend.courses.module-edit', compact('module'));
    }

    public function moduleupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $image_file   = $request->image;
        $module_image = null;

        if ($image_file) {

            $img_gen   = hexdec(uniqid());
            $image_url = 'images/modules/';
            $image_ext = strtolower($image_file->getClientOriginalExtension());

            $img_name     = $img_gen . '.' . $image_ext;
            $module_image = $image_url . $img_gen . '.' . $image_ext;

            $image_file->move($image_url, $img_name);
        }

        $module = Module::find($request->module_id);
        $module->update([
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => $module_image,
        ]);

        return redirect()->route('admin.courses.modules', $module->course_id)->with('success', 'Module updated successfully');
    }

    public function moduledelete(Request $request) {
        Module::find($request->module_id)->delete();

        return redirect()->back()->with('success', 'Module deleted successfully');
    }

    public function lessons($id) {

        $module  = Module::find($id);
        $lessons = Lesson::where('module_id', $id)->get();

        return view('backend.courses.lessons', compact('lessons', 'module'));
    }

    public function lessonadd($id) {
        $module = Module::find($id);

        return view('backend.courses.lesson-add', compact('module'));
    }

    public function lessonstore(Request $request) {
        $validator = Validator::make($request->all(), [
            'names' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        foreach ($request->names as $key => $name) {

            if ($name) {
                $image_file   = null;
                $lesson_image = null;

                if (isset($request->images[$key])) {
                    $image_file = $request->images[$key];
                }

                if ($image_file) {

                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/lessons/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());

                    $img_name     = $img_gen . '.' . $image_ext;
                    $lesson_image = $image_url . $img_gen . '.' . $image_ext;

                    $image_file->move($image_url, $img_name);
                }

                Lesson::create([
                    'module_id'   => $request->module_id,
                    'name'        => $name,
                    'description' => $request->descriptions[$key],
                    'image'       => $lesson_image,
                ]);
            }

        }

        return redirect()->route('admin.courses.module.lessons', $request->module_id)->with('Lessons added successfully!!');
    }

    public function lessonedit($id) {
        $lesson = Lesson::find($id);

        return view('backend.courses.lesson-edit', compact('lesson'));
    }

    public function add_pdf($id){
        $lesson = Lesson::find($id);
        $pdfs = DB::table('pdf')->where('lession_id',$id)->get();
        return view('backend.courses.add_pdf',compact('lesson','pdfs'));
    }

    public function add_pdf_page($id){
        $lesson = Lesson::find($id);
        return view('backend.courses.pdf_add_page', compact('lesson'));
    }

    public function pdf_add_post(Request $request){

        $validated = $request->validate([
            'lesson_id' => 'required|integer',
            'pdf' => 'required|mimes:pdf|max:2048', // Max 2MB
            'status'=>'required',
        ]);
        $lesson = Lesson::find($request->lesson_id);

        if ($request->hasFile('pdf')) {

            $pdf_gen = hexdec(uniqid());

            $pdf_url = 'pdf/lessons/';

            $pdf_ext = strtolower($request->file('pdf')->getClientOriginalExtension());

            $pdf_name = $lesson->name . $pdf_gen . '.' . $pdf_ext;
            $pdf_full_path = $pdf_url . $pdf_name;

            $request->file('pdf')->move($pdf_url, $pdf_name);

            DB::table('pdf')->insert([
                'lession_id' => $request->input('lesson_id'),
                'pdf' => $pdf_full_path,

                'status'=>$request->status,

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return redirect()->route('admin.courses.module.add_pdf', $request->lesson_id)->with('PDF added successfully!!');
    }

    public function pdf_edit_post(Request $request){

           $pdf = DB::table('pdf')->where('id',$request->pdf_id)->first();
           $lesson = Lesson::find($pdf->lession_id);

         if($request->hasFile('pdf')){

            if ($pdf) {


               $existingPdfPath = public_path($pdf->pdf);


        if (file_exists($existingPdfPath)) {

           unlink($existingPdfPath);
        }

       $pdf_gen = hexdec(uniqid());
        $pdf_url = 'pdf/lessons/';


        $pdf_ext = strtolower($request->file('pdf')->getClientOriginalExtension());


        $pdf_name = $lesson->name . $pdf_gen . '.' . $pdf_ext;
        $pdf_full_path = $pdf_url . $pdf_name;


        $request->file('pdf')->move($pdf_url, $pdf_name);
           DB::table('pdf')->where('id', $request->pdf_id)->update([
        'pdf' => $pdf_full_path,
        'status' => $request->status,
        'updated_at' => now(),
        ]);
    }
         return back()->with('success',"Successfully Changed");


         }
         else{
               DB::table('pdf')->where('id', $request->pdf_id)->update([

                  'status' => $request->status,
                  'updated_at' => now(),
                 ]);

             return back()->with('success',"Successfylly Changed The status");
         }



     }
     public function delete_pdf($id){

          DB::table('pdf')->where('id', $id)->delete();

          return back()->with('success', 'successfully deleted');

     }

    public function lessonupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $image_file   = $request->image;
        $lesson_image = null;

        if ($image_file) {

            $img_gen   = hexdec(uniqid());
            $image_url = 'images/lessons/';
            $image_ext = strtolower($image_file->getClientOriginalExtension());

            $img_name     = $img_gen . '.' . $image_ext;
            $lesson_image = $image_url . $img_gen . '.' . $image_ext;

            $image_file->move($image_url, $img_name);
        }

        $lesson = Lesson::find($request->lesson_id);
        $lesson->update([
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => $lesson_image,
        ]);

        return redirect()->route('admin.courses.module.lessons', $lesson->module_id)->with('success', 'Lesson updated successfully');
    }

    public function lessondelete(Request $request) {
        Lesson::find($request->lesson_id)->delete();

        return redirect()->back()->with('success', 'lesson deleted successfully');
    }

    public function videos($id) {
        $lesson = Lesson::find($id);
        $videos = Video::where('lesson_id', $id)->get();

        return view('backend.courses.videos', compact('lesson', 'videos'));
    }

    public function videoadd($id) {
        $lesson = Lesson::find($id);

        return view('backend.courses.video-add', compact('lesson'));
    }


    public function videostore(Request $request) {
        $validator = Validator::make($request->all(), [
            'names' => 'required',
            'links' => 'required',

        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        foreach ($request->names as $key => $name) {

            if ($name) {
                $image_file  = null;
                $video_image = null;

                if (isset($request->images[$key])) {
                    $image_file = $request->images[$key];
                }

                if ($image_file) {

                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/videos/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());

                    $img_name    = $img_gen . '.' . $image_ext;
                    $video_image = $image_url . $img_gen . '.' . $image_ext;

                    $image_file->move($image_url, $img_name);
                }

                Video::create([
                    'lesson_id' => $request->lesson_id,
                    'name'      => $name,
                    'link'      => $request->links[$key],
                   'free'      => isset($request->frees[$key]) ? 1 : 0,
                    'image'     => $video_image,
                ]);
            }

        }

        return redirect()->route('admin.courses.module.lesson.videos', $request->lesson_id)->with('Videos added successfully!!');
    }

    public function videoedit($id) {
        $video = Video::find($id);

        return view('backend.courses.video-edit', compact('video'));
    }

    // public function videoupdate(Request $request) {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         // 'link' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return back()->with('error', $validator->messages()->first())->withInput();
    //     }

    //     $image_file  = $request->image;

    //     $video_image = null;

    //     if ($image_file) {

    //         $img_gen   = hexdec(uniqid());
    //         $image_url = 'images/videos/';
    //         $image_ext = strtolower($image_file->getClientOriginalExtension());

    //         $img_name    = $img_gen . '.' . $image_ext;
    //         $video_image = $image_url . $img_gen . '.' . $image_ext;

    //         $image_file->move($image_url, $img_name);
    //          $video->image = $video_image;
    //     }

    //     $video = Video::find($request->video_id);
    //     $video->update([
    //         'name'  => $request->name,
    //         'link'  => $request->link,
    //         'free'  => $request->free ? true : false,
    //         'image' => $video_image ?? null,
    //     ]);

    //     return redirect()->route('admin.courses.module.lesson.videos', $video->lesson_id)->with('success', 'Video updated successfully');
    // }

    public function videoupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $video = Video::find($request->video_id);
        if (!$video) {
            return back()->with('error', 'Video not found!');
        }

        $video_image = $video->image; // default to old image

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');

            $img_gen   = hexdec(uniqid());
            $image_url = 'images/videos/';
            $image_ext = strtolower($image_file->getClientOriginalExtension());

            $img_name    = $img_gen . '.' . $image_ext;
            $video_image = $image_url . $img_name;

            $image_file->move(public_path($image_url), $img_name);
        }

        $video->update([
            'name'  => $request->name,
            'link'  => $request->link,
            'free'  => $request->has('free'),
            'image' => $video_image,
        ]);

        return redirect()->route('admin.courses.module.lesson.videos', $video->lesson_id)->with('success', 'Video updated successfully');
    }

    public function videodelete(Request $request) {
        Video::find($request->video_id)->delete();

        return redirect()->back()->with('success', 'Video deleted successfully');
    }

    //EXAM
    public function exam(){
        $quizzes = Quiz::where('exam_status', 1)->get();
        // where('lesson_id', null)->
        return view('backend.exams.index', compact( 'quizzes'));
    }


    public function addexam(){
        $quizcategory =  QuizCategory::all();
        $quizsubcategory = QuizSubCategory::all();
        return view('backend.exams.create',compact('quizcategory','quizsubcategory'));
    }


    public function examquestionadd($id){
        $quiz = Quiz::find($id);
        return view('backend.exams.questionadd',compact('quiz'));
    }

    public function examquestionstore(Request $request){
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'options'  => 'required',
            'answer'   => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->messages()->first());
        }

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/questions/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name = $img_gen . '.' . $image_ext;
                $image    = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }
        }
        $question = McqQuestion::create([
            'quiz_id'  => $request->quiz_id,
            'question' => $request->question,
            'answer'   => $request->answer,
            'image'    => $image ?? null,
            'explanation'   => $request->explanation,
        ]);
        foreach ($request->options as $key => $option) {
            if ($option) {
                McqOption::create([
                    'quiz_id'     => $request->quiz_id,
                    'mcq_ques_id' => $question->id,
                    'option'      => $request->options[$key],
                    'isAnswer'    => $request->answer == $key + 1 ? true : false,
                ]);
            }
        }
        return redirect()->route('admin.courses.exam.questions')->with('success', 'Question added successfully!!');
    }

    public function examsubcatgeory() {
        $categories = QuizSubCategory::orderBy('id','DESC')->get();
        return view('backend.exams.examsubcategory', compact('categories'));
    }

    public function createexamsubcatgeory(){
        $categories = QuizCategory::orderBy('id','DESC')->get();
        return view('backend.exams.createexamsubcatgeory',compact('categories'));
    }

    public function storeexamsubcatgeory(Request $request){

        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:quizsubcategories',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif',
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }
        if ($request->hasFile('image')) {
            $image_file = $request->file('image');

            if ($image_file) {
                $img_gen   = hexdec(uniqid());

                $image_url = 'images/quizsubcategory/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }
        }
        $category_id = $request->input('category_id');

        QuizSubCategory::create([
            'name'        => $request->name,
            'image'       => isset($final_name1) ? $final_name1 : null,
            'category_id' => $category_id,
        ]);
        return to_route('admin.courses.examsubcatgeory')->with('success','New data added successfully!!');
    }

    public function updateexamsubcatgeory(Request $request, $id) {
        $category = QuizSubCategory::findOrFail($id); // Fix: You need to fetch the category

        $validator = Validator::make($request->all(), [
            'name'  => 'required' ,
            'image' => 'nullable|mimes:jpg,jpeg,png,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $final_name1 = $category->image; // default to old image

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');

            if ($image_file) {
                $image_path = public_path($category->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/quizsubcategory/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_name;

                $image_file->move(public_path($image_url), $img_name);
            }
        }

        $category->update([
            'name'  => $request->name,
            'image' => $final_name1,
            'category_id' => $request->category_id,  // Store the category_id
        ]);

        return to_route('admin.courses.examsubcatgeory')->with('success','Data updated successfully!!');
    }

    public function editexamsubcatgeory(Request $request, $id){
        $categories = QuizCategory::orderBy('id','DESC')->get();

        $category = QuizSubCategory::findOrFail($id);
        return view('backend.exams.editexamsubcatgeory', compact('category','categories'));
    }

    public function  deleteexamsubcatgeory(Request $request, $id) {
        $subcatgeory =   QuizSubCategory::findorFail($id);
        $image_path = public_path($subcatgeory->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $subcatgeory->delete();
        return to_route('admin.courses.examsubcatgeory')->with('success','Data Deleted successfully!!');
    }

    public function examcatgeory() {
        $categories = QuizCategory::orderBy('id','DESC')->get();
        return view('backend.exams.examcategory',compact('categories'));
    }

    public function createexamcatgeory() {
        return view('backend.exams.createexamcatgeory');
    }

    public function editexamcatgeory(Request $request,$id){
        $category = QuizCategory::findOrFail($id);
        return view('backend.exams.editexamcatgeory',compact('category'));
    }


    public function storeexamcatgeory(Request $request){
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/quizcategory/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }
        }
        QuizCategory::create([
            'name'        => $request->name,
            'image'       => isset($final_name1) ? $final_name1 : null,
        ]);
        return to_route('admin.courses.examcatgeory')->with('success','New data added successfully!!');
    }


    public function updateexamcatgeory(Request $request, $id) {
        $category = QuizCategory::findOrFail($id); // Fix: You need to fetch the category

        $validator = Validator::make($request->all(), [
            'name'  => 'required' ,
            'image' => 'nullable|mimes:jpg,jpeg,png,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $final_name1 = $category->image; // default to old image

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');

            if ($image_file) {
                $image_path = public_path($category->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/quizcategory/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_name;

                $image_file->move(public_path($image_url), $img_name);
            }
        }

        $category->update([
            'name'  => $request->name,
            'image' => $final_name1,
        ]);

        return to_route('admin.courses.examcatgeory')->with('success','Data updated successfully!!');
    }


    public function  deleteexamcatgeory(Request $request, $id) {
        $catgeory =   QuizCategory::findorFail($id);
        $image_path = public_path($catgeory->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $catgeory->delete();
        return to_route('admin.courses.examcatgeory')->with('success','Data Deleted successfully!!');
    }


    public function storeexam(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'timer' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'passingscore' => 'required|max:100',
            // 'pdfs.*' => 'required|mimes:pdf|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }
        // foreach ($request->names as $key => $name) {
        //     if ($name) {
        //         $image_file = null;
        //         $quiz_image = null;

        //         if (isset($request->images[$key])) {
        //             $image_file = $request->images[$key];
        //         }

        //         $pdf_path = null;
        //         if (isset($request->pdfs[$key])) {
        //             // Get the file from the request
        //             $pdf = $request->file('pdfs')[$key];

        //             // Generate a unique name for the PDF using timestamp and original extension
        //             $pdf_name = 'quiz_' . time() . '_' . uniqid() . '.' . $pdf->getClientOriginalExtension();

        //             // Specify the destination path for storing the PDF
        //             $destinationPath = public_path('images/quizpdf/');

        //             // Ensure the destination directory exists
        //             if (!file_exists($destinationPath)) {
        //                 mkdir($destinationPath, 0777, true); // Create directory if it doesn't exist
        //             }

        //             // Move the uploaded file to the desired location
        //             $pdf->move($destinationPath, $pdf_name);

        //             // Set the path to the uploaded file
        //             $pdf_path = '/images/quizpdf/' . $pdf_name;
        //         }
        //     }
        // }
        Quiz::create([
            'lesson_id' => $request->lesson_id ?? null,
            'exam_status' => $request->exam_status,
            'name'      => $request->name,
            'timer'     => $request->timer,
            // 'amount' => $request->amount[$key],
            'passingscore' => $request->passingscore ?? null,
            'passingpoint' => $request->passingpoint ?? null,
            // 'pdf' => $pdf_path,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'inside_routine' => $request->inside_routine ? 1 : 0,
            'release_date' => $request->release_date ?? now()->format('Y-m-d'),
            'negative_mark' => $request->negative_mark
        ]);
        return redirect()->route('admin.courses.exam')->with('success','Exam created successfully!!');
    }

    //    examquestions
    public function examquestions($id) {
        $quiz = Quiz::find($id);

        $questions = McqQuestion::with('options')->where('quiz_id', $id)->get();

        return view('backend.exams.questions', compact('quiz', 'questions'));
    }
    //Exam Ends

    //  section
    public function quizzes($id) {
        $lesson  = Lesson::find($id);
        $quizzes = Quiz::where('lesson_id', $id)->get();

        return view('backend.courses.quizzes', compact('lesson', 'quizzes'));
    }

    public function quizadd($id) {
        $lesson = Lesson::find($id);

        return view('backend.courses.quiz-add', compact('lesson'));
    }

    public function quizzestore(Request $request) {
        $validator = Validator::make($request->all(), [
            'names' => 'required',
            'timer' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        foreach ($request->names as $key => $name) {

            if ($name) {
                $image_file = null;
                $quiz_image = null;

                if (isset($request->images[$key])) {
                    $image_file = $request->images[$key];
                }

                Quiz::create([
                    'lesson_id' => $request->lesson_id,
                    'name'      => $name,
                    'timer'     => $request->timer[$key],
                ]);
            }
        }
        return redirect()->route('admin.courses.module.lesson.quizzes', $request->lesson_id)->with('Videos added successfully!!');
    }

    public function quizedit($id) {
        $quiz = Quiz::find($id);
        $quizcategory =  QuizCategory::all();
        $quizsubcategory = QuizSubCategory::all();
        return view('backend.courses.quiz-edit', compact('quiz','quizcategory','quizsubcategory'));
    }

    public function quizupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'timer' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'passingscore' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $quiz = Quiz::find($request->quiz_id);
        // Handle PDF upload if provided
        if ($request->hasFile('pdf')) {

            $pdf_file = $request->file('pdf');
            $pdf_name = time() . '_' . uniqid() . '.' . $pdf_file->getClientOriginalExtension();
            $pdf_path = '/images/quizpdf/' . $pdf_name;

            // Save the PDF file to public/images/quizpdf/
            $pdf_file->move(public_path('images/quizpdf'), $pdf_name);

            $quiz->pdf = $pdf_path; // Assuming `pdf` is the column name in your `quizzes` table
        }

        $quiz->update([
            'name'  => $request->name,
            'timer' => $request->timer,
            'lesson_id' => $request->lesson_id ?? null,
            'exam_status' => $request->exam_status,
            // 'amount' => $request->amount[$key],
            'passingscore' => $request->passingscore ?? null,
            'passingpoint' => $request->passingpoint ?? null,
            // 'pdf' => $pdf_path,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'inside_routine' => $request->inside_routine ? 1 : 0,
            'release_date' => $request->release_date ?? now()->format('Y-m-d'),
            'negative_mark' => $request->negative_mark
        ]);
        // return redirect()->route('admin.courses.module.lesson.quizzes', $quiz->lesson_id)->with('success', 'Quiz updated successfully');
        return redirect()->route('admin.courses.exam')->with('success', 'Quiz updated successfully');
    }

    public function quizdelete(Request $request) {
        Quiz::find($request->quiz_id)->delete();

        return redirect()->back()->with('success', 'Quiz deleted successfully');
    }

// quiz section ended

    // McqQuestion section
    public function questions($id) {
        $quiz = Quiz::find($id);

        $questions = McqQuestion::with('options')->where('quiz_id', $id)->get();

        return view('backend.courses.questions', compact('quiz', 'questions'));
    }

    public function questionadd($id) {
        $quiz = Quiz::find($id);

        return view('backend.courses.question-add', compact('quiz'));
    }

    public function questionstore(Request $request) {
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'options'  => 'required',
            'answer'   => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->messages()->first());
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/questions/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name = $img_gen . '.' . $image_ext;
                $image    = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        $question = McqQuestion::create([
            'quiz_id'  => $request->quiz_id,
            'question' => $request->question,
            'answer'   => $request->answer,
            'image'    => $image ?? null,
        ]);

        foreach ($request->options as $key => $option) {

            if ($option) {
                McqOption::create([
                    'quiz_id'     => $request->quiz_id,
                    'mcq_ques_id' => $question->id,
                    'option'      => $request->options[$key],
                    'isAnswer'    => $request->answer == $key + 1 ? true : false,
                ]);
            }

        }

        return redirect()->back()->with('success', 'Question added successfully!!');
    }

    public function questionedit($id) {
        $question = McqQuestion::with('options')->find($id);

        return view('backend.courses.question-edit', compact('question'));
    }

    public function questionupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'options'  => 'required',
            'answer'   => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->messages()->first());
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/questions/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name = $img_gen . '.' . $image_ext;
                $image    = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        $question = McqQuestion::find($request->question_id);
        $question->update([
            'question' => $request->question,
            'answer'   => $request->answer,
            'image'    => $image ?? $question->image,
            'explanation' => $request->explanation,
        ]);

        foreach ($request->options as $key => $option) {
            if ($option) {
                McqOption::find($request->option_ids[$key])->update([
                    'option'   => $request->options[$key],
                    'isAnswer' => $request->answer == $key + 1 ? true : false,
                ]);
            }
        }
        return redirect()->route('admin.courses.exam.questions', $question->quiz_id)->with('success', 'McqQuestion updated successfully');
    }

    public function questiondelete(Request $request) {
        McqQuestion::find($request->question_id)->delete();
        McqOption::where('mcq_ques_id', $request->question_id)->delete();

        return redirect()->back()->with('success', 'McqQuestion deleted successfully');
    }

    // question section ended

    public function addQuiz($id) {
        $course = Course::findOrFail($id);

        return view('backend.courses.add-quiz', compact('id', 'course'));
    }

    public function storeQuiz(Request $request, $id) {

        if (!$this->checkValidity($id)) {
            return back()->withToastInfo('Oops! You are going to die.');
        }

        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'point' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $quiz = Quiz::create([
            'instructor_id' => auth()->guard('instructor')->user()->id,
            'course_id'     => $id,
            'name'          => $request->name,
            'points'        => $request->point,
        ]);

        foreach ($request->option as $key => $option) {

            if ($option) {
                QuizOption::create([
                    'quiz_id'  => $quiz->id,
                    'option'   => $option,
                    'isAnswer' => $request->isAnswer[$key],
                ]);
            }

        }

        return redirect()->back()->with('success', 'Quiz added successfully!!');

    }

    public function addQuestion($id) {
        $course = Course::findOrFail($id);

        return view('backend.courses.add-question', compact('id', 'course'));
    }

    public function storeQuestion(Request $request, $id) {

        if (!$this->checkValidity($id)) {
            return back()->withToastInfo('Oops! You are going to die.');
        }

        foreach ($request->question as $key => $name) {

            if ($name) {
                Written::create([
                    'instructor_id' => auth()->guard('instructor')->user()->id,
                    'course_id'     => $id,
                    'name'          => $name,
                    'answer'        => $request->answer[$key],
                    'points'        => $request->point[$key],
                ]);
            }

        }

        return redirect()->back()->with('success', 'Question added successfully!!');

    }

    public function addAuthor($id) {
        $course = Course::findOrFail($id);

        return view('backend.courses.add-author', compact('id', 'course'));
    }

    public function storeAuthor(Request $request, $id) {

        if (!$this->checkValidity($id)) {
            return back()->withToastInfo('Oops! You are going to die.');
        }

        foreach ($request->author as $key => $name) {

            if ($name) {
                Author::create([
                    'instructor_id' => auth()->guard('instructor')->user()->id,
                    'course_id'     => $id,
                    'name'          => $name,
                    'institution'   => $request->institution[$key],
                    'designation'   => $request->designation[$key],
                ]);
            }

        }

        return redirect()->back()->with('success', 'Author added successfully!!');

    }

    public function addVideo($id) {
        $course = Course::findOrFail($id);

        return view('backend.courses.add-video', compact('id', 'course'));
    }

    public function storeVideo(Request $request, $id) {

        if (!$this->checkValidity($id)) {
            return back()->withToastInfo('Oops! You are going to die.');
        }

        foreach ($request->video as $key => $name) {

            if ($name) {
                Video::create([
                    'instructor_id' => auth()->guard('instructor')->user()->id,
                    'course_id'     => $id,
                    'name'          => $name,
                    'link'          => $request->link[$key],
                    'duration'      => $request->duration[$key],
                ]);
            }

        }

        return redirect()->back()->with('success', 'Video added successfully!!');

    }

    private function checkValidity($id) {
        $course = Course::where('id', $id)->where('instructor_id', auth()->guard('instructor')->user()->id)->first();

        if ($course) {
            $course->update(['updated_at' => now()]);

            return true;
        } else {
            return false;
        }

    }

    public function faqupdate(Request $request){
        $faq = Faq::find($request->hidden_id);

        if(!$faq){
            return redirect()->back()->with('error', 'FAQ not found');
        }

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->back()->with('success', 'FAQ updated');
    }

    public function faqdelete(Request $request){
        $faq = Faq::find($request->id);
        if(!$faq){
            return redirect()->back()->with('error', 'FAQ not found');
        }

        $faq->delete();

        return redirect()->back()->with('success', 'FAQ deleted');
    }
}
