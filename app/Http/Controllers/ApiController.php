<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\Generic;
use App\Logs;
use App\Item;
use App\Saver;
use App\Sub;
class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_offers()
    {
        $offers = Offer::select('id','image_url_original','cat_id')->orderBy('id','DESC')->where('status',1)->get();

        return '{
  "offers":'.$offers.'}';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function spec_offer($id)
    {
        $offers = Offer::select('id','title','image_url_original','content','price')->orderBy('id','DESC')->where('cat_id', $id)->where('status',1)->get();
        return $offers;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function single_offer($id)
    {
        $offer =Offer::select('id','title','content','image_url_original','price')->where('id',$id)->get();
        return $offer;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_all_generics()
    {
        $generics = Generic::select('id','generic_name','image_url_original','zone_id')->OrderBy('id','ASC')->get();
        return $generics;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logs()
    {
        //

        $logs = Logs::select('id','table_id','query')->orderBy('id','DESC')->where('status',1)->get();
        return $logs;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generics_api($zone_id)
    {
       $generics= Generic::select('id','generic_name','image_url_original')->orderBy('id','ASC')->where('zone_id',$zone_id)->get();
       return $generics;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function items_api($zone_id,$generic_id)
    {
        $items = Item::select('id','name','content','brand_id','has_sub','price','image_url_original')->with('sub')->with('brande')->where('zone_id',$zone_id)->where('generic_id',$generic_id)->get();
        return $items;

    }
    public function get_savers()
    {


        $savers = Saver::orderBy('id','DESC')->where('status',1)->get();

     
  return $savers;
    }

    public function get_subs()
    {


        $subs = Sub::OrderBy('id','DESC')->get();
        return $subs;
    }
     public function single_search($id)
    {
        $search =Sub::where('id',$id)->get();
        return $search;
    }
}
