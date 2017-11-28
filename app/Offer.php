<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function cart(){
    	return $this->belongsTo('App\Cart');
    }
}
