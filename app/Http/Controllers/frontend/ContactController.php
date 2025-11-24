<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Contact, MultiImage};

class ContactController extends Controller
{
    public function index() {
        return view('backend.contact.index', [
            'contacts' => Contact::latest()->get()
        ]);
    }

    public function ContactStore(Request $request) {
        // dd($request->all());
        $request->validate([
            'name'=>'required|string|max:255',
            'phone'=>'required',
            // 'subject'=>'string|max:255',
            // 'message'=>'',
        ]);
        $contact = Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message
        ]);
        // Multiple Image Upload
        $images = $request->file('prescription_multi_img');
        if ($images) {
            foreach ($images as $img) {
                // $file = $request->file('photo');
                // @unlink(public_path('upload/admin_photos/'.$data->photo));
                $file_name = mt_rand (10000,99999).'-'.date('YmdHis'). $img->getClientOriginalName();
                $img->move(public_path('images/contact'), $file_name);
                $save_url = 'images/contact/'. $file_name;
                MultiImage::create([
                    'contact_id' => $contact->id,
                    'photo_name' => $save_url
                ]);
            }
        }
        return redirect()->back()->with('success','Message Sent Successfully');
    }

    public function edit($id) {
        return view('backend.contact.edit', [
            'contact' => Contact::findOrFail($id),
            'multi_images' => MultiImage::where('contact_id', $id)->get(['photo_name'])
        ]);
    }

    public function update(Request $request, $id) {
        $fields = $request->validate([
            'name'=>'required|string|max:255',
            'phone'=>'required',
            'subject'=>'required|string|max:255',
            'message'=>'required',
        ]);
        $contact = Contact::findOrFail($id);
        $contact->update($fields);
        return redirect()->back()->with('success', 'Contact Updated!');
    }

    public function delete($id) {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        $images = MultiImage::where('contact_id', $id)->get();
        foreach ($images as $img) {
            unlink($img->photo_name);
        }
        MultiImage::where('contact_id', $id)->delete();
        return redirect()->route('admin.contact.index')->with('success', 'Contact Deleted!');
    }
}
