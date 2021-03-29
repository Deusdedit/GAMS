<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Vehicle;
// use App\Generator;

class Maintenance extends Model
{
    use HasFactory;
    
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }

    public function generators()
    {
        return $this->belongsToMany(Generator::class);
    }
}
