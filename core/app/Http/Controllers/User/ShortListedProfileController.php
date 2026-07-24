<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShortListedProfile;

class ShortListedProfileController extends Controller
{
    public function index()
    {
        $pageTitle  = 'Shortlisted Profiles';
        $user       = auth()->user();
        $shortlists = ShortListedProfile::where('user_id', $user->id)
            ->searchable(['profile:username,firstname,lastname'])
            ->with('profile.basicInfo', 'profile.interests')->latest()->paginate(getPaginate());

        return view( 'Template::user.shortlists', compact('pageTitle', 'shortlists', 'user'));
    }

    public function remove($id)
    {
        $list = ShortListedProfile::where('user_id', auth()->id())->find($id);
        if ($list) {
            $list->delete();
            return response()->json(['success' => 'Profile removed successfully from the list']);
        } else {
            return response()->json(['error' => 'Invalid request, please try again!']);
        }
    }
}
