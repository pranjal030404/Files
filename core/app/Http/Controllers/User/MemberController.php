<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class MemberController extends Controller {
    public function profile($id) {
        $member = User::with(['basicInfo', 'physicalAttributes', 'family', 'partnerExpectation', 'careerInfo', 'limitation', 'educationInfo' => function ($query) {
            $query->orderBy('start', 'desc');
        }])->active()->findOrFail($id);
        $maxLimit = $member->limitation?->image_upload_limit;
        $member->load(['galleries' => function ($image) use ($maxLimit) {
            if ($maxLimit > 0) {
                $image->latest('id')->limit($maxLimit);
            }

        }]);
        $pageTitle = 'Member\'s Profile';
        $user      = auth()->user();

        return view('Template::user.members.profile', compact('pageTitle', 'member', 'user'));
    }
}
