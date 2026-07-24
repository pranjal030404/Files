<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $pageTitle = 'All Packages';
        $packages = Package::orderBy('id', 'desc')->paginate(getPaginate());

        return view('admin.package.list', compact('pageTitle', 'packages'));
    }

    public function save(Request $request, $id = 0)
    {
        $request->validate([
            'name'                   => 'required|string|unique:packages,name,' . $id,
            'interest_express_limit' => 'integer|gte:-1',
            'contact_view_limit'     => 'integer|integer|gte:-1',
            'image_upload_limit'     => 'required|integer|gte:-1',
            'validity_period'        => 'required|integer|gte:-1',
            'price'                  => 'required|numeric|min:0'
        ]);

        $package = new Package();
        $notification = 'Package added successfully';

        if ($id) {
            $package = Package::findOrFail($id);
            $notification = 'Package updated successfully';
        }

        $package->name = $request->name;
        $package->interest_express_limit = $request->interest_express_limit;
        $package->contact_view_limit = $request->contact_view_limit;
        $package->image_upload_limit = $request->image_upload_limit;
        $package->validity_period = $request->validity_period;
        $package->price = $request->price;
        $package->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function updateStatus($id)
    {
        return Package::changeStatus($id);
    }
}
