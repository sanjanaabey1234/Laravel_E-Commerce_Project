<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    protected $primaryKey = 'seller_id';

    protected $fillable = ['user_id', 'seller_name', 'district_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function fruits()
    {
        return $this->hasMany(Fruit::class, 'seller_id');
    }
    public function vegetables()
    {
        return $this->hasMany(Vegitable::class, 'seller_id');
    }
    public function clothes()
    {
        return $this->hasMany(Clothe::class, 'seller_id');
    }
    public function handmadeproducts()
    {
        return $this->hasMany(HandMadeProduct::class, 'seller_id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'seller_id');
    }
}

