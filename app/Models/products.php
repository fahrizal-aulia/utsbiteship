<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category');
    }

    public function brand()
    {
        return $this->belongsTo(Brands::class, 'product_brand');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'idproduct', 'id');
    }
}
