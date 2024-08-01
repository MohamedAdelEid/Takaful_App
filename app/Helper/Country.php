<?php

namespace App\Helper;

use Illuminate\Support\Facades\Response;
use App\Models\Company\Country as CountryModel;

class Country
{

    public static function getDaysByCountry($countryId)
    {
        $exceptsCountries = CountryModel::whereIn('name', ['Libya', 'United States', 'Canada', 'Australia', 'Japan'])->get();
        $acceptCountries = $exceptsCountries->filter(function ($country) {
            return $country->name !== 'Libya';
        });
        $exceptsCountriesId = $exceptsCountries->pluck('id')->toArray();
        $acceptCountriesId = $acceptCountries->pluck('id')->toArray();

        if (!in_array($countryId, $exceptsCountriesId)) {
            $data = [
                [
                    'days' => '10',
                    'price' => '17000',
                ],
                [
                    'days' => '20',
                    'price' => '25750',
                ],
                [
                    'days' => '30',
                    'price' => '34750',
                ],
                [
                    'days' => '45',
                    'price' => '56250',
                ],
                [
                    'days' => '90',
                    'price' => '74000',
                ],
                [
                    'days' => '180',
                    'price' => '127750',
                ],
                [
                    'days' => '365',
                    'price' => '146250',
                ]
            ];
        } elseif (in_array($countryId, $acceptCountriesId)) {
            $data = [
                [
                    'days' => '10',
                    'price' => '30500',
                ],
                [
                    'days' => '20',
                    'price' => '47750',
                ],
                [
                    'days' => '30',
                    'price' => '65750',
                ],
                [
                    'days' => '45',
                    'price' => '107750',
                ],
                [
                    'days' => '90',
                    'price' => '142750',
                ]
            ];
        } else {
            return Response::json(['error' => 'Country is invalid'], 404);
        }
        return $data;
    }

}