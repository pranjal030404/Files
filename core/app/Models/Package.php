<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use GlobalStatus;

    public function scopeActive($query)
    {
        return $query->where('status', Status::ENABLE);
    }
}
