<?php

namespace App\Models\Company;

use App\Observers\Company\PolicyObServer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;
    public static $management;

    protected $fillable = [
        'branche_id',
        'insurance_id',
        'insurance_type_id',
        'user_id',
        'name',
        'policy_number',
        'start_date',
        'end_date',
        'total_amount',
        'total_amount_letters',
        'detelis',
        'status',
    ];

    /**
     * Define Relation between policies - branches [ many - one ]
     */
    public function branche()
    {
        return $this->belongsTo(Branche::class);
    }
    protected static function booted()
    {
        static::creating(function ($policy) {
            $policyObserver = new PolicyObserver();
            $policyObserver->creating($policy, static::$management);
        });
    }
    
}
