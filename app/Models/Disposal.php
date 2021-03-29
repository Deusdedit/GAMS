<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposal extends Model
{
    use HasFactory;

    public function assets()
    {
        return $this->belongsTo(Asset::class);
    }
    
    public function generators()
    {
        return $this->hasMany(Generator::class);
    }
    
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
