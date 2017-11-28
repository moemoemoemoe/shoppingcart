@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">View Invoices</div>

                <div class="panel-body">
                   @foreach($carts as $cart)
                   <span class="btn btn-primary">{{$cart->invnum}}</span>
                   @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
