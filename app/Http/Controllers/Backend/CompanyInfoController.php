<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyInfoController extends Controller {
    public function showSiteInfo() {
        $info = CompanyInfo::where('id', 1)->first();

        return view('backend.site-info', compact('info'));
    }

    public function storeSiteGeneralInfo(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required',
            'phone_one' => 'required',
            'about'     => 'required',
            'address'   => 'required',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'favicon'   => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'app_logo'  => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        CompanyInfo::updateOrcreate(
            ['id' => 1],
            [
                'name'        => $request->name,
                'about'       => $request->about,
                'address'     => $request->address,
                'phone_one'   => $request->phone_one,
                'phone_two'   => $request->phone_two,
                'phone_three' => $request->phone_three,
                'email'       => $request->email,
                'footer_text' => $request->footer_text,
                'app_link'    => $request->app_link,
                'facebook'    => $request->facebook,
                'twitter'     => $request->twitter,
                'instagram'   => $request->instagram,
                'youtube'     => $request->youtube,
                'linkedin'    => $request->linkedin,
                'pinterest'   => $request->pinterest,
            ]
        );

        if ($request->hasFile('logo')) {

            $image_file = $request->file('logo');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/site/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name = $img_gen . '.' . $image_ext;
                $logo     = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                CompanyInfo::updateOrcreate(
                    ['id' => 1],
                    [
                        'logo' => $logo,
                    ]
                );
            }

        }

        if ($request->hasFile('favicon')) {

            $image_file = $request->file('favicon');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/site/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name = $img_gen . '.' . $image_ext;
                $favicon  = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                CompanyInfo::updateOrcreate(
                    ['id' => 1],
                    [
                        'favicon' => $favicon,
                    ]
                );
            }

        }

        if ($request->hasFile('app_logo')) {

            $image_file = $request->file('app_logo');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/site/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name = $img_gen . '.' . $image_ext;
                $app_logo = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                CompanyInfo::updateOrcreate(
                    ['id' => 1],
                    [
                        'app_logo' => $app_logo,
                    ]
                );
            }

        }

        return redirect()->back()->withToastSuccess('Company general info updated successfully!!');
    }

}
