<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\RatingReview;
use App\Models\Course;
use App\Models\Event;
use App\Models\Instructor;
use App\Models\Promovideo;
use App\Models\Student;
use App\Models\Studentbenefit;
use App\Models\Enroll;
use App\Models\Exam;
use App\Models\Quiz;
use App\Models\McqQuestion;
use App\Models\McqOption;
use App\Models\QuizsubmitAnswer;
use App\Models\Quizsubmit;
use App\Models\Review;
use App\Models\Freevideoscategory;
use App\Models\Podcastcategory;
use App\Models\Page;
use App\Models\Supporter;

use App\Models\{AboutItem, Subcategory, Slider, AboutTab, Coupon, BillingInfo, Ebook, Podcast,Module, Lesson};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Session, Auth, Hash, Log};
use Gloudemans\Shoppingcart\Facades\Cart;
use Jorenvh\Share\ShareFacade;

class FrontendController extends Controller {


    // In CourseController.php

    public function searchSuggestions(Request $request) {
        try {
            // Correct way to access the query parameter
            $query = $request->input('query'); // Use `input()` to get the query parameter

            // If no query is provided, return an error response
            if (empty($query)) {
                return response()->json(['error' => 'Query parameter is missing.'], 400);
            }

            // Search for courses by name that match the query
            $courses = Course::where('name', 'like', '%' . $query . '%')->get(['id', 'name']);

            // If no results are found, return an empty array
            if ($courses->isEmpty()) {
                return response()->json(['suggestions' => []]);
            }

            // Return the list of suggestions as JSON
            return response()->json(['suggestions' => $courses]);

        } catch (\Exception $e) {
            // Log the error and return a server error response
            Log::error('Search suggestion error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching suggestions.'], 500);
        }
    }

    //Auth
    public function register() {
        return view('frontend.auth.register');
    }

    public function login() {
        return "<h1>Please Login from Admin-Login Page</h1>";
        // return view('frontend.auth.login');
    }

    //Pages
    public function pagesdetails($pageName){
        $page =  Page::where('name',$pageName)->first();
        return view('frontend.layout.pages.pagedetails',compact('page'));
    }

    public function reviewstore(Request $request, $courseId){
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
        ]);

        // dd( $request->all());

        $course = Course::findOrFail($courseId);
        // dd($request->student_id);
        Review::create([
            'student_id' =>  $request->student_id,
            'course_id' => $course->id,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
        ]);

        return redirect()->back();
    }

    public function ebookreviewstore(Request $request, $id){

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
        ]);



        $ebook = Ebook::findOrFail($id);
        $ebookid = $ebook->id;

        // dd($ebookid );
            $review = new Review;
            $review->ebook_id = $ebookid;
            $review->student_id =  $request->student_id;
            $review->rating = $request->rating;
            $review->review_text =  $request->review_text;
            $review->save();

        return redirect()->back();

    }

    public function verify() {
        $phone = Session::get('verifyPhone');

        if (!$phone) {
            return redirect()->to('/login');
        }

        return view('frontend.auth.verify');
    }

    public function forgetpassword(){
        return view('frontend.auth.forgetpassword');
    }

    public function passwordReset(){
        $phone = Session::get('passresetPhone');

        if (!$phone) {
            return redirect()->to('/login');
        }

        return view('frontend.auth.passwordReset');
    }


    //Normal Pages
    public function index() {

        //ebooks
        $ebooks = Ebook::orderBy('id', 'DESC')->get();
        $instructors  = Instructor::orderBy('id','DESC')->limit(4)->get();
        $categories = Category::where('status', 1)->get();
        $supporters = Supporter::orderBy('id','DESC')->get();

        $populercourses = Course::where('status', 1)->latest()->get();


        $courses = Course::with('category', 'subcategory', 'childcategory', 'childsubcategory')
            ->where(['status' => 1])->latest()->get();
            $new_courses = Course::with('category', 'subcategory', 'childcategory', 'childsubcategory')
            ->where(['status' => 1])->latest()->limit(20)->get();

        $free_courses = Course::with('category', 'subcategory', 'childcategory', 'childsubcategory')
            ->where(['status' => 1, 'discount' => 100])->get();

        $events = Event::where('status', 1)->orderBy('id', 'DESC')->latest()->get();
        $banner = Banner::first();

        $front_ads       = Advertisement::where('adcategory_id', 1)->get();
        $success_ads     = Advertisement::where('adcategory_id', 2)->get();
        $studentbenefits = Studentbenefit::where('status', 1)->get();

        $promovideos = Promovideo::get();

        $total["students"]    = Student::count();
        $total["courses"]     = Course::count();
        // $total["instructors"] = Instructor::count();

        $front_categories = Category::with('courses')->where(['status'=> true, 'front_page'=>true])->get();
        $fav_categories = Category::where(['status'=> true, 'favourite'=>true])->get();

        $sliders = Slider::where('status','Active')->latest()->limit(3)->get(['photo_name']);
        $about_tab = AboutTab::first();



        return view('frontend.layout.app', compact('populercourses','courses', 'free_courses', 'banner','categories', 'events','ebooks','supporters','instructors','front_ads', 'success_ads', 'promovideos', 'studentbenefits', 'total', 'front_categories', 'fav_categories','sliders','about_tab'));
    }

    public function signin(){
       return view('frontend.layout.pages.signin');
    }
    public function signup(){
        return view('frontend.layout.pages.signup');
    }
    public function profile(){
        return view('frontend.layout.pages.profile');

    }


    public function allcourse(Request $request, $id = null)
    {
        // Start with a base query
        $query = Course::where('status', 1);

        // If a category is provided, filter by category
        if ($id) {
            $query->where('category_id', $id);
        }

        // Filter by Paid/Free (Assuming 'buy' column: 1 = Paid, 0 = Free)
        if ($request->has('buy') && $request->buy !== null) {
            $query->where('buy', $request->buy);
        }

        // Filter by Skill Level (Assuming 'level' column)
        if ($request->has('level') && $request->level !== null) {
            $query->where('level', $request->level);
        }

        // Fetch filtered courses
        $allcourses = $query->latest()->get();
        $populercourses = Course::where('status', 1)->latest()->get();

        return view('frontend.layout.pages.allcourse', compact('allcourses', 'populercourses'));
    }


    public function eallcourse(Request $request, $id = null) {

        $populercourses = Course::where('status', 1)->latest()->get();

        if ($id) {
            // If category ID is provided, fetch category-specific courses
            $allcourses = Course::where('status', 1)->where('category_id', $id)->latest()->get();
        } else {
            // If no category ID, fetch all courses
            $allcourses = Course::where('status', 1)->latest()->get();
        }

        return view('frontend.layout.pages.allcourse', compact('allcourses', 'populercourses'));
    }

    public function allebook(Request $request)
    {
        // Start with a base query
        $query = Ebook::query();

        // Filter by Paid/Free (Assuming 'buy' column: 1 = Paid, 0 = Free)
        if ($request->has('buy') && $request->buy !== null) {
            $query->where('buy', $request->buy);
        }

        // Filter by Skill Level (Assuming 'level' column)
        if ($request->has('level') && $request->level !== null) {
            $query->where('level', $request->level);
        }

        // Fetch filtered ebooks
        $ebooks = $query->orderBy('id', 'DESC')->get();

        // Return to the view with filtered results
        return view('frontend.layout.pages.allebooks', compact('ebooks'));
    }
    public function ebookdetails($id){
       $ebook =  Ebook::findorFail($id);
       $relatedebooks = Ebook::orderBy('id', 'DESC')->latest()->get();
       $suggestedebooks = Ebook::orderBy('id', 'DESC')->latest()->take(3)->get();

       $reviews = Review::orderBy('id','DESC')->where('ebook_id', $ebook->id)->where('status',1)->get();
       $totalRatings = $reviews->count();
       $rating = $totalRatings > 0 ? $reviews->avg('rating') : 0;

        return view('frontend.layout.pages.ebook-details',compact('ebook','relatedebooks','suggestedebooks','reviews','totalRatings','rating'));
    }

    public function ebookviews($id){
        $ebook = Ebook::findOrFail($id);
        return view('frontend.layout.pages.ebook-views',compact('ebook'));
    }
    public function allexam(){
        $exams =  Quiz::where('exam_status',1)->with('questions')->get();
        // dd($exams);
        return view('frontend.layout.pages.allexams',compact('exams'));
    }

    public function examdetails($id){

        $exam =  Quiz::with('questions')->findOrFail($id);
        return view('frontend.layout.pages.examdetails',compact('exam'));
    }

    public function examstart($id){
        // $request->id
        // $id = 85;
        $quiz = Quiz::with('questions')->findorFail($id);
        // dd( $quiz);
        session(['quiz_id' => $quiz->id]);
        $questions = McqQuestion::with('options')->where('quiz_id', $quiz->id)->get();
        // dd( $questions);
        $correctAnswers = McqQuestion::with(['options' => function($query) {
            $query->where('isAnswer', 1);  // Get only the correct answer
        }])->where('quiz_id', $quiz->id)->get();

        return view('frontend.layout.pages.examstart',compact('quiz','questions','correctAnswers'));
    }

    // public function squizresult(Request $request)
    // {


    //     // dd($request->all());

    //     // Validate request
    //     $request->validate([
    //         'answers' => 'required|array',
    //         'questions' => 'required|array',
    //         'quiz_id' => 'required|numeric',
    //     ]);

    //     $quizId  = $request->quiz_id;
    //     dd( $quizId );
    //     // Store answers & questions in session
    //     session([
    //         'quiz_answers' => $request->answers,
    //         'quiz_questions' => $request->questions
    //     ]);

    //     // Redirect to quiz result page
    //     return redirect()->route('quizresult.view');
    // }


    public function backupquizresult(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'answers'   => 'required|array',
            'questions' => 'required|array',
            'quiz_id'   => 'required|numeric',
        ]);

        $quizId     = $request->quiz_id;
        $answers    = $request->answers;   // option IDs
        $questions  = $request->questions; // question IDs

        dd($request->all());
        $studentId  = Auth::guard('student')->user()->id;

        // Count total questions for this quiz
        $totalQuestion = McqQuestion::where('quiz_id', $quizId)->count();
        $totalAnswer   = count($answers);
        $correct       = 0;

        // Evaluate the number of correct answers
        foreach ($questions as $index => $questionId) {
            $selectedOptionId = $answers[$index];

            $isCorrect = McqOption::where([
                'quiz_id'     => $quizId,
                'mcq_ques_id' => $questionId,
                'id'          => $selectedOptionId,
                'isAnswer'    => true,
            ])->exists();

            if ($isCorrect) {
                $correct++;
            }
        }

        // Save the submission record
        $quizSubmit = Quizsubmit::create([
            'student_id'    => $studentId,
            'quiz_id'       => $quizId,
            'totalquestion' => $totalQuestion,
            'rightanswer'   => $correct,
        ]);

        // Save individual answers
        // foreach ($questions as $index => $questionId) {
        //     $selectedOptionId = $answers[$index];

        //     $rightOption = McqOption::where([
        //         'mcq_ques_id' => $questionId,
        //         'isAnswer'    => true,
        //     ])->first();

        //     QuizsubmitAnswer::create([
        //         'student_id'   => $studentId,
        //         'quiz_id'      => $quizId,
        //         'question_id'  => $questionId,
        //         'option_id'    => $selectedOptionId,
        //         'submit_id'    => $quizSubmit->id,
        //         'right_option' => $rightOption->id ?? null,
        //         'isRight'      => $selectedOptionId == ($rightOption->id ?? null),
        //     ]);
        // }

        // Optional: store data in session if needed
        session([
            'quiz_id'        => $quizId,
            'quiz_answers'   => $answers,
            'quiz_questions' => $questions
        ]);

        return redirect()->route('quizresult.view');
    }

    public function quizresult(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'answers'   => 'required|array',
            'questions' => 'required|array',
            'quiz_id'   => 'required|numeric',
        ]);

        $quizId     = $request->quiz_id;
        $answers    = $request->answers;   // Array of selected answer values (e.g., "Dog", "GREEN")
        $questions  = $request->questions; // Array of question IDs
        // dd($questions);
        $studentId  = Auth::guard('student')->user()->id;

        // Count total questions for this quiz
        $totalQuestion = McqQuestion::where('quiz_id', $quizId)->count();
        $totalAnswer   = count($answers);
        $correct       = 0;

        foreach ($questions as $index => $rawQuestionText) {
            $questionText = preg_replace('/^Question\s*\d+:\s*/i', '', $rawQuestionText);
            $selectedAnswer = $answers[$index];
            // dd($selectedAnswer);
            // dd($quizId);
            // dd($questionText);
            // Find the question by matching text and quiz_id
            $question = McqQuestion::where('quiz_id', $quizId)
                ->where('question', $questionText)
                ->first();
            //   dd($question);
            if (!$question) continue;
            //  dd($question->answer);
            // dd($question->id);
            $questionId = $question->id;
            // Find the correct option by ID (which is stored in mcq_questions.answer)
            $correctOption = McqOption::where([
                'quiz_id'     => $quizId,
                'mcq_ques_id' => $questionId,
                'option' => $selectedAnswer,
                'isAnswer'    => 1,
            ])->exists();

            // dd($correctOption);


            if ($correctOption ) {
                $correct++;
            }


        }



        // dd($correct);
        // Save the submission record
        $quizSubmit = Quizsubmit::create([
            'student_id'    => $studentId,
            'quiz_id'       => $quizId,
            'totalquestion' => $totalQuestion,
            'rightanswer'   => $correct,
        ]);


        // foreach ($questions as $questionId => $optionId) {

        //     $rightOption = McqOption::where(['mcq_ques_id' => $questionId, 'isAnswer' => true])->first();

        //     dd($rightOption);
        //     QuizsubmitAnswer::create([
        //         'student_id'   => Auth::guard('student')->user()->id,
        //         'quiz_id'      => $quizId,
        //         'question_id'  => $questionId,
        //         'option_id'    => $optionId,
        //         'submit_id'    => $quizSubmit->id,
        //         'right_option' => $rightOption->id,
        //         'isRight'      => $optionId == $rightOption->id,
        //     ]);
        // }


        // Optional: store data in session if needed
        session([
            'quiz_id'        => $quizId,
            'quiz_answers'   => $answers,
            'quiz_questions' => $questions
        ]);

        return redirect()->route('quizresult.view');
    }


    // Method to display results
    public function quizresultView()
    {
        $answers = session('quiz_answers', []);
        $questions = session('quiz_questions', []);


    // Get the quiz_id from the session
    $quiz_id = session('quiz_id');

    // Get quiz and correct answers
    $quiz = Quiz::findOrFail($quiz_id);

    // dd($quiz);

    // Get correct answers for each question
    $correctAnswers = McqQuestion::with(['options' => function($query) {
        $query->where('isAnswer', 1);  // Get only the correct answer
    }])->where('quiz_id', $quiz->id)->get();

    // dd($correctAnswers);




        return view('frontend.layout.pages.quizresult', compact('answers', 'questions', 'quiz', 'correctAnswers'));
    }
