@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">View Invoices</div>

                <div class="panel-body">
                   @foreach($carts as $cart)
                   <a href="{!! route('view_cart_offer_spec', ['invm'=>$cart->original_invoice]) !!}"><span class="btn btn-primary" style="margin: 10px">{{$cart->original_invoice}}</span></a>
                   @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
