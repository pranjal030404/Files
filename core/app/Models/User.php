<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\UserNotify;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, UserNotify;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'ver_code', 'balance', 'kyc_data'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'skipped_step' => 'array',
        'completed_step' => 'array',
        'kyc_data' => 'object',
        'ver_code_send_at' => 'datetime'
    ];

    public function online()
    {
        return Cache::has('online-user' . $this->id);
    }
    public function loginLogs()
    {
        return $this->hasMany(UserLogin::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->orderBy('id', 'desc');
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class)->where('status', '!=', Status::PAYMENT_INITIATE);
    }

    public function limitation()
    {
        return $this->hasOne(UserLimitation::class);
    }

    public function purchaseHistory()
    {
        return $this->hasMany(PurchaseHistory::class);
    }

    public function basicInfo()
    {
        return $this->hasOne(BasicInfo::class);
    }

    public function physicalAttributes()
    {
        return $this->hasOne(PhysicalAttribute::class);
    }

    public function family()
    {
        return $this->hasOne(FamilyInfo::class);
    }

    public function educationInfo()
    {
        return $this->hasMany(EducationInfo::class);
    }

    public function careerInfo()
    {
        return $this->hasMany(CareerInfo::class);
    }

    public function partnerExpectation()
    {
        return $this->hasOne(PartnerExpectation::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class)->latest('id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function shortListedProfile()
    {
        return $this->hasMany(ShortListedProfile::class);
    }
    public function ignoredProfile()
    {
        return $this->hasMany(IgnoredProfile::class);
    }

    public function ignoredBy()
    {
        return $this->hasMany(IgnoredProfile::class, 'ignored_id');
    }

    public function interests()
    {
        return $this->hasMany(UserInterest::class);
    }

    public function interestRequests()
    {
        return $this->hasMany(UserInterest::class, 'interesting_id');
    }

    public function contacts()
    {
        return $this->hasMany(ContactView::class);
    }

    public function senderConversation()
    {
        return $this->hasMany(Conversation::class, 'sender_id');
    }

    public function receiverConversation()
    {
        return $this->hasMany(Conversation::class, 'receiver_id');
    }

    public function conversations()
    {
        return $this->senderConversation->merge($this->receiverConversation);
    }

    public function tickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function fullname(): Attribute
    {
        return new Attribute(
            get: fn () => $this->firstname . ' ' . $this->lastname,
        );
    }

    public function mobileNumber(): Attribute
    {
        return new Attribute(
            get: fn () => $this->dial_code . $this->mobile,
        );
    }

    // SCOPES
    public function scopeActive($query)
    {
        return $query->where('status', Status::USER_ACTIVE)->where('ev', Status::VERIFIED)->where('sv', Status::VERIFIED);
    }

    public function scopeBanned($query)
    {
        return $query->where('status', Status::USER_BAN);
    }

    public function scopeEmailUnverified($query)
    {
        return $query->where('ev', Status::UNVERIFIED);
    }

    public function scopeMobileUnverified($query)
    {
        return $query->where('sv', Status::UNVERIFIED);
    }

    public function scopeKycUnverified($query)
    {
        return $query->where('kv', Status::KYC_UNVERIFIED);
    }

    public function scopeKycPending($query)
    {
        return $query->where('kv', Status::KYC_PENDING);
    }

    public function scopeEmailVerified($query)
    {
        return $query->where('ev', Status::VERIFIED);
    }

    public function scopeMobileVerified($query)
    {
        return $query->where('sv', Status::VERIFIED);
    }

    public function scopeProfileCompleted($query)
    {
        return $query->where('profile_complete', Status::YES);
    }

    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class);
    }

    public function age()
    {
        if (!$this->basicInfo) return trans('N/A');
        return round(Carbon::parse($this->basicInfo->birth_date)->diffInYears(now())) . ' ' . trans('Years');
    }

    public function profilePicture()
    {
        if ($this->image) {
            return getImage(getFilePath('userProfile') . '/' . $this->image);
        }

        $img = 'male';
        if ($this->basicInfo) {
            $img = $this->basicInfo->gender == 'm' ? 'male' : 'female';
        }

        return getImage("assets/images/$img.png");
    }
}
