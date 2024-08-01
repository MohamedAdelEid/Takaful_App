<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\Country;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Exception;

class CountryController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        try {
            $countries = Country::all();
            return $this->successResponse($countries, 'Countries retrieved Successfully !' , 200);
        } catch (Exception $e) {
            return $this->errorResponse(['massage' => 'An error occurred', 'erorr' => $e->getMessage()], 500);
        }
    }
}
