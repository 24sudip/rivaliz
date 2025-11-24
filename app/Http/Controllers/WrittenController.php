<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Written, QuizCategory, Category};
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class WrittenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $writtens = Written::with('quizcategory','quizsubcategory','written_category')->latest()->get();
        return view('backend.written.index', compact('writtens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.written.create', [
            'quizcategories' => QuizCategory::get(['id','name']),
            'categories' => Category::get(['id','name'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_name'  => 'required',
            'quizcategory_id'=>'required|exists:quizcategories,id',
            'quizsubcategory_id'=>'required|exists:quizsubcategories,id',
            'answer'=>'required',
            'written_category_id'=>'required|exists:categories,id',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp,svg,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/written/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;
                $image_file->move($image_url, $img_name);
            }
        }

        Written::create([
            'question_name' => $request->question_name,
            'image'       => isset($final_name1) ? $final_name1 : null,
            'quizcategory_id' => $request->quizcategory_id,
            'quizsubcategory_id' => $request->quizsubcategory_id,
            'answer'  => $request->answer,
            'written_category_id'  => $request->written_category_id,
        ]);

        return to_route('admin.written.index')->with('success','New data added successfully!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Written $written)
    {
        return view('backend.written.edit', [
            'quizcategories' => QuizCategory::get(['id','name']),
            'categories' => Category::get(['id','name']),
            'written' => $written
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Written $written)
    {
        $validator = Validator::make($request->all(), [
            'question_name'  => 'required',
            'quizcategory_id'=>'required|exists:quizcategories,id',
            'quizsubcategory_id'=>'required|exists:quizsubcategories,id',
            'answer'=>'required',
            'written_category_id'=>'required|exists:categories,id',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp,svg,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            if ($image_file) {

                $image_path = public_path($written->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/written/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $written->image = $final_name1;
                $written->save();
            }
        }
        $written->update([
            'question_name' => $request->question_name,
            'image'       => isset($final_name1) ? $final_name1 : null,
            'quizcategory_id' => $request->quizcategory_id,
            'quizsubcategory_id' => $request->quizsubcategory_id,
            'answer'  => $request->answer,
            'written_category_id'  => $request->written_category_id,
        ]);
        return to_route('admin.written.index')->with('success','Data updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Written $written)
    {
        $written->delete();
        $image_path = public_path($written->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        return to_route('admin.written.index')->with('success','Data Deleted successfully!!');
    }
}
