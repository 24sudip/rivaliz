<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Adcategory;
use App\Models\Advertisement;
use App\Models\Podcast;
use Illuminate\Http\Request;
use App\Models\Freevideo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AdController extends Controller {
    public function categories() {
        $categories = Adcategory::all();

        return view('backend.ads.category.index', compact('categories'));
    }

    public function categoryCreate() {
        return view('backend.ads.category.create');
    }

    public function categorystore(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $adcategory        = new Adcategory();
        $adcategory->title = $request->title;
        $adcategory->save();

        return redirect()->route('admin.ads.categories')->with('success', 'Category added!');
    }

    public function categoryinactive(Request $request) {
        $adcategory         = Adcategory::find($request->id);
        $adcategory->status = false;
        $adcategory->save();

        return redirect()->route('admin.ads.categories')->with('error', 'Category Inactivated!');
    }

    public function categoryactive(Request $request) {
        $adcategory         = Adcategory::find($request->id);
        $adcategory->status = true;
        $adcategory->save();

        return redirect()->route('admin.ads.categories')->with('success', 'Category Activated!');
    }




    public function  podcastinactive(Request $request) {
        $podcast        = Podcast::find($request->id);
        $podcast->status = false;
        $podcast->save();

        return redirect()->route('admin.podcast.index')->with('success', 'Podcast Inactivated!');
    }

    public function  podcastactive(Request $request) {
        $podcast        = Podcast::find($request->id);
        $podcast->status = true;
        $podcast->save();

        return redirect()->route('admin.podcast.index')->with('success', 'Podcast Activated!');
    }

  public function  freevideosinactive(Request $request) {
        $podcast        = Freevideo::find($request->id);
        $podcast->status = false;
        $podcast->save();

        return redirect()->back()->with('success', 'Freevideos Inactivated!');
    }

    public function freevideosactive(Request $request) {
        $podcast        = Freevideo::find($request->id);
        $podcast->status = true;
        $podcast->save();

        return redirect()->back()->with('success', 'Freevideos Activated!');
    }



    public function categoryedit($id) {
        $adcategory = Adcategory::find($id);

        return view('backend.ads.category.edit', compact('adcategory'));
    }

    public function categoryupdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $adcategory        = Adcategory::find($request->hidden_id);
        $adcategory->title = $request->title;
        $adcategory->save();

        return redirect()->route('admin.ads.categories')->with('success', 'Category Updated!');
    }

    public function categorydelete($id) {
        $adcategory = Adcategory::find($id);
        $adcategory->delete();

        return redirect()->route('admin.ads.categories')->with('success', 'Category deleted!');
    }

    public function manage() {
        $ads = Advertisement::with('adcategory')->get();

        return view('backend.ads.index', compact('ads'));
    }

    public function create() {
        $adcategories = Adcategory::where('status', 1)->get();

        return view('backend.ads.create', compact('adcategories'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'adcategory_id' => 'required',
            'link'          => 'required',
            'image'         => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $image_file = $request->file('image');

        if ($image_file) {

            $img_gen   = hexdec(uniqid());
            $image_url = 'images/ads/';
            $image_ext = strtolower($image_file->getClientOriginalExtension());

            $img_name = $img_gen . '.' . $image_ext;
            $imageUrl = $image_url . $img_gen . '.' . $image_ext;

            $image_file->move($image_url, $img_name);
        }

        $ads = Advertisement::create([
            'title'         => $request->title,
            'adcategory_id' => $request->adcategory_id,
            'link'          => $request->link,
            'image'         => $imageUrl,
        ]);

        return redirect()->route('admin.ads.manage')->with('success', 'Ad created!');
    }

    public function edit($id) {
        $ad           = Advertisement::find($id);
        $adcategories = Adcategory::where('status', 1)->get();

        return view('backend.ads.edit', compact('ad', 'adcategories'));
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'adcategory_id' => 'required',
            'link'          => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $ads         = Advertisement::find($request->hidden_id);
        $ads_updated = $ads->update([
            'title'         => $request->title,
            'adcategory_id' => $request->adcategory_id,
            'link'          => $request->link,
        ]);

        $image_file = $request->file('image');

        if ($image_file) {

            if (File::exists($ads->image)) {
                File::delete($ads->image);
            }

            $img_gen   = hexdec(uniqid());
            $image_url = 'images/ads/';
            $image_ext = strtolower($image_file->getClientOriginalExtension());

            $img_name = $img_gen . '.' . $image_ext;
            $imageUrl = $image_url . $img_gen . '.' . $image_ext;

            $image_file->move($image_url, $img_name);

            $ads->update(['image' => $imageUrl]);
        }

        return redirect()->route('admin.ads.manage')->with('success', 'Ad updated!');
    }

    public function active($id) {
        Advertisement::find($id)->update(['status' => true]);

        return redirect()->route('admin.ads.manage')->with('success', 'Ad updated!');
    }

    public function inactive($id) {
        Advertisement::find($id)->update(['status' => false]);

        return redirect()->route('admin.ads.manage')->with('success', 'Ad updated!');
    }
}
