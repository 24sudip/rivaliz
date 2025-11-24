<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Childcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ChildcategoryController extends Controller {
    public function index() {
        $childcategories = Childcategory::with('subcategory')->get();

        return view('backend.childcategory.index', compact('childcategories'));
    }

    public function create() {
        $subcategories = Subcategory::where('status', 1)->get();

        return view('backend.childcategory.create', compact('subcategories'));
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
                $image_url = 'images/childcategory/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        Childcategory::create([
            'subcategory_id' => $request->subcategory_id,
            'name'           => $request->name,
            'image'          => $final_name1,
        ]);

        return to_route('admin.childcategory.index')->withToastSuccess('New data added successfully!!');
    }

    public function edit(Childcategory $childcategory) {
        $subcategories = Subcategory::where('status', 1)->get();

        return view('backend.childcategory.edit', compact('childcategory', 'subcategories'));
    }

    public function update(Request $request, Childcategory $childcategory) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($childcategory->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/category/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $childcategory->image = $final_name1;
                $childcategory->save();

            }

        }

        $childcategory->update([
            'subcategory_id' => $request->subcategory_id,
            'name'           => $request->name,
        ]);

        return to_route('admin.childcategory.index')->withToastSuccess('Data updated successfully!!');
    }

    public function active(Request $request, Childcategory $childcategory) {
        $childcategory->status = 1;
        $childcategory->save();

        return to_route('admin.childcategory.index')->withToastSuccess('Data activated successfully!!');
    }

    public function inactive(Request $request, Childcategory $childcategory) {
        $childcategory->status = 0;
        $childcategory->save();

        return to_route('admin.childcategory.index')->withToastSuccess('Data inactivated successfully!!');
    }

}
