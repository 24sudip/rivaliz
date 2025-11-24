<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller {
    public function blogs() {
        $blogs = Blog::orderBy('id', 'desc')->get();

        return view('backend.blogs.index', compact('blogs'));
    }

    public function create() {
        return view('backend.blogs.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/blogs/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name       = $img_gen . '.' . $image_ext;
                $thumbnil_image = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        if ($request->hasFile('banner')) {

            $banner_file = $request->file('banner');

            if ($banner_file) {

                $img_gen    = hexdec(uniqid());
                $banner_url = 'images/blogs/';
                $banner_ext = strtolower($banner_file->getClientOriginalExtension());

                $img_name        = $img_gen . '.' . $banner_ext;
                $thumbnil_banner = $banner_url . $img_gen . '.' . $banner_ext;

                $banner_file->move($banner_url, $img_name);
            }

        }

        $blogs = Blog::create([
            'title'       => $request->title,
            'image'       => $thumbnil_image ?? null,
            'banner'      => $thumbnil_banner ?? null,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.blogs.index')->withToastSuccess('Your blogs submitted successfully!!');
    }

    public function edit($id) {
        $event = Blog::where('id', $id)->first();

        return view('backend.blogs.edit', compact('event'));
    }

    public function update(Request $request, $id) {
        $event     = Blog::where('id', $id)->first();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                if ($event->thumbnil_image) {
                    $thumbnil_image_image_path = public_path($event->thumbnil_image);

                    if (File::exists($thumbnil_image_image_path)) {
                        File::delete($thumbnil_image_image_path);
                    }

                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/blogs/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name       = $img_gen . '.' . $image_ext;
                $thumbnil_image = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $event->update(['image' => $thumbnil_image]);
            }

        }

        if ($request->hasFile('banner')) {

            $banner_file = $request->file('banner');

            if ($banner_file) {

                if ($event->thumbnil_banner) {
                    $thumbnil_banner_banner_path = public_path($event->thumbnil_banner);

                    if (File::exists($thumbnil_banner_banner_path)) {
                        File::delete($thumbnil_banner_banner_path);
                    }

                }

                $img_gen    = hexdec(uniqid());
                $banner_url = 'images/blogs/';
                $banner_ext = strtolower($banner_file->getClientOriginalExtension());

                $img_name        = $img_gen . '.' . $banner_ext;
                $thumbnil_banner = $banner_url . $img_gen . '.' . $banner_ext;

                $banner_file->move($banner_url, $img_name);
                $event->update(['banner' => $thumbnil_banner]);
            }

        }

        $event->update([
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        return to_route('admin.blogs.index')->withToastSuccess('Your blogs updated successfully!!');
    }

    public function active(Request $request, $id) {
        $course = Blog::findOrFail($id);

        $course->status = 1;
        $course->save();

        return redirect()->route('admin.blogs.index')->withToastSuccess('Blog activated successfully!!');
    }

    public function inactive(Request $request, $id) {
        $course = Blog::findOrFail($id);

        $course->status = 0;
        $course->save();

        return redirect()->route('admin.blogs.index')->withToastSuccess('Blog inactivated successfully!!');
    }

}
