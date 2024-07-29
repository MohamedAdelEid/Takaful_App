<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class ValidateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //create custom validation check status
        Validator::extend('check', function ($attribute, $value, $parameters, $validator) {
            // Parameters: [table, idColumn, idValue, attribute, expectedValue]
            $table = $parameters[0];
            $idColumn = $parameters[1];
            $idValue = $parameters[2];
            $checkAttribute = $parameters[3];
            $expectedValue = $parameters[4];

            return DB::table($table)
                ->where($idColumn, $idValue)
                ->where($checkAttribute, $expectedValue)
                ->exists();
        });
    }
}
