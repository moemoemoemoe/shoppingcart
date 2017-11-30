<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                       <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                             <img src="{{asset('images/offers_icons.png')}}" width="25px">
                            Offers<span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                        <li>
                          <a href="{{ route('add_offer')}}"> Upload Offer </a>
                        </li>
                     <li>
                          <a href="{{ route('manage_offer')}}"> Manage Offer </a>
                        </li>
   <li>
                          <a href="{{ route('view_cart_offer')}}"> Invoices cart </a>
                        </li>

                        
                          
                    </ul>
                </li>

                 <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          <img src="{{asset('images/home_icons.png')}}" width="25px">   Home Structure<span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                        <li>
                          <a href="{{route('room_index')}}"><img src="{{asset('images/rooms_icons.png')}}" width="20px"> Manage Rooms </a>
                        </li>
                     <li>
                          <a href="{{route('zone_index')}}"> <img src="{{asset('images/zones_icons.png')}}" width="20px"> Manage Zones </a>
                        </li>
   

                        
                          
                    </ul>
                </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          <img src="{{asset('images/brandes_icons.png')}}" width="25px">   Generic & Brandes<span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                        <li>
                          <a href="{{route('generic_index')}}"><img src="{{asset('images/edit_icons.png')}}" width="20px"> Manage Generics </a>
                        </li>
                     <li>
                          <a href="{{route('zone_index')}}"> <img src="{{asset('images/edit_icons.png')}}" width="20px"> Manage Brandes </a>
                        </li>
   

                        
                          
                    </ul>
                </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row" style="padding-right:22%;padding-left: 22%">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger" >
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(Session::has('success'))
                        <p class="alert alert-success">{{Session('success')}}</p>
                    @endif
                   
                </div>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        var id_offer;
        function show_delete_modal(id)
        {
           id_offer = id;
 $('#modal-confirm-operator-message').modal('show');
        }

        function delete_offer()
        {

$.ajax({
            url: '{{ route('delete_offer') }}',
            type: 'POST',
            data:{
                _token: '{{ csrf_token() }}',
                id_offer: id_offer
            },
            cache: false,
            datatype: 'JSON',
            success: function(data){
               
                if(data.status == 1){
                    $('#response').html('this Offer is successfully Deleted');
                   
setTimeout(function(){

                $('#modal-confirm-operator-message').modal('hide');
                window.location.replace('http://localhost/shoppingcart/public/admin/manage_offer');
            }, 2000);

                }else
                {
                   $('#response').html('Please Try Again');
                }
               },
               error: function(){

               }
           });

        }
    </script>
</body>
</html>
