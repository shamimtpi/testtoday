<?php
namespace App\Models\user;
use Illuminate\Database\Eloquent\Model;

class user_skill_list extends Model
{
    protected $table ='user_skill_lists';
    protected $fillable=['user_id','title','skill_vlue'];
}
