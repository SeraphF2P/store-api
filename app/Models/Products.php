<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Themes;
use App\Models\User;
class Products extends Model
{
    use HasFactory;
    public function themes()
    {
        return $this->hasMany(Themes::class);
    }
    public function seller()
    {
        return $this->belongsTo(User::class);
    }
    protected $table = "products";
    protected $fillable = [
        'name',
        'price',
        "category",
        "seller_name",
        "rating",
        "description",
        "users_id"
    ];
}
