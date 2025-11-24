<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller {
    public function notices() {
        $notices = Notice::orderBy('id', 'desc')->get();

        return view('backend.notices.index', compact('notices'));
    }

    public function create() {
        $courses = Course::where('status', 1)->get();
        return view('backend.notices.create', compact('courses'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ]);
        

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }


        $notices = Notice::create([
            'title'       => $request->title,
            'description' => $request->description,
            'sent_to'     => $request->sent_to,
            'course_id'   => $request->course_id,
        ]);

        return redirect()->route('admin.notice.index')->withToastSuccess('Your notices submitted successfully!!');
    }

    public function edit($id) {
        $notice = Notice::where('id', $id)->first();
        $courses = Course::where('status', 1)->get();
        
        return view('backend.notices.edit', compact('notice', 'courses'));
    }

    public function update(Request $request, $id) {
        $notice     = Notice::where('id', $id)->first();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }


        $notice->update([
            'title'       => $request->title,
            'description' => $request->description,
            'sent_to'     => $request->sent_to,
            'course_id'   => $request->course_id,
        ]);

        return to_route('admin.notice.index')->withToastSuccess('Your notices updated successfully!!');
    }

    public function active(Request $request, $id) {
        $course = Notice::findOrFail($id);

        $course->status = 1;
        $course->save();

        return redirect()->route('admin.notice.index')->withToastSuccess('Notice activated successfully!!');
    }

    public function inactive(Request $request, $id) {
        $course = Notice::findOrFail($id);

        $course->status = 0;
        $course->save();

        return redirect()->route('admin.notice.index')->withToastSuccess('Notice inactivated successfully!!');
    }

}
