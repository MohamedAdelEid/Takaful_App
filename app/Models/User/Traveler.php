<?php

namespace App\Models\User;

use App\Models\Company\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traveler extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define Relation between  travelers - dependents [ one - many ]
     */
    public function traveler()
    {
        return $this->hasMany(Traveler::class);
    }

    public function countries()
    {
        return $this->belongsToMany(
            Country::class,
            'country_traveler',
            'traveler_id',
            'country_id',
            'id',
            'id'
        );
    }
}
