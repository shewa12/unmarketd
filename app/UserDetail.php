<?php

namespace admin;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    //table name
    public $table= "user_detail";
    protected $guarded= [];
}
