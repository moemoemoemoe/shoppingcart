@extends('layouts.app')

@section('content')
<div class="container" style="font-weight: 900">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center" style="color: red;font-weight: 900">Username : {{$carts[0]->iduser}}
<span class="pull-right">Total: {{$thetotalall}} L.L</span></div>

               <table style="text-align: center;border: 1px solid #ddd!important">
                    @foreach($carts as $cart)
  
       <tr border: 1px solid #ddd!important>
        <td style="height:50px;width:50px; background: url('{{asset('uploads/offers/'.$cart->offer->img_name)}}'); background-size: 100%; background-position: center center;border: 1px solid #ddd!important"></td>
        <td style="width:300px;border: 1px solid #ddd!important">{{ $cart->offer->title }}</td>
        <td style="width:200px;border: 1px solid #ddd!important">{{$cart->qty}}</td>
        <td style="width:350px;border: 1px solid #ddd!important">{{$cart->offer->price}} L.L</td>
        <td style="width:350px;border: 1px solid #ddd!important"><?php echo $cart->qty * $cart->offer->price;  ?> L.L</td>
  
    @endforeach
     @foreach($carts_item as $cartitem)
  
       <tr border: 1px solid #ddd!important>
        <td style="height:50px;width:50px; background: url('{{asset('uploads/items/'.$cartitem->item->img_name)}}'); background-size: 100%; background-position: center center;border: 1px solid #ddd!important"></td>
        <td style="width:300px;border: 1px solid #ddd!important">{{ $cartitem->item->title }}</td>
        <td style="width:200px;border: 1px solid #ddd!important">{{$cartitem->qty}}</td>
        <td style="width:350px;border: 1px solid #ddd!important">{{$cartitem->item->price}} L.L</td>
        <td style="width:350px;border: 1px solid #ddd!important"><?php echo $cartitem->qty * $cartitem->item->price;  ?> L.L</td>
  
    @endforeach

</table>

  
   
                </div>
            </div>
        </div>
    </div>

@endsection
