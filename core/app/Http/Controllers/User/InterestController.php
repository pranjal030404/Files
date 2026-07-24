<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\UserInterest;

class InterestController extends Controller
{
    public function interestList()
    {
        $pageTitle = 'My Interests';
        $user      = auth()->user();
        $interests = UserInterest::where('user_id', $user->id)->searchable(['profile:username,firstname,lastname'])->with('profile.basicInfo', 'conversation')->orderBy('id', 'desc')->paginate(getPaginate());
        return view('Template::user.interests', compact('pageTitle', 'interests'));
    }

    public function interestRequests()
    {
        $pageTitle        = 'Interest Requests';
        $interestRequests = UserInterest::where('interesting_id', auth()->id())->searchable(['user:username,firstname,lastname'])->with('user.basicInfo', 'conversation')->orderBy('id', 'desc')->paginate(getPaginate());
        return view('Template::user.interest_requests', compact('pageTitle', 'interestRequests'));
    }

    public function acceptInterest($id)
    {
        $user     = auth()->user();
        $interest = UserInterest::where('interesting_id', $user->id)->findOrFail($id);
        if ($interest->status == 1) {
            $notify[] = ['error', 'Already accepted this request'];
            return back()->withNotify($notify);
        }

        $interest->status = 1;
        $interest->save();

        $exist = Conversation::where(function ($query) use ($interest) {
            $query->where('sender_id', $interest->user_id)->orWhere('receiver_id', $interest->user_id);
        })
            ->where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
            })
            ->first();


        if (!$exist) {
            $conversation = new Conversation();
            $conversation->interest_id = $interest->id;
            $conversation->sender_id = $interest->user_id;
            $conversation->receiver_id = $user->id;
            $conversation->save();
        }

        $notify[] = ['success', 'Request accepted successfully'];
        return back()->withNotify($notify);
    }
}
