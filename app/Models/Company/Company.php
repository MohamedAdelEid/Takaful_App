<?php

namespace App\Models\Company;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * Define Relation between company - users [ one - many ]
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
