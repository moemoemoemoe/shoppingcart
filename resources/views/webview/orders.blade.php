<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<link rel='stylesheet' id='compiled.css-css'  href="{{asset('a/compiled.min.css?ver=4.4.0')}}" type='text/css' media='all' />
</head>
<body>


    <!--Row with two equal columns-->
    
<div class="container">                      
<!--Card Wider-->
<div class="row">
<div class="card card-cascade wider">








<!--Card Regular-->
@foreach($orders as $order)
<div class="card card-cascade">

    <!--Card image-->
  <!--   <div class="view overlay hm-white-slight">
        <img src="https://mdbootstrap.com/img/Photos/Others/men.jpg" class="img-fluid" alt="">
        <a>
            <div class="mask"></div>
        </a>
    </div> -->
    <!--/.Card image-->

    <!--Card content-->
    <div class="card-body text-center">
        <!--Title-->
        <h4 class="card-title"><strong># {{$order->inv_id}}</strong></h4>
        <h5>{{$order->role}}</h5>

        <p class="card-text">To: <span style="font-weight: 900;color: red">{{$order->customer->name}}</span> , adress : <span style="font-weight: 900;color: red">{{$order->customer->address}}</span> , mobile number : <span style="font-weight: 900;color: red">{{$order->customer->phone}}</span>
        </p>
@if($order->status == 1)

        <a href="{!! route('confirm_order', ['id'=>$order->id]) !!}" type="button" class="btn-floating btn-small btn-fb"><i class="fa fa-check"></i></a>
    
    @else
            <a  type="button" class="btn-floating btn-small btn-danger" style="background-color: red"><i class="fa fa-check"></i></a>

      @endif
    
        <a type="button" class="btn-floating btn-small btn-tw"><i class="fa fa-ban"></i></a>
        <a type="button" class="btn-floating btn-small btn-dribbble"><i class="fa fa-map"></i></a>

        <a type="button" class="btn-floating btn-small btn-primary" style="background-color: green"><i class="fa fa-eye"></i></a>


    </div>


</div>
<hr/>
@endforeach

                        
                       
</div>
</div>
</div>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js" integrity="sha384-3ziFidFTgxJXHMDttyPJKDuTlmxJlwbSkojudK/CkRqKDOmeSbN6KLrGdrBQnT2n" crossorigin="anonymous"></script>
</body>