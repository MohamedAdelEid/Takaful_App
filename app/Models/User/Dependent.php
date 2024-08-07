<?php

namespace App\Models\User;

use App\Models\Company\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Define Relation between dependents - travelers [ many - one ]
     */
    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'dependent_trip', 'dependent_id', 'trip_id');
    }

    /**
     * Define Relation between dependents - dependent [ many - many ]
     */
    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_dependent');
    }
}
