<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Childsubcategory;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Subcategory;
use App\Models\Video;
use App\Models\Weekschedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class LiveCourseController extends Controller {
    public function courses() {
        $courses = Course::orderBy('id', 'desc')->where('category_id', 0)->get();

        return view('backend.livecourses.index', compact('courses'));
    }

    public function create() {
        $data                = [];
        $data['categories']  = Category::where('status', 1)->where('id', 0)->get();
        $data['instructors'] = Instructor::where('status', 1)->get();

        return view('backend.livecourses.create', $data);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'details'        => 'required',
            'course_name'    => 'required',
            'price'          => 'required',
            'thumbnil_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'details_file'   => 'nullable|mimes:pdf',
            'instructor'     => 'required',
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

        if ($request->hasFile('certificate_image')) {

            $certificate_image_file = $request->file('certificate_image');

            if ($certificate_image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/courses/certificate/';
                $image_ext = strtolower($certificate_image_file->getClientOriginalExtension());

                $img_name          = $img_gen . '.' . $image_ext;
                $certificate_image = $image_url . $img_gen . '.' . $image_ext;

                $certificate_image_file->move($image_url, $img_name);
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
            'instructor_id'       => $request->instructor,
            'category_id'         => $request->category_id,
            'subcategory_id'      => $request->subcategory_id,
            'childcategory_id'    => $request->childcategory_id,
            'childsubcategory_id' => $request->childsubcategory_id,
            'name'                => $request->course_name,
            'price'               => $request->price - $request->discount_price,
            'old_price'           => $request->price,
            'discount'            => $request->discount,
            'discount_price'      => $request->discount_price,
            'instructor_commision'=> $request->instructor_commision,
            'details'             => $request->details,
            'details_file'        => $details_file ?? null,
            'thumbnil_image'      => $thumbnil_image ?? null,
            'certificate_image'   => $certificate_image ?? null,
            'certificate_text'    => $request->certificate_text,
        ]);

        return redirect()->route('admin.livecourses.edit', $course->id)->with('success', 'Your course Added!! Now add schedule');
    }

    public function edit($id) {
        $course      = Course::where('id', $id)->first();
        $categories  = Category::where('status', 1)->where('id', 0)->get();
        $sub         = Subcategory::where('id', $course->subcategory_id)->where('status', 1)->get();
        $child       = Childcategory::where('id', $course->childcategory_id)->where('status', 1)->get();
        $childsub    = Childsubcategory::where('id', $course->childsubcategory_id)->where('status', 1)->get();
        $instructors = Instructor::where('status', 1)->get();

        return view('backend.livecourses.edit', compact('course', 'categories', 'sub', 'child', 'childsub', 'instructors'));
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

        if ($request->hasFile('certificate_image')) {

            $certificate_image_file = $request->file('certificate_image');

            if ($certificate_image_file) {

                if ($course->certificate_image) {
                    $certificate_image_image_path = public_path($course->certificate_image);

                    if (File::exists($certificate_image_image_path)) {
                        File::delete($certificate_image_image_path);
                    }

                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/courses/certificate/';
                $image_ext = strtolower($certificate_image_file->getClientOriginalExtension());

                $img_name          = $img_gen . '.' . $image_ext;
                $certificate_image = $image_url . $img_gen . '.' . $image_ext;

                $certificate_image_file->move($image_url, $img_name);
                $course->update(['certificate_image' => $certificate_image]);
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
            'instructor_commision'=> $request->instructor_commision,
            'details'             => $request->details,
            'certificate_text'    => $request->certificate_text,
        ]);

        return to_route('admin.livecourses.index')->with('success', 'Your courses updated successfully!!');
    }

    public function active(Request $request, $id) {
        $course = Course::findOrFail($id);

        $course->status = 1;
        $course->save();

        return redirect()->route('admin.livecourses.index')->with('success', 'Course activated successfully!!');
    }

    public function inactive(Request $request, $id) {
        $course = Course::findOrFail($id);

        $course->status = 0;
        $course->save();

        return redirect()->route('admin.livecourses.index')->with('success', 'Course inactivated successfully!!');
    }

    public function delete($id) {
        Author::where('course_id', $id)->delete();
        Video::where('course_id', $id)->delete();
        Course::find($id)->delete();

        return redirect()->back()->with('success', 'Course deleted successfully');
    }

    private function changeTimeToHourOnly($time) {
        $parsedTime   = Carbon::parse($time);
        $hourOnlyTime = $parsedTime->format('H:00:00');

        return $hourOnlyTime;
    }

    public function schedulestore(Request $request) {
        $schedule             = new Weekschedule();
        $schedule->title      = $request->title;
        $schedule->weekday    = $request->weekday;
        $schedule->course_id  = $request->course_id;
        $schedule->start_time = $this->changeTimeToHourOnly($request->input('start_time'));
        $schedule->end_time   = $this->changeTimeToHourOnly($request->input('end_time'));

        $schedule->location = $request->location;
        $schedule->save();

        return redirect()->back()->with('success', "Schedule Added!");

    }

    public function scheduleedit(Request $request) {
        $schedule          = Weekschedule::find($request->hidden_id);
        $schedule->title   = $request->title;
        $schedule->weekday = $request->weekday;

        $schedule->start_time = $this->changeTimeToHourOnly($request->input('start_time'));
        $schedule->end_time   = $this->changeTimeToHourOnly($request->input('end_time'));

        $schedule->location = $request->location;
        $schedule->save();

        return redirect()->back()->with('success', "Schedule Updated!");

    }

}
