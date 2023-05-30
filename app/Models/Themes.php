<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
class Themes extends Model
{
  use HasFactory;
  public function product()
  {
    return $this->belongsTo(Products::class);
  }
    protected $table='themes';
    protected $fillable = [
        "products_id",
        "color",
        "image",
        "in_stock",
        "seller_name",
        
    ];
}
