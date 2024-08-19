<?php

namespace App\Helper;

use App\Models\AvailableCar;
use App\Models\Company\OrangeVisitedCountry;
use App\Models\Item;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;

class Policy
{

    // compulsory_car_insurance
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

    // traveler_insurance 
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
            return Response::json(['error' => ['massage' => 'العمر غير مقبول']], 404);
        }

        $premium['stamps'] = 0.250;
        $premium['issuance_fees'] = 2;
        $premium['total_premium'] = $premium['net_premiums'] + $premium['tax'] + $premium['supervision_fees'] + $premium['stamps'] + $premium['issuance_fees'];

        return $premium;
    }

    // orange_car_insurance
    public static function getPremiumsOrangeInsurance($request)
    {

        // Handle RequestDate
        $startDate = $request->start_date;
        $insurancePeriod = $request->insurance_period;
        $countryId = $request->country_visited_id;
        $availableCarId = $request->available_car_id;

        // give id each OrangeVisitedCountry 
        $tunisiaId = OrangeVisitedCountry::where('name', 'تونس')->value('id');
        $algeriaId = OrangeVisitedCountry::where('name', 'الجزائر')->value('id');
        $algeriaTunisiaId = OrangeVisitedCountry::where('name', 'تونس والجزائر')->value('id');
        $egyptId = OrangeVisitedCountry::where('name', 'مصر')->value('id');

        // set static values to premium
        $premium['issuance_fees'] = 10;
        $premium['stamps'] = 0.5;

        if ($countryId == $tunisiaId) {
            $minDays = 7;
            $maxDays = 90;

            // 1 - Check if Insurance_period < 7 && > 90 day
            if ($insurancePeriod < $minDays) {
                return Response::json(['error' => ['massage' => "مدة التامين يجب ان تكون اكثر من $minDays ايام"]], 422);
            } else if ($insurancePeriod > $maxDays) {
                return Response::json(['error' => ['massage' => "مدة التامين يجب ان تكون اقل من $maxDays يوم"]], 404);
            }

            // add end_date to array request
            $end_date = Carbon::parse($startDate)->addDays($insurancePeriod)->toDateTimeString();
            $request->merge(['end_date' => $end_date]);

            // 2.1 - Check if avaliable_car related any item ! 
            $item1Id = Item::where('name', 'البند الاول')->value('id');
            $item2Id = Item::where('name', 'البند الثاني')->value('id');

            $avilableCarItem1 = AvailableCar::with('item')
                ->where('id', $availableCarId)
                ->whereHas('item', function ($query) use ($item1Id) {
                    $query->where('id', $item1Id);
                })
                ->first();

            $avilableCarItem2 = AvailableCar::with('item')
                ->where('id', $availableCarId)
                ->whereHas('item', function ($query) use ($item2Id) {
                    $query->where('id', $item2Id);
                })
                ->first();

            if ($avilableCarItem1) {

                $dailyPremium = 7;
                $increaseSupervisionFees = 0.035;
                $startTax = 1;
                $extraDays = $insurancePeriod - $minDays;

                $premium['net_premiums'] = $dailyPremium * $insurancePeriod;
                $premium['supervision_fees'] = $insurancePeriod * $increaseSupervisionFees;
                $premium['tax'] = $startTax + 0.5 * floor(($insurancePeriod - 8) / 7);

                $premium['total_premium'] = $premium['net_premiums'] + $premium['tax'] + $premium['supervision_fees'] + $premium['stamps'] + $premium['issuance_fees'];

            } else if ($avilableCarItem2) {

                $dailyPremium = 8;
                $increaseSupervisionFees = 0.04;
                $startTax = 1;
                $extraDays = $insurancePeriod - $minDays;

                $premium['net_premiums'] = $dailyPremium * $insurancePeriod;
                $premium['supervision_fees'] = $increaseSupervisionFees * $insurancePeriod;
                $premium['tax'] = ((floor($extraDays / 5) * 0.5) + $startTax);

                $premium['total_premium'] = $premium['net_premiums'] + $premium['tax'] + $premium['supervision_fees'] + $premium['stamps'] + $premium['issuance_fees'];

            }

        } else if ($countryId == $algeriaId) {
            $minDays = 7;
            $maxDays = 90;

            // 1 - Check if Insurance_period < 7 && > 90 day
            if ($insurancePeriod < $minDays) {
                return Response::json(['error' => ['massage' => "مدة التامين يجب ان تكون اكثر من $minDays ايام"]], 422);
            } else if ($insurancePeriod > $maxDays) {
                return Response::json(['error' => ['massage' => "مدة التامين يجب ان تكون اقل من $maxDays يوم"]], 404);
            }

            // add end_date to array request
            $end_date = Carbon::parse($startDate)->addDays($insurancePeriod)->toDateTimeString();
            $request->merge(['end_date' => $end_date]);

            // 2.1 - Check if avaliable_car related any item ! 
            $item1Id = Item::where('name', 'البند الاول')->value('id');
            $item2Id = Item::where('name', 'البند الثاني')->value('id');

            $avilableCarItem1 = AvailableCar::with('item')
                ->where('id', $availableCarId)
                ->whereHas('item', function ($query) use ($item1Id) {
                    $query->where('id', $item1Id);
                })
                ->first();

            $avilableCarItem2 = AvailableCar::with('item')
                ->where('id', $availableCarId)
                ->whereHas('item', function ($query) use ($item2Id) {
                    $query->where('id', $item2Id);
                })
                ->first();

            if ($avilableCarItem1) {

                $dailyPremium = 7;
                $increaseSupervisionFees = 0.035;
                $startTax = 1;
                $extraDays = $insurancePeriod - $minDays;

                $premium['net_premiums'] = $dailyPremium * $insurancePeriod;
                $premium['supervision_fees'] = $insurancePeriod * $increaseSupervisionFees;
                $premium['tax'] = $startTax + 0.5 * floor(($insurancePeriod - 8) / 7);

                $premium['total_premium'] = $premium['net_premiums'] + $premium['tax'] + $premium['supervision_fees'] + $premium['stamps'] + $premium['issuance_fees'];

            } else if ($avilableCarItem2) {

                $dailyPremium = 8;
                $increaseSupervisionFees = 0.04;
                $startTax = 1;
                $extraDays = $insurancePeriod - $minDays;

                $premium['net_premiums'] = $dailyPremium * $insurancePeriod;
                $premium['supervision_fees'] = $increaseSupervisionFees * $insurancePeriod;
                $premium['tax'] = ((floor($extraDays / 5) * 0.5) + $startTax);

                $premium['total_premium'] = $premium['net_premiums'] + $premium['tax'] + $premium['supervision_fees'] + $premium['stamps'] + $premium['issuance_fees'];

            }

        } else if ($countryId == $algeriaTunisiaId) {

            $minDays = 7;
            $maxDays = 90;

            // 1 - Check if Insurance_period < 7 && > 90 day
            if ($insurancePeriod < $minDays) {
                return Response::json(['error' => ['massage' => "مدة التامين يجب ان تكون اكثر من $minDays ايام"]], 422);
            } else if ($insurancePeriod > $maxDays) {
                return Response::json(['error' => ['massage' => "مدة التامين يجب ان تكون اقل من $maxDays يوم"]], 404);
            }

            // add end_date to array request
            $end_date = Carbon::parse($startDate)->addDays($insurancePeriod)->toDateTimeString();
            $request->merge(['end_date' => $end_date]);

            // 2 - Calculate premium
            $increaseSupervisionFees = 0.055;
            $dailyPremium = 11;
            $premium['net_premiums'] = $dailyPremium * $insurancePeriod;
            $premium['supervision_fees'] = $insurancePeriod * $increaseSupervisionFees;
            $premium['tax'] = round($premium['net_premiums'] * 0.01);

            $premium['total_premium'] = $premium['net_premiums'] + $premium['tax'] + $premium['supervision_fees'] + $premium['stamps'] + $premium['issuance_fees'];

        } else if ($request->country == $egyptId) {

            $minDays = 15;
            $maxDays = 90;

            // 1 - Check if Insurance_period < 7 && > 90 day
            if ($insurancePeriod < $minDays) {
                return Response::json(['error' => ['massage' => "مدة التامين يجب ان تكون اكثر من $minDays ايام"]], 422);
            } else if ($insurancePeriod > $maxDays) {
                return Response::json(['error' => ['massage' => "مدة التامين يجب ان تكون اقل من $maxDays يوم"]], 404);
            }

            // add end_date to array request
            $end_date = Carbon::parse($startDate)->addDays($insurancePeriod)->toDateTimeString();
            $request->merge(['end_date' => $end_date]);

            // 2 - Calculate premium
            $dailyPremium = 3;
            $increaseSupervisionFees = 0.015;

            $premium['issuance_fees'] = 10;
            $premium['stamps'] = 0.5;
            $premium['net_premiums'] = $dailyPremium * $insurancePeriod;
            $premium['supervision_fees'] = $increaseSupervisionFees * $insurancePeriod;

            if ($insurancePeriod >= 15 && $insurancePeriod <= 16) {
                $premium['tax'] = 0.5;
            } else if ($insurancePeriod >= 17 && $insurancePeriod <= 33) {
                $premium['tax'] = 1;
            } else if ($insurancePeriod >= 34 && $insurancePeriod <= 50) {
                $premium['tax'] = 1.5;
            } else if ($insurancePeriod >= 51 && $insurancePeriod <= 66) {
                $premium['tax'] = 2;
            } else if ($insurancePeriod >= 67 && $insurancePeriod <= 83) {
                $premium['tax'] = 2.5;
            } else if ($insurancePeriod >= 84 && $insurancePeriod <= 90) {
                $premium['tax'] = 3;
            }

            $premium['total_premium'] = $premium['net_premiums'] + $premium['tax'] + $premium['supervision_fees'] + $premium['stamps'] + $premium['issuance_fees'];

        } else {
            return Response::json(["error" => ['massage' => 'البلد المزار غير صحيحة']], 404);
        }

        return $premium;
    }

}