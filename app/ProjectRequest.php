<?php

namespace admin;

use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    //table name
    public $table= 'project_req';
    protected $guarded= [];
}
