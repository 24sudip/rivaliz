<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Studentbenefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class StudentbenefitController extends Controller {
    public function index() {
        $studentbenefits = Studentbenefit::all();

        return view('backend.studentbenefit.index', compact('studentbenefits'));
    }

    public function create() {
        return view('backend.studentbenefit.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $image_file = $request->file('image');

        if ($image_file) {

            $img_gen   = hexdec(uniqid());
            $image_url = 'images/promotions/';
            $image_ext = strtolower($image_file->getClientOriginalExtension());

            $img_name = $img_gen . '.' . $image_ext;
            $imageUrl = $image_url . $img_gen . '.' . $image_ext;

            $image_file->move($image_url, $img_name);
        }

        Studentbenefit::create([
            'title'       => $request->title,
            'link'        => $request->link,
            'description' => $request->description,
            'image'       => $imageUrl,
        ]);

        return redirect()->route('admin.studentbenefit.index')->with('success', 'Studentbenefit added successfully!!');

    }

    public function edit($id) {
        $studentbenefit = Studentbenefit::find($id);

        return view('backend.studentbenefit.edit', compact('studentbenefit'));
    }

    public function update(Request $request, $id) {
        
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $studentbenefit = Studentbenefit::find($id);
        $studentbenefit->update([
            'title'       => $request->title,
            'link'        => $request->link,
            'description' => $request->description,
        ]);

        $image_file = $request->file('image');

        if ($image_file) {

            if (File::exists($studentbenefit->image)) {
                File::delete($studentbenefit->image);
            }

            $img_gen   = hexdec(uniqid());
            $image_url = 'images/promotions/';
            $image_ext = strtolower($image_file->getClientOriginalExtension());

            $img_name = $img_gen . '.' . $image_ext;
            $imageUrl = $image_url . $img_gen . '.' . $image_ext;

            $image_file->move($image_url, $img_name);

            $studentbenefit->update(['image' => $imageUrl]);
        }

        return redirect()->route('admin.studentbenefit.index')->with('success', 'Studentbenefit updated successfully!!');
    }

    public function destroy(Studentbenefit $studentbenefit) {
        $studentbenefit->delete();

        return redirect()->back()->with('success', 'Studentbenefit deleted successfully!!');
    }

}
