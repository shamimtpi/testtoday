<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Model;

class usereducation extends Model
{
    protected $table="usereducations";
    protected $fillable=['user_id','institute_name','degree','passing_year','details'];
}
