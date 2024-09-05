<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vegitable extends Model
{
    use HasFactory;
    protected $table = 'vegitables';

    protected $primaryKey = 'vegitable_id';

    protected $fillable = [
        'product_id',
        'seller_id',
        'description',
        'price',
        'Amount',
        'stock_quantity',
        'vegitable_name',
        'image_path',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
