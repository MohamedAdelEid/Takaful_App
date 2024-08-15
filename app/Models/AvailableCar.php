<?php

namespace App\Models;

use App\Models\Company\Policy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableCar extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'item_id'];
    protected $table = 'available_cars';

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function policies()
    {
        return $this->belongsToMany(Policy::class, 'available_car_policy');
    }
}
