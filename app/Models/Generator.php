<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Service;
// use App\Maintenace;

class Generator extends Model
{
    use HasFactory;
    
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function maintenances()
    {
        return $this->belongsToMany(Maintenace::class);
    }

    public function disposals()
    {
        return $this->belongsTo(Disposal::class);
    }

    public function fuels()
    {
        return $this->hasMany(Fuel::class);
    }

    public function assets()
    {
        return $this->belongsTo(Asset::class);
    }
}
