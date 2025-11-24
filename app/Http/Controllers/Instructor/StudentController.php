<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Enroll;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Quizsubmit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller {
    
    public function students() {
        $courseIds     = Course::where('instructor_id', Auth::guard('instructor')->user()->id)->pluck('id');
        $studentIds     = Enroll::whereIn('course_id', $courseIds)->pluck('student_id')->unique();

        $students = Student::whereIn('id', $studentIds)->get();
        
        return view('frontend.instructor.students.index', compact('students'));
    }
    
    public function enrolled(Request $request){
        $student = Student::find($request->student_id);
        $enrolls     = Enroll::where('student_id', $student->id)->orderBy('id', 'DESC')->get()->unique('course_id');
        
        foreach($enrolls as $enroll){
            $moduleIds = Module::where('course_id', $enroll->course_id)->pluck('id');
            $lessonIds = Lesson::whereIn('module_id', $moduleIds)->pluck('id');
            $quizIds = Quiz::whereIn('lesson_id', $lessonIds)->pluck('id');
            $quizSubmits = Quizsubmit::whereIn('quiz_id', $quizIds)->where('student_id', $student->id)->get();
            
            $enroll->totalModule = $moduleIds->count();
            $enroll->totalQuiz = $quizIds->count();
            $enroll->quizSubmit = $quizSubmits;
        }
        
        // return $enrolls;
        
        return view('frontend.instructor.students.enrolled', compact('student', 'enrolls'));
    }


    public function enrollDetails(Request $request){
        $enroll = Enroll::find($request->enroll_id);

        $moduleIds = Module::where('course_id', $enroll->course->id)->pluck('id');
        $lessonIds = Lesson::whereIn('module_id', $moduleIds)->pluck('id');
        $quizIds = Quiz::whereIn('lesson_id', $lessonIds)->pluck('id');
        $quizSubmits = Quizsubmit::whereIn('quiz_id', $quizIds)->where('student_id', $enroll->student->id)->get();

        return view('frontend.instructor.students.enrolldetails', compact('enroll', 'quizSubmits'));
    }
    

}
