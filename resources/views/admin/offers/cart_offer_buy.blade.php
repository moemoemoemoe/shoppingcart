@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">View Invoices</div>

                <div class="panel-body">
                   @foreach($carts as $cart)
                   <a href="{!! route('view_cart_offer_spec', ['invm'=>$cart->inv_id,'id'=>$cart->id]) !!}"><span class="btn btn-primary" style="margin: 10px">{{$cart->inv_id}}</span></a>
                   @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
