<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_insurance extends Model
{
    use HasFactory;

    protected $table = 'medical_insurances';
    protected $fillable = [
        'id',
        'name_company',
        'insurance_coverage',
        'number_emplyee',
        'number_of_family',
        'coverage_amount',
        'insurance_status',
        'full_name',
        'email',
        'phone_number',
        'created_at',
        'updated_at',
    ];


    protected $appends = ['ImageUrl'];


    public function getImageUrlAttribute()
    {
        return env('APP_URL'). '/img/about/' . $this->img;
    }




}
