<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable = ['products_id','products_name','products_price','amount','total','users_id'];
}
