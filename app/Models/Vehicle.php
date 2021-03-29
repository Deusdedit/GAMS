<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Service;
// use App\Accident;
// use App\Maintenance;

class Vehicle extends Model
{
    use HasFactory;
    
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function accidents()
    {
        return $this->belongsToMany(Accident::class);
    }

    public function maintenances()
    {
        return $this->belongsToMany(Maintenance::class);
    }

    public function disposals()
    {
        return $this->belongsTo(Disposal::class);
    }

    public function fuels()
    {
        return $this->hasMany(Fuel::class);
    }

    public function drivers()
    {
        return $this->belongsTo(Driver::class);
    }

    public function assets()
    {
        return $this->belongsTo(Asset::class);
    }
}
