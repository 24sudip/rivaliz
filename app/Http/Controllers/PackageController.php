<?php

namespace App\Http\Controllers;

use App\Models\{Package, PackageOrder, PackagePayment};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function PackagePaymentActive(Request $request, PackagePayment $package_payment) {
        $package_payment->update([
            'status' => 1
        ]);
        return redirect()->route('admin.package-payment.list')->with('success', 'Payment Paid Successfully!');
    }

    public function PackagePaymentInactive(Request $request, PackagePayment $package_payment) {
        $package_payment->update([
            'status' => 0
        ]);
        return redirect()->route('admin.package-payment.list')->with('success', 'Payment Changed Successfully!');
    }

    public function PackageOrderList()
    {
        $package_orders = PackageOrder::with('package_payment','student','package')->latest()->get();
        return view('backend.package-order.index', compact('package_orders'));
    }

    public function PackagePaymentList()
    {
        $package_payments = PackagePayment::with('student','package')->latest()->get();
        return view('backend.package-payment.index', compact('package_payments'));
    }

    public function index()
    {
        $packages = Package::all();
        return view('backend.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.package.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required',
            'duration_month' => 'required|integer',
            'short_description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }
        $fields = $request->all();
        $fields['status'] = $request->status ? 1 : 0;
        Package::create($fields);
        return redirect()->route('admin.package.index')->with('success', 'Package added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        return view('backend.package.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required',
            'duration_month' => 'required|integer',
            'short_description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }
        $fields = $request->all();
        $fields['status'] = $request->status ? 1 : 0;
        $package->update($fields);
        return redirect()->route('admin.package.index')->with('success', 'Package Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.package.index')->with('success', 'Package deleted successfully!');
    }

    public function packageActive(Package $package) {
        $package->update([
            'status' => 1
        ]);
        return redirect()->route('admin.package.index')->with('success', 'Status Active Successfully!');
    }

    public function packageInactive(Package $package) {
        $package->update([
            'status' => 0
        ]);
        return redirect()->route('admin.package.index')->with('success', 'Status Inactive Successfully!');
    }
}
