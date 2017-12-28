@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">View Invoices</div>

                <div class="panel-body">
                   @foreach($carts as $cart)
                  <div class="col-md-3"> <a href="{!! route('view_cart_offer_spec', ['invm'=>$cart->inv_id]) !!}"><span class="btn btn-primary" style="margin: 10px">{{$cart->inv_id}}</span></a></div>
                  @if($cart->role =='X')
                  <div class="col-md-3"><span style="margin: 10px;font-weight: 900;color: red">Not Assigned</span></div>
                  <div class="col-md-3"><span  style="margin: 10px;font-weight: 900;color: red"> No Set</span></div>
                  <div class="col-md-3"><span  style="margin: 10px;font-weight: 900;color: red">{{$cart->created_at}}</span></div>
                  @else
                  <div class="col-md-3"><span style="margin: 10px;font-weight: 900"> {{$cart->driver->name}}</span></div>
                  <div class="col-md-3"><span  style="margin: 10px;font-weight: 900"> {{$cart->role}}</span></div>
                  <div class="col-md-3"><span  style="margin: 10px;font-weight: 900;color: red">{{$cart->created_at}}</span></div>
@endif

                   @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
