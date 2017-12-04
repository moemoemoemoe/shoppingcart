<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\Generic;
use App\Logs;

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
