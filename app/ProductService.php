<?php

namespace admin;

use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    //table name
    public $table= "products_services";
    protected $guarded= [];
}
