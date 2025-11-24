<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, File};
use App\Models\Podcast;
use App\Models\Podcastcategory;


class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
    public function podcastcategory(){
         $categories =    Podcastcategory::orderBy('id','DESC')->get();
        return view('admin.podcast.categoryindex',compact('categories'));
    }
     
    public function  createpodcastcategory(){
          return view('admin.podcast.categorycreate');
    }
    
    
      public function  storepodcastcategory(Request $request){
        //    dd( $request->all());
        $data =   new Podcastcategory;
        $data->name = $request->name;
        $data->save();
        return redirect()->route('admin.podcastcategory.index')->with('success', 'Category submitted successfully!!');
            
        }
        
        public function editpodcastcategory($id){
            
         $podcast =  PodcastCategory::findOrFail($id);
        //  dd($podcast);
         return view('admin.podcast.categoryedit',compact('podcast'));
            
        }
        
     public function updatepodcastcategory(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $category = PodcastCategory::findOrFail($id);
    $category->name = $request->name;
    $category->save();

    return redirect()->route('admin.podcastcategory.index')->with('success', 'Podcast Category updated successfully!');
}
        public function deletepodcastcategory($id){
            
           $category = PodcastCategory::findOrFail($id);
           $category->delete();

            // $category->delete();
            return redirect()->route('admin.podcastcategory.index')->with('success', 'Data Deleted successfully!!');
        }
        

    public function index()
    {
        return view('admin.podcast.index', [
            'podcasts' => Podcast::latest()->get(['id','title','photo','status'])
        ]);
    }
    
    
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
       $categories =    Podcastcategory::orderBy('id','DESC')->get();
        return view('admin.podcast.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'photo' => 'required|image|max:10240',
            'title' => 'required|string|max:255',
            'audio' => 'required|mimes:mp3|max:20480',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }
        $podcast        = new Podcast();
        if ($request->hasFile('photo')) {
            // if ($hero && File::exists(public_path($hero->image))) {
            //     File::delete(public_path($hero->image));
            // }
            $image = $request->file('photo');
            $imageName = rand().'-'.time().$image->getClientOriginalName();
            $image->move(public_path('/images/podcast'), $imageName);
            $imagePath = "/images/podcast/". $imageName;
            // dd($imagePath);
        }
        $podcast->photo = isset($imagePath) ? $imagePath : 'Not Found';
        $podcast->title = $request->title;
        if ($request->hasFile('audio')) {
            // if ($hero && File::exists(public_path($hero->image))) {
            //     File::delete(public_path($hero->image));
            // }
            $image = $request->file('audio');
            $imageName = rand().'-'.time().$image->getClientOriginalName();
            $image->move(public_path('/images/podcast'), $imageName);
            $imagePath = "/images/podcast/". $imageName;
            // dd($imagePath);
        }
        $podcast->audio = isset($imagePath) ? $imagePath : 'audio';
        $podcast->description = $request->description;
        $podcast->category_id = $request->category_id;
        $podcast->save();
        return redirect()->route('admin.podcast.index')->with('success', 'Podcast Added!');
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
    public function edit(Podcast $podcast)
    {
        $categories = Podcastcategory::orderBy('id', 'DESC')->get();
        return view('admin.podcast.edit', compact('podcast','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Podcast $podcast)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|max:10240',
            'title' => 'required|string|max:255',
            'audio' => 'nullable|mimes:mp3|max:20480',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }
        if ($request->hasFile('photo')) {
            if (File::exists(public_path($podcast->photo))) {
                File::delete(public_path($podcast->photo));
            }
            $image = $request->file('photo');
            $imageName = rand().'-'.time().$image->getClientOriginalName();
            $image->move(public_path('/images/podcast'), $imageName);
            $imagePath = "/images/podcast/". $imageName;
            // dd($imagePath);
        }
        $podcast->photo = isset($imagePath) ? $imagePath : $podcast->photo;
        $podcast->title = $request->title;
        if ($request->hasFile('audio')) {
            if (File::exists(public_path($podcast->audio))) {
                File::delete(public_path($podcast->audio));
            }
            $image = $request->file('audio');
            $imageName = rand().'-'.time().$image->getClientOriginalName();
            $image->move(public_path('/images/podcast'), $imageName);
            $imagePath = "/images/podcast/". $imageName;
            // dd($imagePath);
        }
        $podcast->audio = isset($imagePath) ? $imagePath : $podcast->audio;
        $podcast->description = $request->description;
        $podcast->category_id = $request->category_id;
        $podcast->save();
        return redirect()->route('admin.podcast.index')->with('success', 'Podcast Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Podcast $podcast)
    {
        if (File::exists(public_path($podcast->photo))) {
            File::delete(public_path($podcast->photo));
        }
        if (File::exists(public_path($podcast->audio))) {
            File::delete(public_path($podcast->audio));
        }
        $podcast->delete();
        return redirect()->route('admin.podcast.index')->with('success', 'Podcast Deleted!');
    }
}
