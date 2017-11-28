@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @foreach($carts as $cart)
    <div class="col-md-2">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <b>{{ $cart->offer->title }}</b> <span class="pull-right">

               
                </span>
            </div>
            <div class="panel-body" style="height:150px; background: url('{{asset('uploads/offers/'.$cart->offer->img_name)}}'); background-size: 100%; background-position: center center">
                
            </div>
             <div class="panel-footer text-center">
                <a class="btn btn-primary form-control">Qty : {{$cart->qty}}</a>
            </div>
            <div class="panel-footer text-center">
                <a class="btn btn-primary form-control">price : {{$cart->offer->price}} L.L</a>
            </div>
             <div class="panel-footer text-center">
                <a class="btn btn-danger form-control">Total: <?php echo $cart->qty * $cart->offer->price;  ?> L.L</a>
            </div>
           
        </div>
    </div>

    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
