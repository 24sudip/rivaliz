<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index() {
        return view('backend.sliders.index', [
            'sliders' => Slider::latest()->get()
        ]);
    }

    public function create() {
        return view('backend.sliders.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'photo_name' => 'required|image|max:10240',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }
  $course_id = $request->course_id;
        $image = $request->file('photo_name');
        if ($image) {
            $file_name = mt_rand (10000,99999).'-'.date('YmdHis'). $image->getClientOriginalName();
            $image->move(public_path('images/sliders'), $file_name);
            $save_url = 'images/sliders/'. $file_name;
            Slider::create([
                'photo_name' => $save_url,
                'status' => $request->status,
                'course_id' => $course_id,
            ]);
            return redirect()->route('admin.sliders.index')->with('success', 'Slider Photo Added Successfully!');
        }
    }

    public function edit($id) {
        return view('backend.sliders.edit', [
            'slider' => Slider::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            // 'photo_name' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }
           $course_id = $request->course_id;
        //   dd($course_id);
        $image = $request->file('photo_name');
        if ($image) {
            unlink(Slider::findOrFail($id)->photo_name);
            $file_name = mt_rand (10000,99999).'-'.date('YmdHis'). $image->getClientOriginalName();
            $image->move(public_path('images/sliders'), $file_name);
            $save_url = 'images/sliders/'. $file_name;
            Slider::findOrFail($id)->update([
                'photo_name' => $save_url,
                'status' => $request->status,
                'course_id' => $course_id,
            ]);
            return redirect()->route('admin.sliders.index')->with('success', 'Slider Photo Updated Successfully!');
        } else {
            Slider::findOrFail($id)->update([
                'status' => $request->status,
                'course_id' => $course_id,
            ]);
            return redirect()->route('admin.sliders.index')->with('success', 'Slider Updated Successfully!');
        }
    }

    public function destroy($id) {
        $slider = Slider::findOrFail($id);
        unlink($slider->photo_name);
        $slider->delete();
        return redirect()->back()->with('success', 'Slider Deleted Successfully!');
    }
}

