<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller {
    public function edit() {
        $banner = Banner::first();

        return view('backend.banner.edit', compact('banner'));
    }

    public function update(Request $request) {
        $banner                  = Banner::first();
        $banner->title           = $request->title;
        $banner->description     = $request->description;
        $banner->additional_text = $request->additional_text;

        if ($request->hasFile('image1')) {

            $image1_file = $request->file('image1');

            if ($image1_file) {

                $image1_path = public_path($banner->image1);

                if (File::exists($image1_path)) {
                    File::delete($image1_path);
                }

                $img_gen    = hexdec(uniqid());
                $image1_url = 'frontend/img/uploads/';
                $image1_ext = strtolower($image1_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image1_ext;
                $final_name1 = $image1_url . $img_gen . '.' . $image1_ext;

                $image1_file->move($image1_url, $img_name);
                $banner->image1 = $final_name1;
            }

        }

        if ($request->hasFile('image2')) {

            $image2_file = $request->file('image2');

            if ($image2_file) {

                $image2_path = public_path($banner->image2);

                if (File::exists($image2_path)) {
                    File::delete($image2_path);
                }

                $img_gen    = hexdec(uniqid());
                $image2_url = 'frontend/img/uploads/';
                $image2_ext = strtolower($image2_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image2_ext;
                $final_name2 = $image2_url . $img_gen . '.' . $image2_ext;

                $image2_file->move($image2_url, $img_name);
                $banner->image2 = $final_name2;
            }

        }

        $banner->save();

        return redirect()->back()->with('success', 'Banner updated');
    }

}
