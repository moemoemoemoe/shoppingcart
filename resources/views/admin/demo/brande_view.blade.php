@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Brande View</div>

                <div class="panel-body">
                                                                                             
@foreach($brandes as $brand)
    <div class="col-md-2">
       
            
        <a href="{!! route('item_view_domo', ['id'=>$brand->id]) !!}">    <div class="panel-body">{{$brand->brande_name}}</a>
                
            
          
        </div>
    </div>

    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
