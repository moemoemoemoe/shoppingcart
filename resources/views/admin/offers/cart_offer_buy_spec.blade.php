@extends('layouts.app')

@section('content')
<div class="container" style="font-weight: 900">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center" style="color: red;font-weight: 900">


                    Username : ABCDEF
<span class="pull-right">Total: {{$thetotalall}} L.L</span></div>

               <table style="text-align: center;border: 1px solid #ddd!important">
                @if(count($carts_offer)==0)
                @else
                    @foreach($carts_offer as $cart)
                
  
       <tr border: 1px solid #ddd!important>
        <td style="height:100px;width:100px; background: url('{{asset('uploads/offers/'.$cart->offer->img_name)}}'); background-size: contain; background-position: center center;border: 1px solid #ddd!important"></td>
        <td style="width:300px;border: 1px solid #ddd!important">{{ $cart->offer->title }}</td>
        <td style="width:200px;border: 1px solid #ddd!important">{{$cart->qty}}</td>
        <td style="width:350px;border: 1px solid #ddd!important">{{$cart->offer->price}} L.L</td>
        <td style="width:350px;border: 1px solid #ddd!important"><?php echo $cart->qty * $cart->offer->price;  ?> L.L</td>
  
    @endforeach
    @endif
       @if(count($carts_item)==0)
                @else
     @foreach($carts_item as $cartitem)
  
       <tr border: 1px solid #ddd!important>
        <td style="height:100px;width:100px; background: url('{{asset('uploads/items/'.$cartitem->item->img_name)}}'); background-size: contain; background-position: center center;border: 1px solid #ddd!important"></td>
        <td style="width:300px;border: 1px solid #ddd!important">{{ $cartitem->item->name }}</td>
        <td style="width:200px;border: 1px solid #ddd!important">{{$cartitem->qty}}</td>
        <td style="width:350px;border: 1px solid #ddd!important">{{$cartitem->item->price}} L.L</td>
        <td style="width:350px;border: 1px solid #ddd!important"><?php echo $cartitem->qty * $cartitem->item->price;  ?> L.L</td>
  
    @endforeach
  @endif
    @if(count($carts_sub_item)==0)
                @else
     @foreach($carts_sub_item as $cartchild)
  
       <tr border: 1px solid #ddd!important>
        <td style="height:100px;width:100px; background: url('{{asset('uploads/items/childs/'.$cartchild->child->img_name)}}'); background-size: contain; background-position: center center;border: 1px solid #ddd!important"></td>
        <td style="width:300px;border: 1px solid #ddd!important">{{ $cartchild->child->name_sub }}</td>
        <td style="width:200px;border: 1px solid #ddd!important">{{$cartchild->qty}}</td>
        <td style="width:350px;border: 1px solid #ddd!important">{{$cartchild->child->price}} L.L</td>
        <td style="width:350px;border: 1px solid #ddd!important"><?php echo $cartchild->qty * $cartchild->child->price;  ?> L.L</td>
  
    @endforeach
  @endif
</table>

  
   
                </div>
            </div>
        </div>
    </div>

@endsection
