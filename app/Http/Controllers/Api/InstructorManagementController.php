<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Quiz;
use App\Models\QuizOption;
use App\Models\Video;
use App\Models\RatingReview;
use App\Models\Written;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InstructorManagementController extends Controller {
    public function register(Request $request) {
        DB::beginTransaction();

        try {

            $validator = Validator::make($request->all(), [
                'name'         => 'required',
                'email'        => 'required|unique:instructors',
                'password'     => 'required',
                'phone '       => 'required|unique:instructors',
                'gender'       => 'required',
                'dob'          => 'required',
                'profession'   => 'required',
                'institution'  => 'required',
                'department'   => 'required',
                'address'      => 'required',
                'youtube_link' => 'required',
            ]);

            $instructor = Instructor::create([
                'name'           => $request->name,
                'email'          => $request->email,
                'password'       => bcrypt($request->password),
                'phone'          => $request->phone,
                'mobile_banking' => $request->mobile_banking,
                'gender'         => $request->gender,
                'dob'            => $request->dob,
                'profession'     => $request->profession,
                'institution'    => $request->institution,
                'department'     => $request->department,
                'address'        => $request->address,
                'youtube_link'   => $request->youtube_link,
                'status'         => 1,
            ]);

            DB::commit();

            return response()->json([
                'status'     => true,
                'message'    => 'Your account created successfully!!',
                'instructor' => $instructor,
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

            if (!Auth::guard('instructor')->attempt([
                'email'    => $request->email,
                'password' => $request->password,
                'status'   => 1,
            ])) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Invalid email or unauthorized account!!',
                ]);
            }

            $user = Auth::guard('instructor')->user();
            $user->tokens()->delete(); //deleting all previous token
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status'       => true,
                'token_type'   => 'Bearer',
                'access_token' => $tokenResult,
                'auth_type'    => 'email',
                'user'    => $user,
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status'  => false,
                'message' => 'Error in Login',
            ]);
        }

    }

    public function profileUpdate(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'phone' => 'required|instructors:unique,phone,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $profile = Instructor::find($id);

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/instructor/';
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
            'name'  => $request->name,
            'phone' => $request->phone,
        ]);

        return $profile;

    }

    public function storeCourse(Request $request) {
        DB::beginTransaction();

        try {

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

            // if ($request->zoom_video) {

            //     $image_file = base64_decode($request['zoom_video']);
            //     $b64_video  = '/images/course/' . time() . '.' . 'mp4';
            //     $success    = file_put_contents(public_path() . $b64_video, $image_file);

            // }

            $course = Course::create([
                'instructor_id'       => auth()->user()->id,
                'category_id'         => $request->category_id,
                'subcategory_id'      => $request->subcategory_id,
                'childcategory_id'    => $request->childcategory_id,
                'childsubcategory_id' => $request->childsubcategory_id,
                'name'                => $request->course_name,
                'price'               => $request->price,
                'discount'            => $request->discount,
                'discount_price'      => $request->discount_price,
                'details'             => $request->details,
                'details_file'        => $details_file ?? 'file',
                'thumbnil_image'      => $thumbnil_image ?? 'image',
                'zoom_link'           => $request->zoom_link,
                'zoom_video'          => $request->zoom_video,
                'zoom_video'          => $b64_video ?? 'zoom_video',
            ]);

            foreach ($request->video as $key => $item) {

               
                Video::create([
                    'instructor_id' => $course->instructor_id,
                    'course_id'     => $course->id,
                    'name'          => $item["video_name"],
                    'link'          => $item["video_link"],
                    'duration'      => $item["video_duration"],
                ]);
                
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Course store successfully!!',
                'data'    => $course,
            ]);
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ]);
        }

    }

    public function storeAuthor(Request $request) {

        DB::beginTransaction();

        try {


                if ($request->hasFile('author_image')) {
                    
                    $image_file = $request->file('author_image');
                    if($image_file){
                    
                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/author/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());
    
                    $img_name     = $img_gen . '.' . $image_ext;
                    $author_image = $image_url . $img_gen . '.' . $image_ext;
    
                    $image_file->move($image_url, $img_name);

                }
                }

                Author::create([
                    'instructor_id' => auth()->user()->id,
                    'course_id'     => $request->course_id,
                    'name'          => $request->author_name,
                    'institution'   => $request->author_institution,
                    'designation'   => $request->author_designation,
                    'image'         => $author_image ?? 'image',
                ]);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Course author store successfully!!',
            ]);

        } catch (\Throwable$th) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ]);

        }

    }

    public function storeQuestion(Request $request) {
        DB::beginTransaction();

        try {
            
            if ($request->hasFile('image')) {
                    
                    $image_file = $request->file('image');
                    if($image_file){
                    
                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/written/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());
    
                    $img_name     = $img_gen . '.' . $image_ext;
                    $image = $image_url . $img_gen . '.' . $image_ext;
    
                    $image_file->move($image_url, $img_name);

                }
                }

                Written::create([
                    'instructor_id' => auth()->user()->id,
                    'course_id'     => $request->course_id,
                    'name'          => $request->question_name,
                    'answer'        => $request->question_answer,
                    'points'        => $request->question_point,
                    'image'         => $image ?? 'image',
                ]);

            

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Course question store successfully!!',
            ]);
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th,
            ]);
        }

    }

    public function storeVideo(Request $request) {
        DB::beginTransaction();

        try {

            foreach ($request->video as $item) {

                Video::create([
                    'instructor_id' => auth()->user()->id,
                    'course_id'     => $item['course_id'],
                    'name'          => $item["video_name"],
                    'link'          => $item["video_link"],
                    'duration'      => $item["video_duration"],
                ]);

            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Course video store successfully!!',
            ]);
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ]);
        }

    }

    public function storeQuiz(Request $request) {
        DB::beginTransaction();

        try {

            $quiz = Quiz::create([
                'instructor_id' => auth()->user()->id,
                'course_id'     => $request->course_id,
                'name'          => $request->name,
                'answer'          => $request->answer,
                'options'          => $request->options,
                'points'        => $request->point,
            ]);

            foreach ($request->option as $item) {

                QuizOption::create([
                    'quiz_id'  => $quiz->id,
                    'option'   => $item['option'],
                    'isAnswer' => $item['isAnswer'],
                ]);

            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Course quiz store successfully!!',
            ]);
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th,
            ]);
        }

    }

    //update
    public function updateCourse(Request $request) {
        DB::beginTransaction();

        try {

            $course = Course::findOrFail($request->course_id);

            if ($request->hasFile('thumbnil_image')) {

                $image_file = $request->file('thumbnil_image');

                if ($image_file) {

                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/course/';
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

                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/courses/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());

                    $img_name     = $img_gen . '.' . $image_ext;
                    $details_file = $image_url . $img_gen . '.' . $image_ext;

                    $image_file->move($image_url, $img_name);
                    $course->update(['details_file' => $details_file]);
                }

            }

            if ($request->hasFile('zoom_video')) {

                $image_file = $request->file('zoom_video');

                if ($image_file) {

                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/courses/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());

                    $img_name   = $img_gen . '.' . $image_ext;
                    $zoom_video = $image_url . $img_gen . '.' . $image_ext;

                    $image_file->move($image_url, $img_name);
                    $course->update(['zoom_video' => $zoom_video]);
                }

            }

            $course->update([
                'category_id'         => $request->category_id,
                'subcategory_id'      => $request->subcategory_id,
                'childcategory_id'    => $request->childcategory_id,
                'childsubcategory_id' => $request->childsubcategory_id,
                'name'                => $request->course_name,
                'price'               => $request->price,
                'discount'            => $request->discount,
                'discount_price'      => $request->discount_price,
                'details'             => $request->details,
                'zoom_link'           => $request->zoom_link,
                'zoom_password'       => $request->zoom_password,
            ]);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Course update successfully!!',
            ]);
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th,
            ]);
        }

    }

    public function updateAuthor(Request $request) {
        DB::beginTransaction();

        try {
            $author = Author::findOrFail($request->author_id);

            if ($request->hasFile('author_image')) {

                $image_file = $request->file('author_image');

                if ($image_file) {

                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/author/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());

                    $img_name       = $img_gen . '.' . $image_ext;
                    $author_image = $image_url . $img_gen . '.' . $image_ext;

                    $image_file->move($image_url, $img_name);

                    $author->update(['image' => $author_image]);
                }

            }

            $author->update([
                'name'        => $request->author_name,
                'institution' => $request->author_institution,
                'designation' => $request->author_designation,
            ]);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Course author updated successfully!!',
            ]);
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ]);
        }

    }

    public function updateQuestion(Request $request) {
        DB::beginTransaction();

        try {

            $question = Written::findOrFail($request->question_id);
            
            if ($request->hasFile('image')) {

                $image_file = $request->file('image');

                if ($image_file) {

                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/written/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());

                    $img_name       = $img_gen . '.' . $image_ext;
                    $image = $image_url . $img_gen . '.' . $image_ext;

                    $image_file->move($image_url, $img_name);

                    $question->update(['image' => $image]);
                }

            }

            $question->update([
                'name'   => $request->question_name,
                'answer' => $request->question_answer,
                'points' => $request->question_point,
            ]);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Course question update successfully!!',
            ]);
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th,
            ]);
        }

    }

    public function updateVideo(Request $request) {
        DB::beginTransaction();

        try {

            $video = Video::findOrFail($request->video_id);

            // if ($request['image']) {

            //     $image_file = base64_decode($request['image']);
            //     $b64_image  = '/images/video/' . time() . '.' . 'png';
            //     $success    = file_put_contents(public_path() . $b64_image, $image_file);
            //     $video->update([
            //         'image' => $b64_image,
            //     ]);
            // }

            $video->update([
                'name'     => $request->video_name,
                'link'     => $request->video_link,
                'duration' => $request->video_duration,
            ]);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Course video update successfully!!',
            ]);
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th,
            ]);
        }

    }

    public function updateQuiz(Request $request) {
        DB::beginTransaction();

        try {

            $quiz = Quiz::findOrFail($request->quiz_id);

            $quiz->update([
                'name'   => $request->name,
                'answer' => $request->answer,
                'options' => $request->options,
                'points' => $request->point,
            ]);

            foreach ($request->option as $item) {
                $quiz_option = QuizOption::find($item['id']);

                $quiz_option->update([
                    'option'   => $item['option'],
                    'isAnswer' => $item['isAnswer'],
                ]);

            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Course quiz update successfully!!',
            ]);
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th,
            ]);
        }

    }

    public function allCourses() {
        $coursesCollection = Course::where('instructor_id', auth()->user()->id)
            ->with(
                'instructor',
                'category',
                'subcategory',
                'childcategory',
                'childsubcategory',
                'videos',
                'quizzes.quizOptions',
                'written',
                'authors'
            )->get();
            
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
                
        return response()->json([
            'status'  => true,
            'data'    => $courses,
        ]);
            
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'new_password' => 'required',
        ]);

        $instructor = Instructor::where('id', Auth::id())->first();

        if ($instructor) {
            $instructor->update([
                'password' => bcrypt($request->new_password),
                'status'   => 0,
            ]);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Password reset successfully',
            'data'    => $instructor,
        ]);
    }

    public function deleteAuthor($id) {
        $data = Author::where('id', $id)->where('instructor_id', Auth::id())->first();

        if (!$data) {
            return response()->json([
                'status'  => true,
                'message' => 'Author not found!!',
            ]);
        }

        $data->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Author deleted successfully!!',
        ]);
    }

    public function deleteQuestion($id) {
        $data = Written::where('id', $id)->where('instructor_id', Auth::id())->first();

        if (!$data) {
            return response()->json([
                'status'  => true,
                'message' => 'Question not found!!',
            ]);
        }

        $data->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Question deleted successfully!!',
        ]);
    }

    public function deleteVideo($id) {
        $data = Video::where('id', $id)->where('instructor_id', Auth::id())->first();

        if (!$data) {
            return response()->json([
                'status'  => true,
                'message' => 'Video not found!!',
            ]);
        }

        $data->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Video deleted successfully!!',
        ]);
    }

    public function deleteQuiz($id) {
        $data = Quiz::where('id', $id)
            ->where('instructor_id', Auth::id())
            ->with('quizOptions')
            ->first();

        if (!$data) {
            return response()->json([
                'status'  => true,
                'message' => 'Quiz not found!!',
            ]);
        }

        foreach ($data->quizOptions as $option) {
            $option->delete();
        }

        $data->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Quiz deleted successfully!!',
        ]);
    }

    public function deleteCourse($id) {
        $data = Course::where('id', $id)
            ->where('instructor_id', Auth::id())
            ->with(
                'videos',
                'quizzes',
                'written',
                'authors',
                'ratingReview'
            )->first();

        if (!$data) {
            return response()->json([
                'status'  => false,
                'message' => 'Course not found!!',
            ]);
        }

        foreach ($data->videos as $item) {
            $item->delete();
        }

        foreach ($data->quizzes as $item) {
            $item->delete();
        }

        foreach ($data->written as $item) {
            $item->delete();
        }

        foreach ($data->authors as $item) {
            $item->delete();
        }

        foreach ($data->ratingReview as $item) {
            $item->delete();
        }

        $data->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Course deleted successfully!!',
        ]);
    }

    public function active($id) {
        $data         = Course::find($id);
        $data->status = 1;
        $data->save();

        return response()->json([
            'status'  => true,
            'message' => 'Course activated successfully!!',
        ]);
    }

    public function inactive($id) {
        $data         = Course::find($id);
        $data->status = 0;
        $data->save();

        return response()->json([
            'status'  => true,
            'message' => 'Course inactivated successfully!!',
        ]);
    }
    
     public function storeMcq(Request $request) {
        DB::beginTransaction();

        try {

            if ($request->thumbnil_image) {
                $image_file = base64_decode($request['thumbnil_image']);
                $b64_image  = '/images/mcq/' . time() . '.' . 'png';
                $success    = file_put_contents(public_path() . $b64_image, $image_file);
            }

            if ($request->details_file) {

                $image_file = base64_decode($request['details_file']);
                $b64_file   = '/images/mcq/' . time() . '.' . 'pdf';
                $success    = file_put_contents(public_path() . $b64_file, $image_file);

            }

            // if ($request->zoom_video) {

            //     $image_file = base64_decode($request['zoom_video']);
            //     $b64_video  = '/images/course/' . time() . '.' . 'mp4';
            //     $success    = file_put_contents(public_path() . $b64_video, $image_file);

            // }

            $course = Mcq::create([
                'instructor_id'       => auth()->user()->id,
                'category_id'         => $request->category_id,
                'subcategory_id'      => $request->subcategory_id,
                'childcategory_id'    => $request->childcategory_id,
                'childsubcategory_id' => $request->childsubcategory_id,
                'name'                => $request->course_name,
                'price'               => $request->price,
                'syllabus'               => $request->syllabus,
                'enrolled'               => $request->enrolled,
                'discount'            => $request->discount,
                'discount_price'      => $request->discount_price,
                'details'             => $request->details,
                'details_file'        => $b64_file ?? 'file',
                'thumbnil_image'      => $b64_image ?? 'image',
                
            ]);

            foreach ($request->video as $key => $item) {

                if ($item['image']) {

                    $image_file = base64_decode($item['image']);
                    $b64_image  = '/images/video/' . time() . '.' . 'png';
                    $success    = file_put_contents(public_path() . $b64_image, $image_file);

                }
               
                Video::create([
                    'instructor_id' => $course->instructor_id,
                    'course_id'     => $course->id,
                    'name'          => $item["video_name"],
                    'link'          => $item["video_link"],
                    'duration'      => $item["video_duration"],
                    'image'         => $b64_image,
                ]);
                
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Course store successfully!!',
                'data'    => $course,
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
