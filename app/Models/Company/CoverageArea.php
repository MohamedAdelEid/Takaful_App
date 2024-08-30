<?php

namespace App\Models\Company;

use App\Models\User\Trip;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoverageArea extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
