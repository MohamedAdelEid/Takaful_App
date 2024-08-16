<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangeVisitedCountry extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_orange_visited_country');
    }
    public function policies()
    {
        return $this->belongsToMany(Policy::class, 'orange_visited_country_policy');
    }

    public function getNumCountriesAttribute()
    {
        // Count the number of related countries for this instance
        return $this->countries()->count();
    }

}
