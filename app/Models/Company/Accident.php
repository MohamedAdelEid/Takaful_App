<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }
    
}
