<?php

namespace App\Models\Company;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'user_id',
        'policy_id',
        'plate_number',
        'chassis_number',
        'type',
        'number_of_seats',
        'engine_hours_power',
        'load_tonnage',
        'color',
        'make',
        'model',
        'vehicle_place_of_registration',
        'purpose_of_license',
        'year_of_manufacturing',
        'details'
    ];
    /**
     * Define Relation between vehicles - users [ many - one ]
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }
}
