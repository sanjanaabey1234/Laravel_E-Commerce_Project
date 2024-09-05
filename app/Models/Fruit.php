<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    use HasFactory;
    protected $table = 'fruits';

    protected $primaryKey = 'fruit_id';

    protected $fillable = [
        'product_id',
        'seller_id',
        'description',
        'price',
        'Amount',
        'stock_quantity',
        'fruit_name',
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
