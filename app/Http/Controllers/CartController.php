<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use response;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function get_cart($data)
    {
        //$json = $r->input('datadata');
        try{
        $cart = new Cart();
        $cart->json_cart = $data;
        $cart->save();
          return "[{".'"status":'.'"Uploaded Successfully"'."}]";
    }  catch(\Exception $e){
       // do task when error
      return "[{".'"status":'.'"Error Please try again"'."}]";
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_all_cart()
    {
        $cart = Cart::orderBy('id','DESC')->get();
        return $cart[0];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
