<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function offer(){
    	return $this->belongsTo('App\Offer');
    }
     public function item(){
    	return $this->belongsTo('App\Item');
    }
     public function child(){
    	return $this->belongsTo('App\Sub');
    }
    
}
