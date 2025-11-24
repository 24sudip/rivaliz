<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AffiliateManagementController extends Controller {
    public function affiliateList() {
        $data              = [];
        $data['affiliate'] = Affiliate::orderBy('updated_at', 'desc')->paginate();

        return view('backend.affiliate.list', $data);
    }

    public function active(Request $request, Affiliate $affiliate) {
        $affiliate->status = 1;
        $affiliate->save();

        return redirect()->back()->withToastSuccess('The affiliate activated successfully!!');
    }

    public function inactive(Request $request, Affiliate $affiliate) {
        $affiliate->status = 0;
        $affiliate->save();

        return redirect()->back()->withToastSuccess('The affiliate inactivated successfully!!');
    }

    public function delete(Request $request, Affiliate $affiliate) {
        $image_path = public_path($affiliate->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $affiliate->delete();

        return redirect()->back()->withToastSuccess('The affiliate deleted successfully!!');
    }

    public function setPercentageAndValidity(Request $request) {
        $affiliate             = Affiliate::find($request->id);
        $affiliate->percentage = $request->percentage;
        $affiliate->validity   = $request->validity;
        $affiliate->save();

        return back()->withToastSuccess('Percentage and validity set successfully');
    }

}
