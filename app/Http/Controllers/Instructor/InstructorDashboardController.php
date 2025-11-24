<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Notice;

class InstructorDashboardController extends Controller {
    public function dashboard() {
        $id = auth()->guard('instructor')->user()->id;

        // $courses                     = Course::where(['instructor_id' => $id]);
        $data                        = [];
        $data["total_course"]        = Course::where(['instructor_id' => $id])->count();
        $data["course_sold"]         = Course::where(['instructor_id' => $id])->sum('enrolled');
        $data["total_commision"]     = Course::where(['instructor_id' => $id])->sum('commision_amount');
        $data["commision_paid"]      = Course::where(['instructor_id' => $id])->sum('commision_paid');
        $data["commision_due"]       = Course::where(['instructor_id' => $id])->whereNull('commision_paystatus')->sum('commision_due');
        $data["commision_requested"] = Course::where(['instructor_id' => $id])->where('commision_paystatus', 0)->sum('commision_due');
        $data["notices"]             = Notice::whereIn('sent_to', [0, 1])->whereNull('course_id')->where('status', 1)->orderBy('id', 'DESC')->get();

        return view('frontend.instructor.dashboard', compact('data'));
    }

    public function payrequest() {
        $id      = auth()->guard('instructor')->user()->id;
        $courses = Course::where(['instructor_id' => $id])->whereNull('commision_paystatus')->get();

        foreach ($courses as $course) {
            $course->commision_paystatus = 0;
            $course->save();
        }

        return redirect()->back()->with('success', 'Payment request sent');

    }

}
