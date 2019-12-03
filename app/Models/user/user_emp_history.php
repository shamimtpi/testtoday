<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Model;

class user_emp_history extends Model
{
    protected $table="user_emp_histories";
    protected $fillable=['user_id','title','company_name','start_date','end_date','emp_details'];
}
