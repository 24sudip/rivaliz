<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller {
    public function events() {
        $events = Event::orderBy('id', 'desc')->get();

        return view('backend.events.index', compact('events'));
    }

    public function create() {
        return view('backend.events.create');
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
                $image_url = 'images/events/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name       = $img_gen . '.' . $image_ext;
                $thumbnil_image = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        $events = Event::create([
            'title'       => $request->title,
            'image'       => $thumbnil_image ?? null,
            'date'        => $request->date,
            'time'        => $request->time,
            'location'    => $request->location,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.events.index')->withToastSuccess('Your events submitted successfully!!');
    }

    public function edit($id) {
        $event = Event::where('id', $id)->first();

        return view('backend.events.edit', compact('event'));
    }

    public function update(Request $request, $id) {
        $event     = Event::where('id', $id)->first();
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
                $image_url = 'images/events/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name       = $img_gen . '.' . $image_ext;
                $thumbnil_image = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $event->update(['thumbnil_image' => $thumbnil_image]);
            }

        }

        $event->update([
            'title'       => $request->title,
            'date'        => $request->date,
            'time'        => $request->time,
            'location'    => $request->location,
            'description' => $request->description,
        ]);

        return to_route('admin.events.index')->withToastSuccess('Your events updated successfully!!');
    }

    public function active(Request $request, $id) {
        $course = Event::findOrFail($id);

        $course->status = 1;
        $course->save();

        return redirect()->route('admin.events.index')->withToastSuccess('Event activated successfully!!');
    }

    public function inactive(Request $request, $id) {
        $course = Event::findOrFail($id);

        $course->status = 0;
        $course->save();

        return redirect()->route('admin.events.index')->withToastSuccess('Event inactivated successfully!!');
    }
      public function destroy(Request $request, $id) {
        $course = Event::findOrFail($id);

        $course->delete();

        return redirect()->route('admin.events.index')->withToastSuccess('Event Deleted successfully!!');
    }
}
