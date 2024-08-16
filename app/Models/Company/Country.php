<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function orangeInsuranceCountries()
    {
        return $this->belongsToMany(OrangeVisitedCountry::class, 'country_orange_visited_country');
    }
}
