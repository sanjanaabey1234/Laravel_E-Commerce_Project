<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
    protected $primaryKey = 'buyer_id';

    protected $fillable = ['user_id', 'shipping_address', 'buyer_name', 'district_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
