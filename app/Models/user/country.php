<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    protected $table = "countries";
    protected $fillable = ['country_name','country_badges'];
}
