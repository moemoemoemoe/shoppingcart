<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    
     public function brande(){
    	return $this->belongsTo('App\Brande','brand_id')->select(['id', 'brande_name']);
    }
     public function sub(){
    	return $this->hasMany('App\Sub')->select(['id', 'name_sub','price','item_id','image_url_original','content']);
    }
}
