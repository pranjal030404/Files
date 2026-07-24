<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortListedProfile extends Model
{
    public function profile()
    {
        return $this->belongsTo(User::class, 'profile_id');
    }
}
