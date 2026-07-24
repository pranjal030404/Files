<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IgnoredProfile extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function profile(){
        return $this->belongsTo(User::class, 'ignored_id');
    }
}
