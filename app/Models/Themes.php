<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->hasOne(Product::class);
    }
    protected $fillable = [
        "product_id",
        "color",
        "image",
        "in_stock",
        "seller_name",
    ];
}
