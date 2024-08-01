<?php

namespace App\Models\Company;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    /**
     * Define Relation between insurances - policy [ many - one ]
     */

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }
}
