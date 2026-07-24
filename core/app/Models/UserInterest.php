<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserInterest extends Model
{
    public function profile()
    {
        return $this->belongsTo(User::class, 'interesting_id');
    }

    public function conversation(){
        return $this->hasOne(Conversation::class, 'interest_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(
            get: fn () => $this->badgeData(),
        );
    }

    public function badgeData()
    {
        $html = '';

        if ($this->status == 1) {
            $html = '<span class="badge badge--success">' . trans('Accepted') . '</span>';
        } else {
            $html = '<span><span class="badge badge--warning">' . trans('Pending') . '</span></span>';
        }

        return $html;
    }
}
