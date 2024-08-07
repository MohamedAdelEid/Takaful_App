<?php

namespace App\Models\User;

use App\Models\Company\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;

class Traveler extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define Relation between  travelers - trip [ one - one ]
     */
    public function trips(){
        return $this->hasMany(Trip::class);
    }

    public function countries()
    {
        return $this->belongsToMany(
            Country::class,
            'country_traveler',
            'traveler_id',
            'country_id',
            'id',
            'id'
        );
    }

    public function getCoverageZoneByCountry($countryId)
    {
        $zone1Countries = $this->Countries_zone1;
        $zone2Countries = $this->Countries_zone2;

        $zone1CountriesId = $zone1Countries->pluck('id')->toArray();
        $zone2CountriesId = $zone2Countries->pluck('id')->toArray();

        if (in_array($countryId, $zone1CountriesId)) {
            return [
                'zone' => 'zone1',
                'description' => 'provides cover worldwide except Libya, USA, Canada, Japan and Australia'
            ];
        } else if (in_array($countryId, $zone2CountriesId)) {
            return [
                'zone' => 'zone2',
                'description' => 'provides cover USA, Canada, Japan and Australia only'
            ];
        }
        return Response::json(['error' => 'هذة الدولة غير صالحة'], 404);
    }

    public function getCountriesZone1Attribute()
    {
        return Country::whereNotIn('name', ['Libya', 'United States', 'Canada', 'Australia', 'Japan'])->get();
    }

    public function getCountriesZone2Attribute()
    {
        return Country::whereIn('name', ['United States', 'Canada', 'Australia', 'Japan'])->get();
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_of_birth)->age;
    }
}
