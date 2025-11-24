<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\Support;

class DashboardController extends Controller {
    public function dashboard() {
        $data                     = [];
        $data["total_course"]     = Course::where('status', 1)->count();
        $data["total_student"]    = Student::count();
        $data["course_sold"]      = Course::sum('enrolled');
        $data["course_revenue"]   = Course::sum('revenue');
        $data["total_instructor"] = Instructor::count();
        $data["commision_paid"]   = Course::sum('commision_paid');
        $data["commision_due"]    = Course::sum('commision_due');
        $data["pay_request"] = Course::where('commision_paystatus', 0)->pluck('instructor_id')->unique()->count();

        return view('backend.dashboard', compact('data'));
    }
    
    
    public function supports(){
        $supports = Support::orderBy('id', 'DESC')->get();
        return view('backend.supports', compact('supports'));
    }
}
