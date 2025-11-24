<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Childsubcategory;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\RatingReview;
use App\Models\McqOption;
use App\Models\McqQuestion;
use App\Models\ReviewReply;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\QuizOption;
use App\Models\Subcategory;
use App\Models\Video;
use App\Models\Written;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller {
    public function courses() {
        $courses = Course::where('instructor_id', auth()->guard('instructor')->user()->id)->orderBy('id', 'desc')->get();

        return view('frontend.instructor.courses.index', compact('courses'));
    }

   

    public function create() {
        $data               = [];
        $data['categories'] = Category::where('status', 1)->get();

        return view('frontend.instructor.courses.create', $data);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'details'        => 'required',
            'course_name'    => 'required',
            'price'          => 'required',
            'thumbnil_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'details_file'   => 'nullable|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        if ($request->hasFile('thumbnil_image')) {

            $image_file = $request->file('thumbnil_image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/course/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name       = $img_gen . '.' . $image_ext;
                $thumbnil_image = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        if ($request->hasFile('details_file')) {

            $image_file = $request->file('details_file');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/courses/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name     = $img_gen . '.' . $image_ext;
                $details_file = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        $course = Course::create([
            'instructor_id'       => auth()->guard('instructor')->user()->id,
            'category_id'         => $request->category_id,
            'subcategory_id'      => $request->subcategory_id,
            'childcategory_id'    => $request->childcategory_id,
            'childsubcategory_id' => $request->childsubcategory_id,
            'name'                => $request->course_name,
            'price'               => $request->price - $request->discount_price,
            'old_price'           => $request->price,
            'discount'            => $request->discount,
            'discount_price'      => $request->discount_price,
            'details'             => $request->details,
            'details_file'        => $details_file ?? null,
            'thumbnil_image'      => $thumbnil_image ?? null,
        ]);

        

        return redirect()->route('instructor.courses.index')->with('success', 'Your courses submitted successfully!!');
    }

    public function edit($id) {
        $course     = Course::where('id', $id)->first();
        $categories = Category::where('status', 1)->get();
        $sub        = Subcategory::where('id', $course->subcategory_id)->where('status', 1)->get();
        $child      = Childcategory::where('id', $course->childcategory_id)->where('status', 1)->get();
        $childsub   = Childsubcategory::where('id', $course->childsubcategory_id)->where('status', 1)->get();

        return view('frontend.instructor.courses.edit', compact('course', 'categories', 'sub', 'child', 'childsub'));
    }

    public function update(Request $request, $id) {
        $course    = Course::where('id', $id)->first();
        $validator = Validator::make($request->all(), [
            'details'        => 'required',
            'course_name'    => 'required',
            'price'          => 'required',
            'thumbnil_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'details_file'   => 'nullable|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        if ($request->hasFile('thumbnil_image')) {

            $image_file = $request->file('thumbnil_image');

            if ($image_file) {

                if ($course->thumbnil_image) {
                    $thumbnil_image_image_path = public_path($course->thumbnil_image);

                    if (File::exists($thumbnil_image_image_path)) {
                        File::delete($thumbnil_image_image_path);
                    }

                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/courses/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name       = $img_gen . '.' . $image_ext;
                $thumbnil_image = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $course->update(['thumbnil_image' => $thumbnil_image]);
            }

        }

        if ($request->hasFile('details_file')) {

            $image_file = $request->file('details_file');

            if ($image_file) {

                if ($course->details_file) {
                    $details_file_image_path = public_path($course->details_file);

                    if (File::exists($details_file_image_path)) {
                        File::delete($details_file_image_path);
                    }

                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/courses/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name     = $img_gen . '.' . $image_ext;
                $details_file = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $course->update(['details_file' => $details_file]);
            }

        }

        $course->update([
            'category_id'         => $request->category_id,
            'subcategory_id'      => $request->subcategory_id,
            'childcategory_id'    => $request->childcategory_id,
            'childsubcategory_id' => $request->childsubcategory_id,
            'name'                => $request->course_name,
            'price'               => $request->price - $request->discount_price,
            'old_price'           => $request->price,
            'discount'            => $request->discount,
            'discount_price'      => $request->discount_price,
            'details'             => $request->details,
        ]);

        return to_route('instructor.courses.index')->with('success', 'Your courses updated successfully!!');
    }

    public function active(Request $request, $id) {
        $course = Course::findOrFail($id);

        $course->status = 1;
        $course->save();

        return redirect()->route('instructor.courses.index')->with('success', 'Course activated successfully!!');
    }

    public function inactive(Request $request, $id) {
        $course = Course::findOrFail($id);

        $course->status = 0;
        $course->save();

        return redirect()->route('instructor.courses.index')->with('success', 'Course inactivated successfully!!');
    }

    // =============== Module ========================= \\

    public function modules($id) {
        $course  = Course::find($id);
        $modules = Module::where('course_id', $id)->get();

        return view('frontend.instructor.courses.modules', compact('modules', 'course'));
    }

    public function addmodule($id) {
        $course = Course::find($id);

        return view('frontend.instructor.courses.module-add', compact('course'));
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

        return redirect()->route('instructor.courses.modules', $request->course_id)->with('Modules added successfully!!');
    }

    public function moduleedit($id) {
        $module = Module::find($id);

        return view('frontend.instructor.courses.module-edit', compact('module'));
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

        return redirect()->route('instructor.courses.modules', $module->course_id)->with('success', 'Module updated successfully');
    }

    public function moduledelete(Request $request) {
        Module::find($request->module_id)->delete();

        return redirect()->back()->with('success', 'Module deleted successfully');
    }

    // ========================== Reviews =================================== \\
    
    
    public function reviews($id){
        $course  = Course::find($id);
        $reviews = RatingReview::where('course_id', $id)->get();

        return view('frontend.instructor.courses.reviews', compact('reviews', 'course'));
    }
    
    public function reviewDiscussion($id){
        $review = RatingReview::find($id);
        $review_replies = ReviewReply::where('review_id', $id)->get();
        
        return view('frontend.instructor.courses.reviewDiscussion', compact('review', 'review_replies'));
    }
    
    public function reviewReply(Request $request){
        $validator = Validator::make($request->all(), [
            'reply' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }
        
        ReviewReply::create([
            'review_id'     => $request->review_id,
            'instructor_id' => auth()->guard('instructor')->user()->id,
            'reply'          => $request->reply,
        ]);
        
        return redirect()->back()->with('You replied!!');
    }
    

    public function lessons($id) {
        $module  = Module::find($id);
        $lessons = Lesson::where('module_id', $id)->get();

        return view('frontend.instructor.courses.lessons', compact('lessons', 'module'));
    }

    public function lessonadd($id) {
        $module = Module::find($id);

        return view('frontend.instructor.courses.lesson-add', compact('module'));
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

        return redirect()->route('instructor.courses.module.lessons', $request->module_id)->with('Lessons added successfully!!');
    }

    public function lessonedit($id) {
        $lesson = Lesson::find($id);

        return view('frontend.instructor.courses.lesson-edit', compact('lesson'));
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

        return redirect()->route('instructor.courses.module.lessons', $lesson->module_id)->with('success', 'Lesson updated successfully');
    }

    public function lessondelete(Request $request) {
        Lesson::find($request->lesson_id)->delete();

        return redirect()->back()->with('success', 'lesson deleted successfully');
    }

    // =============================================== \\

    public function videos($id) {
        $lesson = Lesson::find($id);
        $videos = Video::where('lesson_id', $id)->get();

        return view('frontend.instructor.courses.videos', compact('lesson', 'videos'));
    }

    public function videoadd($id) {
        $lesson = Lesson::find($id);

        return view('frontend.instructor.courses.video-add', compact('lesson'));
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
                    'image'     => $video_image,
                ]);
            }

        }

        return redirect()->route('instructor.courses.module.lesson.videos', $request->lesson_id)->with('Videos added successfully!!');
    }

    public function videoedit($id) {
        $video = Video::find($id);

        return view('frontend.instructor.courses.video-edit', compact('video'));
    }

    public function videoupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'link' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $image_file  = $request->image;
        $video_image = null;

        if ($image_file) {

            $img_gen   = hexdec(uniqid());
            $image_url = 'images/videos/';
            $image_ext = strtolower($image_file->getClientOriginalExtension());

            $img_name    = $img_gen . '.' . $image_ext;
            $video_image = $image_url . $img_gen . '.' . $image_ext;

            $image_file->move($image_url, $img_name);
        }

        $video = Video::find($request->video_id);
        $video->update([
            'name'  => $request->name,
            'link'  => $request->link,
            'free'  => $request->free ? true : false,
            'image' => $video_image,
        ]);

        return redirect()->route('instructor.courses.module.lesson.videos', $video->lesson_id)->with('success', 'Video updated successfully');
    }

    public function videodelete(Request $request) {
        Video::find($request->video_id)->delete();

        return redirect()->back()->with('success', 'Video deleted successfully');
    }

    //  section
    public function quizzes($id) {
        $lesson  = Lesson::find($id);
        $quizzes = Quiz::where('lesson_id', $id)->get();

        return view('frontend.instructor.courses.quizzes', compact('lesson', 'quizzes'));
    }

    public function quizadd($id) {
        $lesson = Lesson::find($id);

        return view('frontend.instructor.courses.quiz-add', compact('lesson'));
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

        return redirect()->route('instructor.courses.module.lesson.quizzes', $request->lesson_id)->with('Videos added successfully!!');
    }

    public function quizedit($id) {
        $quiz = Quiz::find($id);

        return view('frontend.instructor.courses.quiz-edit', compact('quiz'));
    }

    public function quizupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'timer' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $quiz = Quiz::find($request->quiz_id);
        $quiz->update([
            'name'  => $request->name,
            'timer' => $request->timer,
        ]);

        return redirect()->route('instructor.courses.module.lesson.quizzes', $quiz->lesson_id)->with('success', 'Quiz updated successfully');
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

        return view('frontend.instructor.courses.questions', compact('quiz', 'questions'));
    }

    public function questionadd($id) {
        $quiz = Quiz::find($id);

        return view('frontend.instructor.courses.question-add', compact('quiz'));
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

        return view('frontend.instructor.courses.question-edit', compact('question'));
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
        ]);

        foreach ($request->options as $key => $option) {

            if ($option) {
                McqOption::find($request->option_ids[$key])->update([
                    'option'   => $request->options[$key],
                    'isAnswer' => $request->answer == $key + 1 ? true : false,
                ]);
            }

        }

        return redirect()->route('instructor.courses.module.lesson.quiz.questions', $question->quiz_id)->with('success', 'McqQuestion updated successfully');
    }

    public function questiondelete(Request $request) {
        McqQuestion::find($request->question_id)->delete();
        McqOption::where('mcq_ques_id', $request->question_id)->delete();

        return redirect()->back()->with('success', 'McqQuestion deleted successfully');
    }

    // ======================================================================== \\

    public function addQuiz($id) {
        $course = Course::findOrFail($id);

        return view('frontend.instructor.courses.add-quiz', compact('id', 'course'));
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

        return view('frontend.instructor.courses.add-question', compact('id', 'course'));
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

        return view('frontend.instructor.courses.add-author', compact('id', 'course'));
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

        return view('frontend.instructor.courses.add-video', compact('id', 'course'));
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

}
