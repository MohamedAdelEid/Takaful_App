<?php

namespace App\Models\Company;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branche extends Model
{
    use HasFactory;

    /**
     * Define Relation between branches - policies [ one - many ]
     */
    public function policies()
    {
        return $this->hasMany(Policy::class);
    }

    /**
     * Define Relation between branches - users [ one - many ]
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
