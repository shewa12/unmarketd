<?php

namespace admin;

use Illuminate\Database\Eloquent\Model;

class UserServices extends Model
{
    //table name
    public $table= "services";
    protected $guarded= [];
}
