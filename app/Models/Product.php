<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'seller_id',
        'name',
        'description',
        'category',
        'stock_quantity',
        'image_path',
    ];

    public function fruits()
    {
        return $this->hasMany(Fruit::class, 'product_id');
    }
}
