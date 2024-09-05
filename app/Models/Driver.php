<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $primaryKey = 'driver_id';

    protected $fillable = ['user_id', 'driver_name', 'Phone_no', 'vehicle_info', 'district_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function delevery()
    {
        return $this->hasMany(Delivery::class, 'driver_id');
    }
}
