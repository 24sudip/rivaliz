<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller {
    
    public function index() {
        $subcategories = Subcategory::with('category')->get();

        return view('backend.subcategory.index', compact('subcategories'));
    }

    public function create() {
        $categories = Category::where('status', 1)->get();

        return view('backend.subcategory.create', compact('categories'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,.gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/subcategory/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        Subcategory::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'image'       => $final_name1,
        ]);

        return to_route('admin.subcategory.index')->withToastSuccess('New data added successfully!!');
    }

    public function edit(Subcategory $subcategory) {
        $categories = Category::where('status', 1)->get();

        return view('backend.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,.gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($subcategory->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/category/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $subcategory->image = $final_name1;
                $subcategory->save();

            }

        }
        $subcategory->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
        ]);

        return to_route('admin.subcategory.index')->with('success','Data updated successfully!!');
    }

    public function active(Request $request, Subcategory $subcategory) {
        $subcategory->status = 1;
        $subcategory->save();

        return to_route('admin.subcategory.index')->withToastSuccess('Data activated successfully!!');
    }

    public function inactive(Request $request, Subcategory $subcategory) {
        $subcategory->status = 0;
        $subcategory->save();

        return to_route('admin.subcategory.index')->withToastSuccess('Data inactivated successfully!!');
    }

}
