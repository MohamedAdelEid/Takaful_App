<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Company\Company;
use App\Models\Company\Dependent;
use App\Models\Company\Insurance;
use App\Models\Company\Insurance_type;
use App\Models\Company\Vehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
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
        return $this->belongsTo(Company::class);
    }

    /**
     * Define Relation between users - insurances [ one - many ]
     */
    public function insurances()
    {
        return $this->hasMany(Insurance::class);
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
    public function insurance_types()
    {
        return $this->belongsToMany(
            Insurance_type::class,
            'insurance_type_user',
            'user_id',
            'insurance_type_id',
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
}
