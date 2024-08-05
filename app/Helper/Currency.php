<?php

namespace App\Helper;

use NumberFormatter;

class Currency
{

    public static function format($amount, $showCurrency = true , $currency = null )
    {
        $amount = (double) $amount;
        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);

        $formatter->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 0);
        $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 3);

        if ($currency === null) {
            $currency = config('app.currency');
        }

        if ($showCurrency) {
            // Format with currency symbol
            return $formatter->formatCurrency($amount, $currency);
        } else {
            // Format without currency symbol
            $formatter->setPattern('#,##0.000');
            return $formatter->format($amount);
        }
    }

}
