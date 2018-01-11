<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;
use App\Order;
use Redirect;
use Session;
use App\Cart;
use App\Customer;

class WebviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orders($email)
    {
      Session::put('email' , $email);

        $driver = Driver::where('email',$email)->get();


        $orders = Order::whereDate('created_at','=',date('Y-m-d'))->orderBy('id','DESC')->with('driver')->with('customer')->where('driver_id',$driver[0]->id)->get();
        $orders_pending = Order::whereDate('created_at','=',date('Y-m-d'))->where('status','<',4)->orderBy('id','DESC')->with('driver')->with('customer')->where('driver_id',$driver[0]->id)->get();
         $orders_delivered = Order::whereDate('created_at','=',date('Y-m-d'))->where('status','!=',5)->orderBy('id','DESC')->with('driver')->with('customer')->where('driver_id',$driver[0]->id)->get();
        $counts = count($orders_pending);
         $countsdelivered = count($orders_delivered);


       //return $orders;
        // $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $orders[0]->created_at)->format('Y-m-d');
        // return $date.' today is : '.date('Y-m-d');
return view('webview.orders',compact('orders','counts','countsdelivered'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm_order(Request $r)
    {

        $id = $r->input('id_item');

try{
 $order=Order::findOrFail($id);
        $order->status = 2;
        $order->save();
 $status = 1;
            $message = 'Item successfuly Updated';
}  catch(\Exception $e){
 $status = -1;
            $message = 'Try  again';
     }

 return Response::json(['status' => $status, 'message' => $message]);
       
        //return Redirect::back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function view_order_by_driver($invm)
        {

            $orderss = Order::where('inv_id',$invm)->get();
            Session::put('customer_id',$orderss[0]->customer_id);
            $invoice_number = $orderss[0]->id;
            $stat = $orderss[0]->status;
$counts_in = Cart::where('original_invoice',$invm)->get();
$counts_status= Cart::where('original_invoice',$invm)->where('status',1)->get();

if(count($counts_in) == count($counts_status) && $stat <4)
{
    $ready = 1;


}
elseif (count($counts_in) == count($counts_status) && $stat >= 4 ) {
    $ready= 2;
}
else{

    $ready = 0;
}


   
    $thetotalall = 0;
       $carts_offer = Cart::with('offer')->orderBy('id','DESC')->where('original_invoice',$invm)->where('type',1)->get();
        $carts_item = Cart::with('item')->orderBy('id','DESC')->where('original_invoice',$invm)->where('type',2)->get();
         $carts_sub_item = Cart::with('child')->orderBy('id','DESC')->where('original_invoice',$invm)->where('type',3)->get();
          $user_name = Cart::select('the_date','the_time','comment')->where('original_invoice', $invm)->limit(1)->get();
         
         
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
       return view('webview.view_order_by_driver',compact('carts_offer','carts_item','thetotalall','carts_sub_item','ready','invoice_number','user_name'));

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
    public function finish_order($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 4;
        $order->save();
$customerid =  Session::get('customer_id');
$customers = Customer::where('id',$customerid)->get();
$title = 'Oder On way';
$message = 'On mY way max 20mns';


         error_reporting(-1);
        ini_set('display_errors', 'On');

         $res = array();
           $payload = array();
        $payload['team'] = 'Hamieh';
        $payload['score'] = '1991';

         
        $res['data']['title'] = $title;
        $res['data']['is_background'] = TRUE;
        $res['data']['message'] = $message;
        $res['data']['image'] = 'http://api.androidhive.info/images/minion.jpg';
        $res['data']['payload'] = $payload;
        $res['data']['timestamp'] = date('Y-m-d G:i:s');


// return $res;
        $to = $customers[0]->reg_id;
       
       $fields = array(
            'to' => $to,
            'data' => $res,
        );
        $api_key = 'AAAAk_ZIjvo:APA91bHCeVT1_EjwqZufv5qpxb2fbi-m2CguR47HwSOVLGOFZCoaAqvm_Ox0QyjeG_XQbsm3aFB8ZQcR8gf1ZfArn2vdttZBHcC021_A1pQmwFFDDEnqNs7JDkP8XEBeb_hxzSfsAqWI';
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            'Authorization: key='.$api_key,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

       // return $result;




       // / return Session::get('email');
        return redirect()->route('orders', ['email' => Session::get('email')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm_order_delivered($id)
    {
          $order = Order::findOrFail($id);
        $order->status = 5;
        $order->save();
       // / return Session::get('email');
        return redirect()->route('orders', ['email' => Session::get('email')]);
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
