<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReligionInfo;

class ReligionController extends Controller
{
    public function index(){
        $pageTitle = 'All Religion';
        $religions = ReligionInfo::all();
        return view('admin.religion_info', compact('pageTitle', 'religions'));
    }

    public function save(Request $request, $id=0){
        $request->validate([
            'name' => 'required|unique:religion_infos,name,'.$id
        ]);
        $religion = new ReligionInfo();
        $notification = 'Religion added successfully';
        if($id){
            $religion = ReligionInfo::findOrFail($id);
            $notification = 'Religion updated successfully';
        }
        $religion->name = $request->name;
        $religion->save();

        $notify[] = ['success', $notification];
        return back()->with($notify);
    }

    public function delete($id){
        $religion = ReligionInfo::findOrFail($id);
        $religion->delete();

        $notify[] = ['success', ' Religion deleted successfully'];
        return back()->with($notify);
    }
}
