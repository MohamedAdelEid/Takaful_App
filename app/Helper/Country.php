<?php

namespace App\Helper;

use App\Models\User\Traveler;
use Illuminate\Support\Facades\Response;
use App\Models\Company\Country as CountryModel;

class Country
{

    public static function getDaysByCountry($countryId)
    {
        $travel = new Traveler;
        $exceptsCountries = $travel->Countries_zone1;
        $acceptCountries = $travel->Countries_zone2;

        $exceptsCountriesId = $exceptsCountries->pluck('id')->toArray();
        $acceptCountriesId = $acceptCountries->pluck('id')->toArray();

        if (!in_array($countryId, $exceptsCountriesId)) {
            $data = [
                '10',
                '20',
                '30',
                '45',
                '90',
                '180',
                '365',
            ];
        } elseif (in_array($countryId, $acceptCountriesId)) {
            $data = [
                '10',
                '20',
                '30',
                '45',
                '90',
            ];
        } else {
            return Response::json(['error' => 'Country is invalid'], 404);
        }
        return $data;
    }

}