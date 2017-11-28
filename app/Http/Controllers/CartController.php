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

//{"data":[{"Id":11,"qty":1},{"Id":13,"qty":4}]}
    public function get_cart($data,$userid)
    {  $invoice_number = mt_rand(111111,999999);
        $user = json_decode($data);
        try{
            foreach($user->data as $mydata)

            {

               $cart = new Cart();
               $cart->offer_id = $mydata->Id;
               $cart->qty = $mydata->qty;
               $cart->idoffer = $mydata->Id;
               $cart->iduser = $userid;
               $cart->invnum = $invoice_number;
               $cart->save();
           }   
           return "[{".'"status":'.'"Uploaded Successfully"'."}]";   
       }  
       catch(\Exception $e){

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
