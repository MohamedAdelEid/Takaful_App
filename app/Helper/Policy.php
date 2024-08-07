<?php

namespace App\Helper;

use Illuminate\Support\Facades\Response;

class Policy
{

    public static function getPremiumByPowerCar($power)
    {

        if ($power >= 1 && $power <= 16) {
            $premium = [
                'net_premiums' => 64,
                'tax' => 1,
                'supervision_fees' => 0.320,
                'stamps' => 0.500,
                'issuance_fees' => 3,
            ];
        } elseif ($power >= 17 && $power <= 30) {
            $premium = [
                'net_premiums' => 70,
                'tax' => 1,
                'supervision_fees' => 0.350,
                'stamps' => 0.500,
                'issuance_fees' => 3,
            ];
        } elseif ($power >= 31) {
            $premium = [
                'net_premiums' => 90,
                'tax' => 1,
                'supervision_fees' => 0.450,
                'stamps' => 0.500,
                'issuance_fees' => 3,
            ];
        }

        $premium['total_premium'] = $premium['net_premiums'] + $premium['tax'] + $premium['supervision_fees'] + $premium['stamps'] + $premium['issuance_fees'];

        return $premium;
    }

    public static function getPremiumsTravelerInsurance($days, $countryId, $traveler)
    {
        $age = $traveler->age;
        $coverage_zone = $traveler->getCoverageZoneByCountry($countryId);

        // Check Age 
        if ($age >= 2 && $age <= 15) {

            // Check zone is zone1 or zone2
            if ($coverage_zone['zone'] == 'zone1') {

                // check number of days
                if ($days == 10) {
                    $premium = [
                        'net_premiums' => 7.463,
                        'tax' => 0.500,
                        'supervision_fees' => 0.037,
                    ];
                } else if ($days == 20) {
                    $premium = [
                        'net_premiums' => 12.189,
                        'tax' => 0.500,
                        'supervision_fees' => 0.061,
                    ];
                } else if ($days == 30) {
                    $premium = [
                        'net_premiums' => 17.164,
                        'tax' => 0.500,
                        'supervision_fees' => 0.086,
                    ];
                } else if ($days == 45) {
                    $premium = [
                        'net_premiums' => 26.617,
                        'tax' => 0.500,
                        'supervision_fees' => 0.133,
                    ];
                } else if ($days == 90) {
                    $premium = [
                        'net_premiums' => 35.323,
                        'tax' => 0.500,
                        'supervision_fees' => 0.177,
                    ];
                } else if ($days == 180) {
                    $premium = [
                        'net_premiums' => 61.940,
                        'tax' => 1,
                        'supervision_fees' => 0.310,
                    ];
                } else if ($days == 365) {
                    $premium = [
                        'net_premiums' => 70.896,
                        'tax' => 1,
                        'supervision_fees' => 0.354,
                    ];
                }

            } else if ($coverage_zone['zone'] == 'zone2') {

                // check number of days
                if ($days == 10) {
                    $premium = [
                        'net_premiums' => 13.930,
                        'tax' => 0.500,
                        'supervision_fees' => 0.070,
                    ];
                } else if ($days == 20) {
                    $premium = [
                        'net_premiums' => 23.383,
                        'tax' => 0.500,
                        'supervision_fees' => 0.177,
                    ];
                } else if ($days == 30) {
                    $premium = [
                        'net_premiums' => 31.095,
                        'tax' => 0.500,
                        'supervision_fees' => 0.155,
                    ];
                } else if ($days == 45) {
                    $premium = [
                        'net_premiums' => 51.741,
                        'tax' => 1.000,
                        'supervision_fees' => 0.259,
                    ];
                } else if ($days == 90) {
                    $premium = [
                        'net_premiums' => 68.905,
                        'tax' => 1.000,
                        'supervision_fees' => 0.345,
                    ];
                } else if ($days == 180) {
                    $premium = [
                        'net_premiums' => 121.144,
                        'tax' => 1.500,
                        'supervision_fees' => 0.606,
                    ];
                } else if ($days == 365) {
                    $premium = [
                        'net_premiums' => 138.806,
                        'tax' => 1.500,
                        'supervision_fees' => 0.694,
                    ];
                }

            }

        } else if ($age >= 16 && $age <= 69) {
            if ($coverage_zone['zone'] == 'zone1') {

                // check number of days
                if ($days == 10) {
                    $premium = [
                        'net_premiums' => 14.179,
                        'tax' => 0.500,
                        'supervision_fees' => 0.071,
                    ];
                } else if ($days == 20) {
                    $premium = [
                        'net_premiums' => 22.886,
                        'tax' => 0.500,
                        'supervision_fees' => 0.114,
                    ];
                } else if ($days == 30) {
                    $premium = [
                        'net_premiums' => 31.841,
                        'tax' => 0.500,
                        'supervision_fees' => 0.159,
                    ];
                } else if ($days == 45) {
                    $premium = [
                        'net_premiums' => 52.736,
                        'tax' => 1.000,
                        'supervision_fees' => 0.264,
                    ];
                } else if ($days == 90) {
                    $premium = [
                        'net_premiums' => 70.398,
                        'tax' => 1.000,
                        'supervision_fees' => 0.352,
                    ];
                } else if ($days == 180) {
                    $premium = [
                        'net_premiums' => 123.383,
                        'tax' => 1.500,
                        'supervision_fees' => 0.617,
                    ];
                } else if ($days == 365) {
                    $premium = [
                        'net_premiums' => 141.791,
                        'tax' => 1.500,
                        'supervision_fees' => 0.709,
                    ];
                }

            } else if ($coverage_zone['zone'] == 'zone2') {

                // check number of days
                if ($days == 10) {
                    $premium = [
                        'net_premiums' => 27.612,
                        'tax' => 0.500,
                        'supervision_fees' => 0.138,
                    ];
                } else if ($days == 20) {
                    $premium = [
                        'net_premiums' => 44.776,
                        'tax' => 0.500,
                        'supervision_fees' => 0.224,
                    ];
                } else if ($days == 30) {
                    $premium = [
                        'net_premiums' => 62.186,
                        'tax' => 1.000,
                        'supervision_fees' => 0.311,
                    ];
                } else if ($days == 45) {
                    $premium = [
                        'net_premiums' => 103.483,
                        'tax' => 1.500,
                        'supervision_fees' => 0.517,
                    ];
                } else if ($days == 90) {
                    $premium = [
                        'net_premiums' => 138.308,
                        'tax' => 1.500,
                        'supervision_fees' => 0.692,
                    ];
                } else if ($days == 180) {
                    $premium = [
                        'net_premiums' => 242.040,
                        'tax' => 2.500,
                        'supervision_fees' => 1.210,
                    ];
                } else if ($days == 365) {
                    $premium = [
                        'net_premiums' => 278.109,
                        'tax' => 3.000,
                        'supervision_fees' => 1.391,
                    ];
                }

            }
        } else if ($age >= 70 && $age <= 75) {
            if ($coverage_zone['zone'] == 'zone1') {

                // check number of days
                if ($days == 10) {
                    $premium = [
                        'net_premiums' => 28.358,
                        'tax' => 0.500,
                        'supervision_fees' => 0.142,
                    ];
                } else if ($days == 20) {
                    $premium = [
                        'net_premiums' => 45.711,
                        'tax' => 0.500,
                        'supervision_fees' => 0.229,
                    ];
                } else if ($days == 30) {
                    $premium = [
                        'net_premiums' => 63.433,
                        'tax' => 1.000,
                        'supervision_fees' => 0.317,
                    ];
                } else if ($days == 45) {
                    $premium = [
                        'net_premiums' => 105.721,
                        'tax' => 1.500,
                        'supervision_fees' => 0.529,
                    ];
                } else if ($days == 90) {
                    $premium = [
                        'net_premiums' => 140.796,
                        'tax' => 1.500,
                        'supervision_fees' => 0.704,
                    ];
                } else if ($days == 180) {
                    $premium = [
                        'net_premiums' => 246.517,
                        'tax' => 2.500,
                        'supervision_fees' => 1.233,
                    ];
                } else if ($days == 365) {
                    $premium = [
                        'net_premiums' => 283.333,
                        'tax' => 3.000,
                        'supervision_fees' => 1.417,
                    ];
                }

            } else if ($coverage_zone['zone'] == 'zone2') {

                // check number of days
                if ($days == 10) {
                    $premium = [
                        'net_premiums' => 55.224,
                        'tax' => 1.000,
                        'supervision_fees' => 0.276,
                    ];
                } else if ($days == 20) {
                    $premium = [
                        'net_premiums' => 89.552,
                        'tax' => 1.000,
                        'supervision_fees' => 0.448,
                    ];
                } else if ($days == 30) {
                    $premium = [
                        'net_premiums' => 124.129,
                        'tax' => 1.500,
                        'supervision_fees' => 0.621,
                    ];
                } else if ($days == 45) {
                    $premium = [
                        'net_premiums' => 206.716,
                        'tax' => 2.500,
                        'supervision_fees' => 1.034,
                    ];
                } else if ($days == 90) {
                    $premium = [
                        'net_premiums' => 275.622,
                        'tax' => 3.000,
                        'supervision_fees' => 1.378,
                    ];
                } else if ($days == 180) {
                    $premium = [
                        'net_premiums' => 482.090,
                        'tax' => 5.000,
                        'supervision_fees' => 2.410,
                    ];
                } else if ($days == 365) {
                    $premium = [
                        'net_premiums' => 554.478,
                        'tax' => 6.000,
                        'supervision_fees' => 2.772,
                    ];
                }

            }
        } else {
            return Response::json(['error' => 'العمر غير مقبول'], 404);
        }

        $premium['stamps'] = 0.250;
        $premium['issuance_fees'] = 2;
        $premium['total_premium'] = $premium['net_premiums'] + $premium['tax'] + $premium['supervision_fees'] + $premium['stamps'] + $premium['issuance_fees'];

        return $premium;
    }

}