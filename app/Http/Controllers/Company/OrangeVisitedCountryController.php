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

            return $this->successResponse($countries, 'Visited Countries retrieved successfully!', 200);
        } catch (Exception $e) {
            return $this->errorResponse(['error' => 'An error occurred!', 'massage' => $e->getMessage()], 500);
        }
    }
}