//     public function quizresultView()
// {
//     // Get quiz data from session
//     $answers = session('quiz_answers', []);
//     $questions = session('quiz_questions', []);

//     // You will need to get the quiz id from the session or the answers, depending on your application design.
//     // Assuming you have quiz_id stored in the session, otherwise you might need to find it dynamically.
//     $quiz_id = session('quiz_id'); // Or you could get it based on other data

//     // Get quiz and correct answers
//     $quiz = Quiz::findOrFail($quiz_id);  // Get the quiz based on the quiz id
//     $correctAnswers = [];

//     foreach ($quiz->questions as $question) {
//         $correctAnswer = $question->options->where('isAnswer', 1)->first(); // Get the correct answer
//         $correctAnswers[$question->id] = $correctAnswer->option;
//     }

//     return view('frontend.layout.pages.quizresult', compact('answers', 'questions', 'quiz', 'correctAnswers'));
// }
    public function allevent(){
        $events =  Event::orderBy('id','DESC')->get();

        return view('frontend.layout.pages.allevents',compact('events'));
    }
    public function  eventdetails($id){

        $event =  Event::findorFail($id);
        $recentevents =  Event::orderBy('id','DESC')->latest()->get();
        // dd($recentevent);
        // dd($event);
        return view('frontend.layout.pages.eventdetails',compact('event','recentevents'));

    }

    public function allinstructor(){
        $instructors =  Instructor::orderBy('id','DESC')->get();
        return view('frontend.layout.pages.allinstructor',compact('instructors'));
    }
    public function podcastDetail($id) {
        $podcast = Podcast::findOrFail($id);
        $shareButtons = ShareFacade::page(
            url('/podcast/detail/'. $id),
            'Podcast With Shahan',
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()
        ->reddit();
        return view('frontend.layout.pages.podcast-detail', compact('podcast','shareButtons'));
    }

    public function podcast() {
        return view('frontend.layout.pages.podcast', [
            'podcasts' => Podcast::latest()->get(['id','photo','title','audio','description'])
        ]);
    }

    public function coursedetails($id){
        $coursedetails = Course::findorFail($id);
        // dd($coursedetails->id);
        $relatedcourses = Course::where('category_id', $coursedetails->category_id)->where('id', '!=', $coursedetails->id)->latest()->get();
        $suggestedcourses = Course::where('category_id', $coursedetails->category_id)->where('id', '!=', $coursedetails->id)->take(5)->get();
        // dd($suggestedcourses);
        $reviews = Review::orderBy('id','DESC')->where('course_id',$coursedetails->id)->where('status',1)->get();
        $totalRatings = $reviews->count();
        $rating = $totalRatings > 0 ? $reviews->avg('rating') : 0;

        //Modules
         $first_video = [];
         $modules = Module::where('course_id', $coursedetails->id)->get(['id']);
        foreach ($modules as $module) {
            $lessons = Lesson::where('module_id', $module->id)->get(['id']);
            foreach ($lessons as $lesson) {
                foreach ($lesson->videos as $video) {
                    if ($video->free == '1') {
                        $first_video = $video;
                        break 3;
                    }
                }
            }
        }

        return view('frontend.layout.pages.course-details', compact('coursedetails','relatedcourses', 'suggestedcourses', 'reviews','totalRatings','rating','first_video'));
    }



    public function search(Request $request) {
        $keyword = $request->keyword;
        $courses = Course::where('name', 'LIKE', '%' . $keyword . '%')->where('status', 1)->orderBy('id', 'DESC')->get();

        return view('frontend.search', compact('courses', 'keyword'));
    }

    public function categories($id) {
        $courses = Course::with('category', 'subcategory', 'childcategory', 'childsubcategory')
            ->where(['status' => 1, 'category_id' => $id])->orderBy('id', 'DESC')->get();

        $category        = Category::find($id);
        $categoryId      = $id;
        $subcategoryId   = null;
        $childcategoryId = null;

        return view('frontend.categories', compact('courses', 'category', 'categoryId', 'subcategoryId', 'childcategoryId'));
    }

    public function subcategories($id) {
        $courses = Course::with('category', 'subcategory', 'childcategory', 'childsubcategory')
            ->where(['status' => 1, 'subcategory_id' => $id])->orderBy('id', 'DESC')->get();

        $subcategory     = Subcategory::find($id);
        $category        = Category::find($subcategory->category_id);
        $categoryId      = null;
        $subcategoryId   = $id;
        $childcategoryId = null;

        return view('frontend.categories', compact('courses', 'category', 'categoryId', 'subcategoryId', 'childcategoryId'));
    }

    public function childcategories($id) {
        $courses = Course::with('category', 'subcategory', 'childcategory', 'childsubcategory')
            ->where(['status' => 1, 'childcategory_id' => $id])->orderBy('id', 'DESC')->get();

        $childcategory   = Childcategory::find($id);
        $subcategory     = Subcategory::find($childcategory->subcategory_id);
        $category        = Category::find($subcategory->category_id);
        $categoryId      = null;
        $subcategoryId   = null;
        $childcategoryId = $id;

        return view('frontend.categories', compact('courses', 'category', 'categoryId', 'subcategoryId', 'childcategoryId'));
    }

    public function course(Request $request, $id) {
        $course = Course::with('category', 'subcategory', 'childcategory', 'childsubcategory', 'instructor', 'modules')
            ->where(['status' => 1, 'id' => $id])->first();

        $releted_courses = Course::with('category', 'subcategory', 'childcategory', 'childsubcategory')
            ->where(['status' => 1])->where('category_id', $course->category_id)->where('id', '!=', $course->id)->latest()->get();

        $reviewCount = RatingReview::where('course_id', $course->id)->count();
        $ratingCount = RatingReview::where('course_id', $course->id)->sum('rating');

        $average_rating = $ratingCount>0 ? $ratingCount / $reviewCount : 0;


        $ratings = RatingReview::where('course_id', $course->id)->get();

        $ratingCounts = [
            5 => 0,
            4 => 0,
            3 => 0,
            2 => 0,
            1 => 0
        ];


        foreach ($ratings as $rating) {
            $ratingCounts[$rating->rating]++;
        }

        $totalReviews = $ratings->count();
        $averageRating = $totalReviews > 0 ? array_sum(array_map(function($rating, $count) {
            return $rating * $count;
        }, array_keys($ratingCounts), $ratingCounts)) / $totalReviews : 0;


        $ratingPercentages = [];
        foreach ($ratingCounts as $rating => $count) {
            $ratingPercentages[$rating] = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
        }

        $course->average_rating = $average_rating;
        $course->ratingPercentages = $ratingPercentages;

        return view('frontend.course', compact('course', 'releted_courses'));
    }

    // public function checkCertificate(Request $request){
    //     $certificate = Enroll::where('certificateNo', $request->certificateNo)->first();

    //     return view('frontend.checkCertificate', compact('certificate'));
    // }

    // public function instructors() {
    //     $instructors = Instructor::where(['status' => 1])->get();

    //     return view('frontend.instructors', compact('instructors'));
    // }

    // public function instructor($id) {
    //     $instructor = Instructor::find($id);

    //     $courses = Course::where('instructor_id', $instructor->id)->get();

    //     return view('frontend.single-instructor', compact('instructor', 'courses'));
    // }

    // public function events() {
    //     $events = Event::where('status', 1)->orderBy('id', 'DESC')->get();

    //     return view('frontend.events', compact('events'));
    // }

    // public function eventDetails($id) {
    //     $event = Event::find($id);

    //     return view('frontend.event-details', compact('event'));
    // }

    // public function about() {
    //     return view('frontend.about', [
    //         'about_tab' => AboutTab::first(),
    //         'about_items'=>AboutItem::latest()->get(['thumbnail','title','short_description','slug'])
    //     ]);
    // }

    // public function contact() {
    //     return view('frontend.contact');
    // }

    // public function blog() {
    //     $blogs = Blog::where('status', 1)->orderBy('id', 'DESC')->paginate(12);

    //     return view('frontend.blog', compact('blogs'));
    // }

    // public function blogDetails($id) {
    //     $blog = Blog::find($id);

    //     return view('frontend.blog-details', compact('blog'));
    // }

    // public function cart() {
    //     return view('frontend.cart');
    // }

    public function CouponCalculation() {
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_code' => session()->get('coupon')['coupon_code'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
                'discount_symbol' => session()->get('coupon')['discount_symbol'],
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total()
            ));
        }
    }

    public function CouponRemove() {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Removed Successfully']);
    }

    public function ebookCheckout($id){
        $course = Ebook::findOrFail($id);
        $carts = Cart::content();
        foreach ($carts as $value) {
            Cart::remove($value->rowId);
        }
        // Check if the course is already in the cart
        // $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
        //     return $cartItem->id === $id;
        // });
        // if ($cartItem->isNotEmpty()) {
        //     return "<h1>Already Added</h1>";
        // }
        Cart::add([
            'id' => $id,
            'name' => $course->title,
            'qty' => 1,
            'price' => $course->price,
            'weight' => 1,
            // 'options' => [
            //     'image' => $course->thumbnil_image,
            //     'instructor_id' => $course->instructor->name
            // ]
        ]);
        if (Session::has('coupon')) {
            $coupon_code = Session::get('coupon')['coupon_code'];
            $coupon = Coupon::where('coupon_code', $coupon_code)->where('coupon_date','>=', Carbon::now()->format('Y-m-d'))
            ->first();
            $discount_amount = 0;
            $total_amount = 0;
            $discount_symbol = '';
            if ($coupon) {
                if ($coupon->coupon_type == 1) {
                    $discount_amount = round(Cart::total() * $coupon->coupon_discount / 100);
                    $total_amount = round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100);
                    $discount_symbol = '%';
                } elseif($coupon->coupon_type == 2) {
                    $discount_amount = round($coupon->coupon_discount);
                    $total_amount = round(Cart::total() - $coupon->coupon_discount);
                    $discount_symbol = '/=';
                }
                Session::put('coupon', [
                    'coupon_code' => $coupon->coupon_code,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => $discount_amount,
                    'total_amount' => $total_amount,
                    'discount_symbol' => $discount_symbol
                ]);
            }
        }
        return view('frontend.guest-checkout', compact('course'));
    }

    public function GuestCheckout($id) {
        $course = Course::findOrFail($id);
        $carts = Cart::content();
        foreach ($carts as $value) {
            Cart::remove($value->rowId);
        }
        // Check if the course is already in the cart
        // $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
        //     return $cartItem->id === $id;
        // });
        // if ($cartItem->isNotEmpty()) {
        //     return "<h1>Already Added</h1>";
        // }
        Cart::add([
            'id' => $id,
            'name' => $course->name,
            'qty' => 1,
            'price' => $course->price,
            'weight' => 1,
            'options' => [
                'image' => $course->thumbnil_image ,
                'instructor_id' => $course->instructor->name
            ]
        ]);
        if (Session::has('coupon')) {
            $coupon_code = Session::get('coupon')['coupon_code'];
            $coupon = Coupon::where('coupon_code', $coupon_code)->where('coupon_date','>=', Carbon::now()->format('Y-m-d'))
            ->first();
            $discount_amount = 0;
            $total_amount = 0;
            $discount_symbol = '';
            if ($coupon) {
                if ($coupon->coupon_type == 1) {
                    $discount_amount = round(Cart::total() * $coupon->coupon_discount / 100);
                    $total_amount = round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100);
                    $discount_symbol = '%';
                } elseif($coupon->coupon_type == 2) {
                    $discount_amount = round($coupon->coupon_discount);
                    $total_amount = round(Cart::total() - $coupon->coupon_discount);
                    $discount_symbol = '/=';
                }
                Session::put('coupon', [
                    'coupon_code' => $coupon->coupon_code,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => $discount_amount,
                    'total_amount' => $total_amount,
                    'discount_symbol' => $discount_symbol
                ]);
            }
        }
        return view('frontend.guest-checkout', compact('course'));
    }



    public function CouponApply(Request $request) {
        $coupon = Coupon::where('coupon_code', $request->coupon_name)->where('coupon_date','>=', Carbon::now()->format('Y-m-d'))
        ->first();
        $discount_amount = 0;
        $total_amount = 0;
        $discount_symbol = '';
        if ($coupon) {
            if ($coupon->coupon_type == 1) {
                $discount_amount = round(Cart::total() * $coupon->coupon_discount / 100);
                $total_amount = round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100);
                $discount_symbol = '%';
            } elseif($coupon->coupon_type == 2) {
                $discount_amount = round($coupon->coupon_discount);
                $total_amount = round(Cart::total() - $coupon->coupon_discount);
                $discount_symbol = '/=';
            }
            Session::put('coupon', [
                'coupon_code' => $coupon->coupon_code,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $discount_amount,
                'total_amount' => $total_amount,
                'discount_symbol' => $discount_symbol
            ]);
            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));
        } else {
            return response()->json([
                'error' => 'Invalid Coupon',
            ]);
        }
    }

    public function BillingStore(Request $request) {

        $request->validate([
            'name'=>'required|string|max:255',
            'country'=>'nullable',
            'phone'=>'required',
            'email'=>'nullable|email|unique:students,email',
            'division'=>'nullable',
            'district'=>'nullable',
            'upzilla'=>'nullable',
            'address'=>'nullable|string|max:255',
            'apartment'=>'nullable',
            'notes'=>'nullable',
        ]);
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        if (Auth::guard('instructor')->check()) {
            Auth::guard('instructor')->logout();
        }
        if (Auth::guard('student')->check()) {
            BillingInfo::create([
                'student_id'=>Auth::guard('student')->user()->id,
                'course_id'=>$request->course_id ?? null,
                'price' => $request->course_price ?? $request->ebook_price,
                'ebook_id' => $request->ebook_id ?? null,

                'country'=>$request->country,
                'division'=>$request->division,
                'district'=>$request->district,
                'upzilla'=>$request->upzilla,
                'address'=>$request->address,
                'apartment'=>$request->apartment,
                'notes'=>$request->notes
            ]);
            return redirect()->route('order.page');
        } else {
            $student = Student::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->phone),
                'phone'=>$request->phone,
                'address'=>$request->address,
            ]);
            BillingInfo::create([
                'student_id'=>$student->id,
                'course_id'=>$request->course_id ?? null,
                'price' => $request->course_price ??  $request->ebook_price,
                'ebook_id' => $request->ebook_id ?? null,

                'country'=>$request->country,
                'division'=>$request->division,
                'district'=>$request->district,
                'upzilla'=>$request->upzilla,
                'address'=>$request->address,
                'apartment'=>$request->apartment,
                'notes'=>$request->notes
            ]);
            if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->phone, 'status' => 1])) {
                // return redirect()->route('student.courses');
                return redirect()->route('order.page');
            }
        }
    }

    public function OrderPage() {
        $billing_info = BillingInfo::where('student_id', Auth::guard('student')->user()->id)->latest()->first();
        if ($billing_info) {
            return view('frontend.order-page', [
                'carts' => Cart::content(),
                'billing_info' => $billing_info
            ]);
        }
    }

    public function checkout() {
        $courses  = session()->get('cart');
        $discount = session()->get('discount');

        return view('frontend.checkout', compact('courses', 'discount'));
    }

    public function AboutDetails($slug) {
        return view('frontend.aboutdetails', [
            'about_item'=>AboutItem::where('slug', $slug)->first()
        ]);
    }

    // public function allcourse() {
    //     return view('frontend.allcourse', [
    //         'categories'=>Category::with('courses')->latest()->get(['id','name'])
    //     ]);
    // }

    public function gallery() {
        return view('frontend.gallery');
    }

    public function videos() {
        $freevideoscategories = Freevideoscategory::with('videos')->get();

        function getYoutubeId($url)
        {
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $url, $matches);
            return $matches[1] ?? null;
        }
        return view('frontend.layout.pages.videos',compact('freevideoscategories'));
    }

    public function videosbycategory($id) {
        $freevideoscategories = Freevideoscategory::with('videos')->findOrFail($id);

        function getYoutubeId($url){
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $url, $matches);
            return $matches[1] ?? null;
        }
        return view('frontend.layout.pages.videos', compact('freevideoscategories'));
    }

    public function podcastbycategory($id) {
        return view('frontend.layout.pages.podcast', [
            'podcasts' => Podcast::where('category_id',$id)->get(['id','photo','title','audio','description'])
        ]);
    }
}
