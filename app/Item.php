<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    
     public function brande(){
    	return $this->belongsTo('App\Brande','brand_id');
    }
}
