<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Promovideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromovideoController extends Controller {

    public function index() {
        $promovideos = Promovideo::all();
        return view('backend.promovideo.index', compact('promovideos'));
    }

    public function create() {
        return view('backend.promovideo.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title'       => 'required',
            'link'        => 'required',
            'description' => 'required',
            'video'       => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        Promovideo::create([
            'title'       => $request->title,
            'link'        => $request->link,
            'description' => $request->description,
            'video'       => $request->video,
        ]);

        return redirect()->route('admin.promovideo.index')->with('success', 'Promovideo added successfully!!');

    }

    public function edit($id) {
        $video = Promovideo::find($id);

        return view('backend.promovideo.edit', compact('video'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'title'       => 'required',
            'link'        => 'required',
            'description' => 'required',
            'video'       => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        Promovideo::find($id)->update([
            'title'       => $request->title,
            'link'        => $request->link,
            'description' => $request->description,
            'video'       => $request->video,
        ]);

        return redirect()->route('admin.promovideo.index')->with('success', 'Promovideo updated successfully!!');
    }

    public function destroy(Promovideo $promovideo) {
        $promovideo->delete();

        return redirect()->back()->with('success', 'Promovideo deleted successfully!!');
    }
}
