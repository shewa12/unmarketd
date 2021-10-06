<?php

namespace admin;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //table name
    public $table= "activities";
    protected $guarded= [];
}
