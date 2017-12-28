<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     public function driver(){
    	return $this->hasMany('App\Driver','driver_id');
    }
}
