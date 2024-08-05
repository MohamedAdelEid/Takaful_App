<?php

namespace App\Helper;

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

}