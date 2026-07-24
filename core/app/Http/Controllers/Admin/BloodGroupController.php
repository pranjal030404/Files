<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodGroup;

class BloodGroupController extends Controller
{
    public function index(){
        $pageTitle = 'Blood Groups';
        $bloodGroups = BloodGroup::all();
        return view('admin.blood_group', compact('pageTitle', 'bloodGroups'));
    }

    public function save(Request $request, $id=0){
        $request->validate([
            'name' => 'required|unique:blood_groups,name,'.$id
        ]);
        $bloodGroup = new BloodGroup();
        $notification = 'Blood group added successfully';
        if($id){
            $bloodGroup = BloodGroup::findOrFail($id);
            $notification = 'Blood group updated successfully';
        }
        $bloodGroup->name = $request->name;
        $bloodGroup->save();

        $notify[] = ['success', $notification];
        return back()->with($notify);
    }

    public function delete($id){
        $bloodGroup = BloodGroup::findOrFail($id);
        $bloodGroup->delete();

        $notify[] = ['success', ' Blood group deleted successfully'];
        return back()->with($notify);
    }
}
