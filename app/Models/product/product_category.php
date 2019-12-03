<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;

class product_category extends Model
{
    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo('App\Models\product\product_category', 'id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\product\product_category', 'id');
    }
}
