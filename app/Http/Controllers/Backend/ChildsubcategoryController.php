<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Childcategory;
use App\Models\Childsubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ChildsubcategoryController extends Controller {
    public function index() {
        $childsubcategories = Childsubcategory::with('childcategory')->get();

        return view('backend.childsubcategory.index', compact('childsubcategories'));
    }

    public function create() {
        $childcategories = Childcategory::where('status', 1)->get();

        return view('backend.childsubcategory.create', compact('childcategories'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/childsubcategory/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        Childsubcategory::create([
            'childcategory_id' => $request->childcategory_id,
            'name'             => $request->name,
            'image'            => $final_name1,
        ]);

        return to_route('admin.childsubcategory.index')->withToastSuccess('New data added successfully!!');
    }

    public function edit(Childsubcategory $childsubcategory) {
        $childcategories = Childcategory::where('status', 1)->get();

        return view('backend.childsubcategory.edit', compact('childsubcategory', 'childcategories'));
    }

    public function update(Request $request, Childsubcategory $childsubcategory) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($childsubcategory->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/childsubcategory/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $childsubcategory->image = $final_name1;
                $childsubcategory->save();

            }

        }

        $childsubcategory->update([
            'childcategory_id' => $request->childcategory_id,
            'name'           => $request->name,
        ]);

        return to_route('admin.childsubcategory.index')->withToastSuccess('Data updated successfully!!');
    }

    public function active(Request $request, Childsubcategory $childsubcategory) {
        $childsubcategory->status = 1;
        $childsubcategory->save();

        return to_route('admin.childsubcategory.index')->withToastSuccess('Data activated successfully!!');
    }

    public function inactive(Request $request, Childsubcategory $childsubcategory) {
        $childsubcategory->status = 0;
        $childsubcategory->save();

        return to_route('admin.childsubcategory.index')->withToastSuccess('Data inactivated successfully!!');
    }

}
