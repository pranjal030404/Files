<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class PurchaseHistory extends Model
{

    protected $casts = [
        'package_details' => 'object',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function deposit()
    {
        return $this->hasOne(Deposit::class, 'purchase_id');
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
        if ($this->status == Status::PAYMENT_SUCCESS) {
            $class = "success";
            $text = trans('Purchased');
        } elseif ($this->status == Status::PAYMENT_REJECT) {
            $class = "danger";
            $text = trans('Payment Rejecter');
        } elseif ($this->status == Status::PAYMENT_PENDING) {
            $class = "warning";
            $text = trans('Payment Pending');
        } else {
            $class = "dark";
            $text = trans('Payment Initiated');
        }
        return "<span class='badge badge--$class'>$text</span>";
    }
}
