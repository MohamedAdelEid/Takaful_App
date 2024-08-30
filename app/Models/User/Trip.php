<?php

namespace App\Models\User;

use App\Models\Company\CoverageArea;
use App\Models\Company\Policy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Define Relation between  travelers - trip [ one - one ]
     */
    public function traveler()
    {
        return $this->belongsTo(Traveler::class);
    }

    /**
     * Define Relation between  policy - trip [ one - one ]
     */
    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }

    /**
     * Define Relation between  trips - dependents [ one - many ]
     */

    public function dependents()
    {
        return $this->belongsToMany(Dependent::class, 'dependent_trip');
    }

    public function coverageArea()
    {
        return $this->belongsTo(CoverageArea::class);
    }
}
