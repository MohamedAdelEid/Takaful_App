<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\OrangeVisitedCountry;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Exception;

class OrangeVisitedCountryController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {

        try {
            $countries = OrangeVisitedCountry::all();

            // Ensure accessors are added to each model
            $countries->each(function ($country) {
                $country->num_countries = $country->num_countries;
            });

            return $this->successResponse($countries, 'Visited Countries retrieved successfully!', 200);
        } catch (Exception $e) {
            return $this->errorResponse(['error' => 'An error occurred!', 'massage' => $e->getMessage()], 500);
        }
    }
}
