<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;
use App\Order;
use Redirect;
use App\Cart;

class WebviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orders($email)
    {
        $driver = Driver::where('email',$email)->get();


        $orders = Order::whereDate('created_at','=',date('Y-m-d'))->orderBy('id','DESC')->with('driver')->with('customer')->where('driver_id',$driver[0]->id)->get();
       //return $orders;
        // $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $orders[0]->created_at)->format('Y-m-d');
        // return $date.' today is : '.date('Y-m-d');
return view('webview.orders',compact('orders'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm_order($id)
    {
        $order=Order::findOrFail($id);
        $order->status = 2;
        $order->save();
        return Redirect::back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function view_order_by_driver($invm)
        {

   
    $thetotalall = 0;
       $carts_offer = Cart::with('offer')->orderBy('id','DESC')->where('original_invoice',$invm)->where('type',1)->get();
        $carts_item = Cart::with('item')->orderBy('id','DESC')->where('original_invoice',$invm)->where('type',2)->get();
         $carts_sub_item = Cart::with('child')->orderBy('id','DESC')->where('original_invoice',$invm)->where('type',3)->get();
         
//return $carts_sub_item;
         if(count($carts_offer) == 0)
         {
            $total_inv =0;
         }
         else{

       $total_inv =0;
       for($i=0 ;$i<count($carts_offer) ; $i++)
       {
$total_inv = $total_inv  + ($carts_offer[$i]->qty * $carts_offer[$i]->offer->price);

       }
   }
     if(count($carts_item) == 0)
         {
            $total_inv_item =0;
         }
else{
       $total_inv_item =0;
       for($i=0 ;$i<count($carts_item) ; $i++)
       {
$total_inv_item = $total_inv_item  + ($carts_item[$i]->qty * $carts_item[$i]->item->price);

       }
}
if(count($carts_sub_item) == 0)
{ $total_inv_child =0;}
else{
        $total_inv_child =0;
       for($i=0 ;$i<count($carts_sub_item) ; $i++)
       {
$total_inv_child = $total_inv_child  + ($carts_sub_item[$i]->qty * $carts_sub_item[$i]->child->price);

       }
   }

       $thetotalall = $total_inv_item + $total_inv +$total_inv_child;
       //return $total_inv;
       return view('webview.view_order_by_driver',compact('carts_offer','carts_item','thetotalall','carts_sub_item'));

        }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function check_inv($id)
    {
         $carts = Cart::findOrFail($id);
     if($carts->status == '0')
     {
       $carts->status = '1';
       $carts->save();
       return Redirect::Back()->with('success', 'This Item is Published');
     }
     else{
      $carts->status = '0';
      $carts->save();
      return Redirect::Back()->with('success', 'This Item is Unpublished');
    }
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
