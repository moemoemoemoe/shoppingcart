@extends('layouts.app')

@section('content')
<div class="container" style="font-weight: 900">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center" style="color: red;font-weight: 900">Username : {{$carts[0]->iduser}}</div>

               
                    @foreach($carts as $cart)
  
       
<div class="col-md-2 form-control"  style="height:50px;width:50px; background: url('{{asset('uploads/offers/'.$cart->offer->img_name)}}'); background-size: 100%; background-position: center center;">

    </div>  
    <div class="col-md-3"  >
{{ $cart->offer->title }}
    </div> 
    <div class="col-md-2" >
{{$cart->qty}}
    </div> 
    <div class="col-md-2">
{{$cart->offer->price}} L.L
    </div> 
    <div class="col-md-2">
<?php echo $cart->qty * $cart->offer->price;  ?> L.L
    </div>         
 </div>
</div> </div><hr/>
    @endforeach

    
           
       
   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
