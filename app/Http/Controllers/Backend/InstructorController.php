<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class InstructorController extends Controller {
    public function index() {
        $instructors = Instructor::all();

        return view('backend.instructors.index', compact('instructors'));
    }

    public function create() {
        return view('backend.instructors.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'phone'    => 'required|unique:instructors,phone',
            'email'    => 'required|email|unique:instructors,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $final_name = null;

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/instructor/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name   = $img_gen . '.' . $image_ext;
                $final_name = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        Instructor::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => bcrypt($request->password),
            'phone'       => $request->phone,
            'gender'      => $request->gender,
            'dob'         => $request->dob,
            'profession'  => $request->profession,
            'institution' => $request->institution,
            'department'  => $request->department,
            'address'     => $request->address,
            'image'       => $final_name,
            'status'      => 1,
        ]);

        return to_route('admin.instructors.index')->with('success', 'New data added successfully!!');
    }

    public function edit(Instructor $instructor) {
        return view('backend.instructors.edit', compact('instructor'));
    }

    public function update(Request $request, Instructor $instructor) {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'phone'    => 'required',
            'email'    => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $final_name = $instructor->image;

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($instructor->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/instructor/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name   = $img_gen . '.' . $image_ext;
                $final_name = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $instructor->image = $final_name;
                $instructor->save();

            }

        }

        $instructor->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'gender'      => $request->gender,
            'dob'         => $request->dob,
            'profession'  => $request->profession,
            'institution' => $request->institution,
            'department'  => $request->department,
            'address'     => $request->address,
            'image'       => $final_name,
        ]);

        return to_route('admin.instructors.index')->with('success', 'Data updated successfully!!');
    }

    public function destroy(Instructor $instructor){
        $instructor->delete();
        return to_route('admin.instructors.index')->with('success', 'Data deleted successfully!!');
    }

    public function active(Request $request, Instructor $instructor) {
        $instructor->status = 1;
        $instructor->save();

        return to_route('admin.instructors.index')->with('success', 'Data activated successfully!!');
    }

    public function inactive(Request $request, Instructor $instructor) {
        $instructor->status = 0;
        $instructor->save();

        return to_route('admin.instructors.index')->with('success', 'Data inactivated successfully!!');
    }

    public function payrequest(){
        $instructor_Ids = Course::where('commision_paystatus', 0)->pluck('instructor_id');
        $instructors = Instructor::whereIn('id', $instructor_Ids)->get();

        foreach($instructors as $instructor){
            $commision = Course::where(['instructor_id'=> $instructor->id, 'commision_paystatus'=>0])->sum('commision_due');
            $instructor->commision_due = $commision;
        }

        return view('backend.instructors.payrequest', compact('instructors'));
    }

    public function duePayment(Instructor $instructor){
        $courses = Course::where(['instructor_id'=> $instructor->id, 'commision_paystatus'=>0])->get();
        foreach($courses as $course){
            $course->commision_paystatus = 1;
            $course->commision_paid += $course->commision_due;
            $course->commision_due = 0;
            $course->save();
        }
        return redirect()->back()->with('success', 'Payment completed');

    }

}
