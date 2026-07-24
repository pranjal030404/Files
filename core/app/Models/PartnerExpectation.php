<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerExpectation extends Model
{
    protected $casts = [
        'language' => 'array'
    ];
}
