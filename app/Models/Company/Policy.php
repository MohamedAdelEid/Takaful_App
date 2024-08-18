<?php

namespace App\Models\Company;

use App\Models\AvailableCar;
use App\Models\User;
use App\Models\User\Trip;
use App\Observers\Company\PolicyObServer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;
    public static $management;
    public static $insuranceTypeId;
    public static $type;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    protected $fillable = [
        'branche_id',
        'insurance_id',
        'insurance_type_id',
        'user_id',
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

    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }

    public function insuranceType()
    {
        return $this->belongsTo(InsuranceType::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class);
    }

    public function trip()
    {
        return $this->hasOne(Trip::class);
    }

    public function premium()
    {
        return $this->hasOne(Premium::class);
    }

    public function accident()
    {
        return $this->belongsTo(Accident::class);
    }

    public function availableCars()
    {
        return $this->belongsToMany(AvailableCar::class, 'available_car_policy');
    }

    public function orangeVisitedCountries()
    {
        return $this->belongsToMany(OrangeVisitedCountry::class, 'orange_visited_country_policy');
    }

    protected static function booted()
    {
        static::creating(function ($policy) {
            $policyObserver = new PolicyObserver();
            $policyObserver->creating($policy, static::$type, static::$management, static::$insuranceTypeId);
        });
    }

    public function getPdfPathAttribute()
    {
        // Check if pdf_path is set
        if ($this->attributes['pdf_path']) {
            return config('app.url') . '/public/storage/' . $this->attributes['pdf_path'];
        }

        // Return a default value or null if not set
        return null;
    }


}
