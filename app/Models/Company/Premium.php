<?php

namespace App\Models\Company;

use App\Helper\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premium extends Model
{
    use HasFactory;

    protected $table = 'premiums';

    protected $guarded = [];

    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }

    // Define Accessors for this attributes becouse foramt any currancy
    public function getNetPremiumsAttribute()
    {
        return Currency::format($this->attributes['net_premiums'] , false);
    }

    public function getTaxAttribute()
    {
        return Currency::format($this->attributes['tax'] , false);
    }

    public function getSupervisionFeesAttribute()
    {
        return Currency::format($this->attributes['supervision_fees'], false);
    }

    public function getStampsAttribute()
    {
        return Currency::format($this->attributes['stamps'], false);
    }

    public function getIssuanceFeesAttribute()
    {
        return Currency::format($this->attributes['issuance_fees'], false);
    }

    public function getTotalPremiumAttribute()
    {
        return Currency::format($this->attributes['total_premium'], false);
    }
}
