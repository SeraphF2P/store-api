<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Owner extends Authenticatable implements AuthenticatableContract
{
  protected $table ='owners';
  protected $guard = 'owner';
  protected $fillable = [
    'name','password'
  ];
    use HasFactory;
}
