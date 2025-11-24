<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{AboutTab, AboutItem};
use Illuminate\Support\Facades\Validator;
use File;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    public function index() {
        return view('backend.about-items.index', [
            'about_items'=>AboutItem::latest()->get(['id','thumbnail','title','short_description'])
        ]);
    }

    public function create() {
        return view('backend.about-items.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'thumbnail'=>'required|image|max:10240',
            'title'=>'required|max:255',
            'short_description'=>'required',
            'video'=>'required',
            'long_description'=>'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }
        $image = $request->file('thumbnail');
        if ($image) {
            // if ($about_tab && file_exists(public_path($about_tab->about_photo))) {
            //     File::delete(public_path($about_tab->about_photo));
            // }
            $file_name = mt_rand (10000,99999).'-'.date('YmdHis'). $image->getClientOriginalName();
            $image->move(public_path('images/about-item'), $file_name);
            $save_url = 'images/about-item/'. $file_name;
            AboutItem::create([
                'thumbnail'=>$save_url,
                'title'=>$request->title,
                'slug'=>Str::slug($request->title,'-'),
                'short_description'=>$request->short_description,
                'video'=>$request->video,
                'long_description'=>$request->long_description
            ]);
            return redirect()->route('admin.about-item.index')->with('success', 'AboutItem Created Successfully!');
        }
    }

    public function show($id) {
        return view('backend.about-items.show', [
            'about_item'=>AboutItem::findOrFail($id)
        ]);
    }

    public function edit($id) {
        return view('backend.about-items.edit', [
            'about_item'=>AboutItem::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'thumbnail'=>'image|max:10240',
            'title'=>'required|max:255',
            'short_description'=>'required',
            'video'=>'required',
            'long_description'=>'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }
        $image = $request->file('thumbnail');
        $about_item = AboutItem::findOrFail($id);
        if ($image) {
            if (file_exists(public_path($about_item->thumbnail))) {
                @unlink(public_path($about_item->thumbnail));
            }
            $file_name = mt_rand (10000,99999).'-'.date('YmdHis'). $image->getClientOriginalName();
            $image->move(public_path('images/about-item'), $file_name);
            $save_url = 'images/about-item/'. $file_name;
        }
        AboutItem::find($id)->update([
            'thumbnail'=>(isset($save_url) ? $save_url : $about_item->thumbnail),
            'title'=>$request->title,
            'slug'=>Str::slug($request->title,'-'),
            'short_description'=>$request->short_description,
            'video'=>$request->video,
            'long_description'=>$request->long_description
        ]);
        return redirect()->route('admin.about-item.index')->with('success', 'AboutItem Updated Successfully!');
    }

    public function destroy($id) {
        $about_item = AboutItem::findOrFail($id);
        unlink($about_item->thumbnail);
        $about_item->delete();
        return redirect()->back()->with('success', 'AboutItem Deleted Successfully!');
    }

    public function AboutTabIndex() {
        return view('backend.about-tab.index', [
            'about_tab' => AboutTab::first()
        ]);
    }

    public function AboutTabUpdate(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'about_photo'=>'image|max:10240',
            'about_text'=>'required',
            'educational'=>'required',
            'work_profile'=>'required',
            'academic'=>'required',
            'achievements'=>'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }
        $about_tab = AboutTab::first();
        $image = $request->file('about_photo');
        // file_exists()
        if ($image) {
            if ($about_tab && file_exists(public_path($about_tab->about_photo))) {
                @unlink(public_path($about_tab->about_photo));
            }
            $file_name = mt_rand (10000,99999).'-'.date('YmdHis'). $image->getClientOriginalName();
            $image->move(public_path('images/about-tab'), $file_name);
            $save_url = 'images/about-tab/'. $file_name;
        }
        AboutTab::updateOrCreate(
            ['id'=>$id],
            [
                'about_text'=>$request->about_text,
                'educational'=>$request->educational,
                'work_profile'=>$request->work_profile,
                'academic'=>$request->academic,
                'achievements'=>$request->achievements,
                'about_photo'=>(isset($save_url) ? $save_url : $about_tab->about_photo),
                // 'image'=>!empty($imagePath) ? $imagePath : $hero->image,
            ]
        );
        return redirect()->route('admin.about-tab.index')->with('success', 'AboutTab Updated!');
    }
}
