<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\IgnoredProfile;
use Illuminate\Http\Request;

class IgnoredProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pageTitle = 'Ignored Profile';
        $ignoredLists = IgnoredProfile::where('user_id', $user->id)->with('profile.basicInfo')->paginate(getPaginate());
        return view('Template::user.ignored_lists', compact('pageTitle', 'ignoredLists'));
    }

    public function remove($id)
    {
        $profile = IgnoredProfile::where('user_id', auth()->id())->find($id);
        if ($profile) {
            $profile->delete();
            return response()->json(['success' => 'Successfully removed from ignored list']);
        } else {
            return response()->json(['error' => 'Invalid request, please try again!']);
        }
    }
}
