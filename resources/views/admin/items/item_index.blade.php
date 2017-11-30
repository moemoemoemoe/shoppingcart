@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Upload Item</div>
  <div class="panel-body">
                 <form method="POST" enctype="multipart/form-data" class="well">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <p>
                        <input type="text" name="item_name" placeholder="Item Name *" class="form-control" value="{{old('item_name')}}">
                    </p>
<p>
	
<textarea cols="80" id="content_item" name="content_item" rows="10" >
	</textarea>

</p>
     
                     <p>
                    <input type="submit" value="Save" class="btn btn-primary form-control">
                </p>
<p>
        <b>Choose Room</b>
    </p>
    <p>
        <select class="form-control" name="room_id" onchange="show_zone(this);" >
        <option value="-1" >--Select Room--</option>

            @foreach($rooms as $room)
            <option value="{{$room->id}}">{{$room->room_name}}</option>
            @endforeach
        </select>
    </p>
   <p>
        <b>Choose Zone<p> <span id="loading" style="color: red;font-weight: 900;display: none;">LOADING...</span></p></b>
    </p>
    <p>
        <select class="form-control" name="zone_id" id="zone_id" onchange="show_generic(this);" >
         <option value="-1" >--Select Zone--</option>
        </select>
    </p>
   <p>
        <b>Choose Generic<p> <span id="loading" style="color: red;font-weight: 900;display: none;">LOADING...</span></p></b>
    </p>
    <p>
        <select class="form-control" name="generic_id" id="generic_id" onchange="show_brande(this);">
         
        </select>
    </p>
     </p>
   <p>
        <b>Choose Brand<p> <span id="loading" style="color: red;font-weight: 900;display: none;">LOADING...</span></p></b>
    </p>
    <p>
        <select class="form-control" name="brande_id" id="brande_id">
         
        </select>
    </p>

            </form>

               
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">

function show_zone(id){
    var id_room = id.value;
    $('#generic_id').html('');
//window.alert(id_room);
    $.ajax({
      url: '{{ route('show_zone') }}',
      type: 'POST',
      data:{
        _token: '{{ csrf_token() }}',
        id_room:id_room
      },
      cache: false,
      datatype: 'JSON',
      success: function(response){
        $('#loading').show();
        $('#zone_id').html('');
    var i;
    var count = Object.keys(response).length;
    if(count == 0)
    {
        var option=$('<option></option>');
        option.attr('value',-1);
    option.text('--No Sub Category--');
    $('#zone_id').append(option);
    }
    var JSONObject = JSON.parse(JSON.stringify(response));
    for(i=0;i<count;i++)
    {
     var option=$('<option></option>');
    option.attr('value',JSONObject[i]["id"]);
    option.text(JSONObject[i]["zone_name"]);
    $('#zone_id').append(option);
    }
   $('#loading').hide();

     },error:function(){
alert('Somthing Went Wrong');
$('#loading').hide();

     }
   });

  }
function show_generic(id){
    var id_zone = id.value;
//window.alert(id_room);
    $.ajax({
      url: '{{ route('show_generic') }}',
      type: 'POST',
      data:{
        _token: '{{ csrf_token() }}',
        id_zone:id_zone
      },
      cache: false,
      datatype: 'JSON',
      success: function(response){
        $('#loading').show();
        $('#generic_id').html('');
    var i;
    var count = Object.keys(response).length;
    if(count == 0)
    {
        var option=$('<option></option>');
        option.attr('value',-1);
    option.text('--No Sub Category--');
    $('#generic_id').append(option);
    }
    var JSONObject = JSON.parse(JSON.stringify(response));
    for(i=0;i<count;i++)
    {
     var option=$('<option></option>');
    option.attr('value',JSONObject[i]["id"]);
    option.text(JSONObject[i]["generic_name"]);
    $('#generic_id').append(option);
    }
   $('#loading').hide();

     },error:function(){
alert('Somthing Went Wrong');
$('#loading').hide();

     }
   });

  }
  function show_brande(id){
    var id_generic = id.value;
//window.alert(id_room);
    $.ajax({
      url: '{{ route('show_brande') }}',
      type: 'POST',
      data:{
        _token: '{{ csrf_token() }}',
        id_generic:id_generic
      },
      cache: false,
      datatype: 'JSON',
      success: function(response){
        $('#loading').show();
        $('#brande_id').html('');
    var i;
    var count = Object.keys(response).length;
    if(count == 0)
    {
        var option=$('<option></option>');
        option.attr('value',-1);
    option.text('--No Sub Category--');
    $('#brande_id').append(option);
    }
    var JSONObject = JSON.parse(JSON.stringify(response));
    for(i=0;i<count;i++)
    {
     var option=$('<option></option>');
    option.attr('value',JSONObject[i]["id"]);
    option.text(JSONObject[i]["brande_name"]);
    $('#brande_id').append(option);
    }
   $('#loading').hide();

     },error:function(){
alert('Somthing Went Wrong');
$('#loading').hide();

     }
   });

  }
</script>
@endsection
