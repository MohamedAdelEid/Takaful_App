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
    public function traveler()
    {
        return $this->belongsTo(Traveler::class);
    }

    /**
     * Define Relation between dependents - dependent [ many - many ]
     */
    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_dependent');
    }
}
