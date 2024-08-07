<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Company\Branche;
use App\Models\Company\Company;
use App\Models\User\Dependent;
use App\Models\Company\Insurance;
use App\Models\Company\InsuranceType;
use App\Models\Company\Policy;
use App\Models\Company\Vehicle;
use App\Models\User\Traveler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'nick_name',
        'passport_number',
        'profession',
        'email',
        'password',
        'phone',
        'gender',
        'status',
        'role',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define Relation between users - company [ many - one ]
     */
    public function company()
    {
        return $this->hasOne(Company::class);
    }

    /** 
     * Define Relation between users - branches [ many - one ]
     */
    public function traveler()
    {
        return $this->hasOne(Traveler::class);
    }

    /**
     * Define Relation between users - branches [ many - one ]
     */
    public function branche()
    {
        return $this->belongsTo(Branche::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Define Relation between users - vehicles [ one - many ]
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    /**
     * Define Relation between users - insurance_types [ many - many ]
     */
    public function insuranceTypes()
    {
        return $this->belongsToMany(
            InsuranceType::class,
            'insurance_type_user',
            'user_id',
            'insurance_type_id',
            'id',
            'id'
        );
    }

    /**
     * Define Relation between users - insurance [ many - many ]
     */
    public function insurances()
    {
        return $this->belongsToMany(
            Insurance::class,
            'insurance_user',
            'user_id',
            'insurance_id',
            'id',
            'id'
        );
    }

    /**
     * Define Relation between users - dependents [ one - many ]
     */
    public function dependents()
    {
        return $this->hasMany(Dependent::class);
    }

    /**
     * Define Relation between users - policies [ one - many ]
     */
    public function policies()
    {
        return $this->hasMany(Policy::class);
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function getAddressAttribute()
    {
        if (!$this->governorate) {
            return null;
        }
        return $this->governorate . ' | ' . $this->city . ' | ' . $this->street;
    }
}
