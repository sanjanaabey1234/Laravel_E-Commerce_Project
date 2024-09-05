<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';
    protected $primaryKey = 'district_id';

    protected $fillable = ['name', 'state', 'country'];

    public function buyers()
    {
        return $this->hasMany(Buyer::class);
    }
    public function sellers()
    {
        return $this->hasMany(Seller::class);
    }
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }


}
