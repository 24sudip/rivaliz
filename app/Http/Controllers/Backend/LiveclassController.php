<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Liveclass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LiveclassController extends Controller {
    public function liveclasses() {
        $liveclasses = Liveclass::orderBy('id', 'desc')->get();

        return view('backend.liveclasses.index', compact('liveclasses'));
    }

    public function create() {
        $courses = Course::where('status', 1)->get();

        return view('backend.liveclasses.create', compact('courses'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'link'      => 'required',
            'course_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->messages()->first());
        }

        $course = Course::find($request->course_id);

        $liveclasses = Liveclass::create([
            'name'          => $request->name,
            'scheduled_at'  => $request->scheduled_at,
            'duration'      => $request->duration,
            'course_id'     => $request->course_id,
            'description'   => $request->description,
            'link'          => $request->link,
            'instructor_id' => $course->instructor_id,
        ]);

        return redirect()->route('admin.liveclass.index')->withToastSuccess('Your liveclasses submitted successfully!!');
    }

    public function edit($id) {
        $class   = Liveclass::where('id', $id)->first();
        $courses = Course::where('status', 1)->get();

        return view('backend.liveclasses.edit', compact('class', 'courses'));
    }

    public function update(Request $request, $id) {
        $event     = Liveclass::where('id', $id)->first();
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'link'      => 'required',
            'course_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->messages()->first());
        }

        $course = Course::find($request->course_id);
        $event->update([
            'name'          => $request->name,
            'scheduled_at'  => $request->scheduled_at,
            'duration'      => $request->duration,
            'course_id'     => $request->course_id,
            'description'   => $request->description,
            'link'          => $request->link,
            'instructor_id' => $course->instructor_id,
        ]);

        return to_route('admin.liveclass.index')->withToastSuccess('Your liveclasses upscheduled_atd successfully!!');
    }

}
