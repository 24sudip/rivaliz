<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Support;
use App\Models\Quiz;
use App\Models\QuizOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SupportController extends Controller {

    public function index() {
        $supports = Support::where('instructor_id', auth()->guard('instructor')->user()->id)->orderBy('id', 'DESC')->get();

        return view('frontend.instructor.support.index', compact('supports'));
    }


    public function show($slug) {
        $support = Support::where('slug', $slug)->with('quizzes', 'quizzes.quizOptions')->first();

        return view('frontend.instructor.support.show', compact('support'));
    }


    public function delete($id) {
        $support = Support::findOrFail($id)->delete();

        return redirect()->route('instructor.support.index')->withToastSuccess('Support updated successfully!!');
    }
    
    public function active($id){
        $support = Support::find($id);
        $support->status = 1;
        $support->save();
        
        return redirect()->route('instructor.support.index')->with('success', 'Support Resolved!!');
    }


}
