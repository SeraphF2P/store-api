<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public function themes()
    {
        return $this->hasMany(Theme::class);
    }
    protected $table = "products";
    protected $fillable = [
        'name',
        'price',
        "category",
        "seller_name",
        "description",
    ];
}
