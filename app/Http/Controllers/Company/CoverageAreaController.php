<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\CoverageArea;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CoverageAreaController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            $coverageArea = CoverageArea::all();

            return $this->successResponse($coverageArea, 'Coverage Areas retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }
}
