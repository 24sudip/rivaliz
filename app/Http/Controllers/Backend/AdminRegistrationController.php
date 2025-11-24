<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdminRegistrationController extends Controller {
    public function __construct() {
        $this->middleware('editor');
    }

    public function adminList() {
        $admins = Admin::all();

        return view('backend.auth.admin-list', compact('admins'));
    }

    public function createAdmin() {
        $roles = Role::all();

        return view('backend.auth.create-admin', compact('roles'));
    }

    public function storeAdmin(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'role_id'    => 'required|numeric',
            'phone'    => 'required|numeric',
            'email'    => 'required|email|unique:admins',
            'password' => 'required',
            'address'  => 'required',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // if ($validator->fails()) {
        //     return back()->with('toast_error', $validator->messages()->all())->withInput();
        // }
        
        // dd($request->all());

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/admin/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        $admin           = new Admin();
        $admin->name     = $request->name;
        $admin->role_id  = $request->role_id;
        $admin->phone    = $request->phone;
        $admin->email    = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->address  = $request->address;
        $admin->image    = $final_name1 ?? '';
        $admin->status   = 1;

        $admin->save();

        return redirect()->route('admin.adminList')->withToastSuccess('New Amin Registered Successfully!!');
    }

    public function editAdmin(Admin $admin) {
        $roles = Role::all();

        return view('backend.auth.edit-admin', compact('admin', 'roles'));
    }

    public function updateAdmin(Request $request, Admin $admin) {

        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'role_id'    => 'required|numeric',
            'phone'   => 'required',
            'email'   => 'required|email|unique:admins,email,' . $admin->id,
            'address' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($admin->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/admin/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $admin->image = $final_name1;
                $admin->save();

            }

        }

        $admin->name    = $request->name;
        $admin->role_id = $request->role_id;
        $admin->phone   = $request->phone;
        $admin->email   = $request->email;
        $admin->address = $request->address;

        $admin->save();

        return redirect()->route('admin.adminList')->withToastSuccess('The admin updated successfully!!');
    }

    public function activeAdmin(Request $request, Admin $admin) {
        $admin->status = 1;
        $admin->save();

        return redirect()->back()->withToastSuccess('The admin activated successfully!!');
    }

    public function inactiveAdmin(Request $request, Admin $admin) {
        $admin->status = 0;
        $admin->save();

        return redirect()->back()->withToastSuccess('The admin inactivated successfully!!');
    }

    public function deleteAdmin(Request $request, Admin $admin) {
        $image_path = public_path($admin->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $admin->delete();

        return redirect()->back()->withToastSuccess('The admin deleted successfully!!');
    }

}
