<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaritalStatus;

class MaritalStatusController extends Controller
{
    public function index(){
        $pageTitle = 'Marital Status';
        $maritalStatusInfo = MaritalStatus::all();
        return view('admin.marital_status_info', compact('pageTitle', 'maritalStatusInfo'));
    }

    public function save(Request $request, $id=0){
        $request->validate([
            'title' => 'required|unique:marital_statuses,title,'.$id
        ]);
        $maritalStatusInfo = new MaritalStatus();
        $notification = 'Marital status added successfully';
        if($id){
            $maritalStatusInfo = MaritalStatus::findOrFail($id);
            $notification = 'Marital status updated successfully';
        }
        $maritalStatusInfo->title = $request->title;
        $maritalStatusInfo->save();

        $notify[] = ['success', $notification];
        return back()->with($notify);
    }

    public function delete($id){
        $maritalStatusInfo = MaritalStatus::findOrFail($id);
        $maritalStatusInfo->delete();

        $notify[] = ['success', ' Marital status deleted successfully'];
        return back()->with($notify);
    }
}
