<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function reporter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function profile()
    {
        return $this->belongsTo(User::class, 'complaint_id');
    }

    public function scopeUnseen($query){
        $query->where('status', Status::DISABLE);
    }
}
