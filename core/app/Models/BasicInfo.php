<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
    protected $casts = [
        'present_address' => 'object',
        'permanent_address' => 'object',
        'language' => 'array',
    ];
}
