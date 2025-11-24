<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller {
    public function index() {
        $categories = Category::all();

        return view('backend.category.index', compact('categories'));
    }

    public function create() {
        return view('backend.category.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:categories',
        ]);
        // 'image' => 'required|mimes:jpg,jpeg,png,.gif',

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/category/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;
                $image_file->move($image_url, $img_name);
            }
        }

        Category::create([
            'name'        => $request->name,
            'image'       => isset($final_name1) ? $final_name1 : null,
            'icon'        => $request->icon ?? null,
            'description' => $request->description ?? null,
            'front_page'  => $request->front_page ? true : false,
            'favourite'  => $request->favourite ? true : false,
        ]);

        return to_route('admin.category.index')->with('success','New data added successfully!!');
    }

    public function edit(Category $category) {
        return view('backend.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:categories,name,' . $category->id,
            'image' => 'nullable|mimes:jpg,jpeg,png,.gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            if ($image_file) {

                $image_path = public_path($category->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/category/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $category->image = $final_name1;
                $category->save();
            }
        }

        $category->update([
            'name'        => $request->name,
            'icon'        => $request->icon ?? null,
            'description' => $request->description ?? null,
            'front_page'  => $request->front_page ? true : false,
            'favourite'  => $request->favourite ? true : false,
        ]);

        return to_route('admin.category.index')->with('success','Data updated successfully!!');
    }

    public function active(Request $request, Category $category) {
        $category->status = 1;
        $category->save();

        return to_route('admin.category.index')->with('success','Data activated successfully!!');
    }

    public function inactive(Request $request, Category $category) {
        $category->status = 0;
        $category->save();

        return to_route('admin.category.index')->with('success','Data inactivated successfully!!');
    }

    public function  delete(Request $request, Category $category) {
        $category->delete();

        $image_path = public_path($category->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        return to_route('admin.category.index')->with('success','Data Deleted successfully!!');
    }
}
