<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CasteInfo;

class CasteController extends Controller
{
    public function index(){
        $pageTitle = 'All Caste';
        $castes = CasteInfo::all();
        return view('admin.caste_info', compact('pageTitle', 'castes'));
    }

    public function save(Request $request, $id=0){
        $request->validate([
            'name' => 'required|unique:caste_infos,name,'.$id
        ]);
        $caste = new CasteInfo();
        $notification = 'Caste added successfully';
        if($id){
            $caste = CasteInfo::findOrFail($id);
            $notification = 'Caste updated successfully';
        }
        $caste->name = $request->name;
        $caste->save();

        $notify[] = ['success', $notification];
        return back()->with($notify);
    }

    public function delete($id){
        $caste = CasteInfo::findOrFail($id);
        $caste->delete();

        $notify[] = ['success', ' Caste deleted successfully'];
        return back()->with($notify);
    }
}
