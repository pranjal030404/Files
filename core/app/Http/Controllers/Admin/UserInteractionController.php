<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\IgnoredProfile;
use App\Models\Report;
use App\Models\UserInterest;

class UserInteractionController extends Controller
{
    public function interests(){
        $pageTitle = 'User Interests';
        $profiles = UserInterest::with('user', 'profile');
        if(request()->search){
            $search = request()->search;
            $profiles = $profiles->where(function($query) use($search){
                $query->whereHas('user', function($q) use($search){
                    $q->where('username', 'like', "%$search%");
                })->orWhereHas('profile', function($q) use($search){
                    $q->where('username', 'like', "%$search%");
                });
            });
        }

        $profiles = $profiles->paginate(getPaginate());
        return view('admin.users.interactions', compact('pageTitle', 'profiles'));
    }

    public function ignoredProfile(){
        $pageTitle = 'Ignored Profile';
        $profiles =IgnoredProfile::with('user', 'profile');

        if(request()->search){
            $search = request()->search;
            $profiles = $profiles->where(function($query) use($search){
                $query->whereHas('user', function($q) use($search){
                    $q->where('username', 'like', "%$search%");
                })->orWhereHas('profile', function($q) use($search){
                    $q->where('username', 'like', "%$search%");
                });
            });
        }

        $profiles = $profiles->paginate(getPaginate());
        return view('admin.users.interactions', compact('pageTitle', 'profiles'));
    }

    public function reports(){
        $pageTitle = 'Reports';
        $profiles = Report::with('reporter', 'profile');

        (clone $profiles)->unseen()->update(['status' => Status::ENABLE]);

        if(request()->search){
            $search = request()->search;
            $profiles = $profiles->where(function($query) use($search){
                $query->whereHas('reporter', function($q) use($search){
                    $q->where('username', 'like', "%$search%");
                })->orWhereHas('profile', function($q) use($search){
                    $q->where('username', 'like', "%$search%");
                });
            });
        }

        $profiles = $profiles->paginate(getPaginate());
        return view('admin.users.interactions', compact('pageTitle', 'profiles'));
    }
}
