<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\ContactView;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\IgnoredProfile;
use App\Models\Report;
use App\Models\ShortListedProfile;
use App\Models\UserInterest;
use App\Models\UserLimitation;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ActionController extends Controller
{
    public function report(Request $request)
    {
        $request->validate([
            'complaint_id' => 'required|exists:users,id',
            'title' => 'required|string|max:40',
            'reason' => 'required|string|max:255'
        ]);
        $user = auth()->user();
        $exists = Report::where('user_id', $user->id)->where('complaint_id', $request->complaint_id)->first();

        $complaintUser = User::where('id', $request->complaint_id)->first();

        if (!$complaintUser) {
            $notify[] = ['error', 'User doesn\'t exist!'];
            return back()->withNotify($notify);
        }

        if ($exists) {
            $notify[] = ['error', 'You had already reported against to this user'];
            return back()->withNotify($notify);
        }

        $report               = new Report();
        $report->user_id      = $user->id;
        $report->complaint_id = $request->complaint_id;
        $report->title        = $request->title;
        $report->reason       = $request->reason;
        $report->save();

        if ($request->has('is_ignored')) {
            $ignoredProfile             = new IgnoredProfile();
            $ignoredProfile->user_id    = $user->id;
            $ignoredProfile->ignored_id = $complaintUser->id;
            $ignoredProfile->save();
        }

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $complaintUser->id;
        $adminNotification->title     = $user->username . ' report against ' . $complaintUser->username;
        $adminNotification->click_url = urlPath('admin.users.detail', $complaintUser->id);
        $adminNotification->save();

        $notify[] = ['success', 'Your report has been submitted successfully'];
        if ($request->has('is_ignored')) {
            return to_route('member.list')->withNotify($notify);
        }
        return back()->withNotify($notify);
    }

    public function addToShortList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $userId = auth()->id();
        $exists = ShortListedProfile::where('user_id', $userId)->where('profile_id', $request->profile_id)->first();
        if ($exists) {
            return response()->json(['error' => ['You had already listed this user']]);
        }

        $shortListed = new ShortListedProfile();
        $shortListed->user_id = $userId;
        $shortListed->profile_id = $request->profile_id;
        $shortListed->save();

        return response()->json(['success' => ['You have successfully short listed this member']]);
    }

    public function removeFromShortList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $userId = auth()->id();
        $exists = ShortListedProfile::where('user_id', $userId)->where('profile_id', $request->profile_id)->first();
        if (!$exists) {
            return response()->json(['error' => ['Profile not found!']]);
        }

        $exists->delete();

        return response()->json(['success' => ['You have successfully remove this member form short list']]);
    }

    public function ignore($id)
    {
        $member = User::findOrFail($id);
        $userId = auth()->id();
        $exists = IgnoredProfile::where('user_id', $userId)->where('ignored_id', $member->id)->first();

        if ($exists) {
            $notify[] = ['error', 'You had already ignored this member'];
            return to_route('member.list')->withNotify($notify);
        }

        $ignoredList = new IgnoredProfile();
        $ignoredList->user_id = $userId;
        $ignoredList->ignored_id = $member->id;
        $ignoredList->save();

        $notify[] = ['success', 'You have successfully ignored this member'];
        return to_route('member.list')->withNotify($notify);
    }

    public function interestLimit()
    {
        $user = auth()->user();
        return response()->json($user->limitation->interest_express_limit);
    }

    public function contactLimit()
    {
        $user = auth()->user();
        return response()->json($user->limitation->contact_view_limit);
    }

    public function expressInterest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'interesting_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $user = auth()->user();
        $interestingId = $request->interesting_id;
        $exists = UserInterest::where('user_id', $user->id)->where('interesting_id', $interestingId)->first();

        if ($exists) {
            return response()->json(['error' => 'You already express interest on this member']);
        }

        $userLimitation = UserLimitation::where('user_id', $user->id)->first();
        if (!checkValidityPeriod($userLimitation)) {
            return response()->json(['error' => 'Your package\'s validity period has been expired']);
        }

        if (($userLimitation->interest_express_limit != -1 && !$userLimitation->interest_express_limit)) {
            return response()->json(['error' => 'Your interest express limit is over']);
        }

        $userInterest = new UserInterest();
        $userInterest->user_id = $user->id;
        $userInterest->interesting_id = $interestingId;
        $userInterest->save();

        if ($userLimitation->interest_express_limit != -1) {
            $userLimitation->interest_express_limit -= 1;
            $userLimitation->save();
        }

        return response()->json(['success' => 'Interest expressed successfully']);
    }

    public function viewContact(Request $request)
    {
        $request->validate([
            'contact_id' => 'required|exists:users,id'
        ]);

        $general = GeneralSetting::first();
        $user = auth()->user();
        $contactId = $request->contact_id;
        $exists = ContactView::where('user_id', $user->id)->where('contact_id', $contactId)->first();

        if ($exists) {
            $notify[] = ['error', 'You already view this contact'];
            return back()->withNotify($notify);
        }

        $userLimitation = UserLimitation::where('user_id', $user->id)->first();
        if (!checkValidityPeriod($userLimitation)) {
            $notify[] = ['error', 'Your package\'s validity period has been expired'];
            return back()->withNotify($notify);
        }

        if (($userLimitation->contact_view_limit != -1 && !$userLimitation->contact_view_limit)) {
            $notify[] = ['error', 'Your contact view limit is over'];
            return back()->withNotify($notify);
        }

        $contactView = new ContactView();
        $contactView->user_id = $user->id;
        $contactView->contact_id = $contactId;
        $contactView->save();

        if ($userLimitation->contact_view_limit != -1) {
            $userLimitation->contact_view_limit -= 1;
            $userLimitation->save();
        }

        $notify[] = ['success', 'Contact details unlocked successfully'];
        return back()->withNotify($notify);
    }
}
