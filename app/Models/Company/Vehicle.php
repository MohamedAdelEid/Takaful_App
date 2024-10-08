<?php

namespace App\Models\Company;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = [];

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

    protected static function booted()
    {

    }
}
