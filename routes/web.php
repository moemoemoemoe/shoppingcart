<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/////////////////////////// Api Controller //////////////////////

Route::get('api/get_offers', 'ApiController@get_offers')->name('get_offers');
Route::get('api/spec_offer/{id}', 'ApiController@spec_offer')->name('spec_offer');
Route::get('api/single_offer/{id}', 'ApiController@single_offer')->name('single_offer');
Route::get('api/get_all_generics', 'ApiController@get_all_generics')->name('get_all_generics');
Route::get('api/logs', 'ApiController@logs')->name('logs');


Route::get('api/get_cart/{json}/userid/{user}/{em}/{ad}/{phone}/{tab}/{x}/{y}/{date}/{time}/{cmnt}', 'CartController@get_cart')->name('get_cart');
Route::get('api/get_all_cart', 'CartController@get_all_cart')->name('get_all_cart');

////////////////////////////////////////////////route for zone and generics and brandes api

Route::get('api/generics_api/{zone_id}', 'ApiController@generics_api')->name('generics_api');
Route::get('api/items_api/{zone_id}/generic/{generic_id}', 'ApiController@items_api')->name('items_api');



///////////////////////////////////////////////////////////
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

/////////////////////////// offer Controller //////////////////////

Route::get('admin/add_offer', 'OffersController@add_offer')->name('add_offer')->middleware('auth');
Route::post('admin/add_offer', 'OffersController@add_offer_save')->name('add_offer')->middleware('auth');

Route::get('admin/manage_offer', 'OffersController@manage_offer')->name('manage_offer')->middleware('auth');
Route::get('admin/publish_offer/{id}', 'OffersController@publish_offer')->name('publish_offer')->middleware('auth');
Route::get('admin/view_offer/{id}', 'OffersController@view_offer')->name('view_offer')->middleware('auth');
Route::post('admin/view_offer/{id}', 'OffersController@view_offer_update')->name('view_offer')->middleware('auth');

Route::post('admin/delete_offer', 'OffersController@delete_offer')->name('delete_offer')->middleware('auth');
///////////////////////////////////////////view_cart_offer///////////////
Route::get('admin/view_cart_offer', 'OffersController@view_cart_offer')->name('view_cart_offer')->middleware('auth');
Route::get('admin/view_cart_offer_spec/{invm}', 'OffersController@view_cart_offer_spec')->name('view_cart_offer_spec')->middleware('auth');

///////////////////////////////////////////Home Structure////////////////////////////////
Route::get('admin/home/structure/room_index', 'RoomController@room_index')->name('room_index')->middleware('auth');
Route::post('admin/home/structure/room_index', 'RoomController@room_index_upload')->name('room_index')->middleware('auth');


Route::get('admin/home/structure/room_index_view/{id}', 'RoomController@room_index_view')->name('room_index_view')->middleware('auth');
Route::post('admin/home/structure/room_index_view/{id}', 'RoomController@room_index_view_save')->name('room_index_view')->middleware('auth');
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////Zone Controller

Route::get('admin/home/structure/zone_index', 'ZoneController@zone_index')->name('zone_index')->middleware('auth');
Route::post('admin/home/structure/zone_index', 'ZoneController@zone_index_save')->name('zone_index')->middleware('auth');

Route::get('admin/home/structure/zone_index_view/{id}', 'ZoneController@zone_index_view')->name('zone_index_view')->middleware('auth');
Route::post('admin/home/structure/zone_index_view/{id}', 'ZoneController@zone_index_view_save')->name('zone_index_view')->middleware('auth');

//////////////////////////////////////////////Generic Controller


Route::get('admin/home/generic_brand/generic_index', 'GenericBrandesController@generic_index')->name('generic_index')->middleware('auth');
Route::post('admin/home/generic_brand/generic_index', 'GenericBrandesController@generic_index_save')->name('generic_index')->middleware('auth');


Route::get('admin/home/structure/generic_index_view/{id}', 'GenericBrandesController@generic_index_view')->name('generic_index_view')->middleware('auth');
Route::post('admin/home/structure/generic_index_view/{id}', 'GenericBrandesController@generic_index_view_save')->name('generic_index_view')->middleware('auth');



Route::get('admin/home/generic_brand/brande_index', 'GenericBrandesController@brande_index')->name('brande_index')->middleware('auth');
Route::post('admin/home/generic_brand/brande_index', 'GenericBrandesController@brande_index_save')->name('brande_index')->middleware('auth');


Route::get('admin/home/generic_brand/brande_index_view/{id}', 'GenericBrandesController@brande_index_view')->name('brande_index_view')->middleware('auth');
Route::post('admin/home/generic_brand/brande_index_view/{id}', 'GenericBrandesController@brande_index_view_save')->name('brande_index_view')->middleware('auth');

//////////////////////////////////////////////////////////////Item Controlller


Route::get('admin/home/items/item_index', 'ItemController@item_index')->name('item_index')->middleware('auth');
Route::post('admin/home/items/item_index', 'ItemController@item_index_save')->name('item_index')->middleware('auth');

Route::get('admin/home/items/item_manage', 'ItemController@item_manage')->name('item_manage')->middleware('auth');
Route::get('admin/home/items/child_index_view/{id}', 'ItemController@child_index_view')->name('child_index_view')->middleware('auth');
Route::get('admin/home/items/item_index_view/{id}', 'ItemController@item_index_view')->name('item_index_view')->middleware('auth');

Route::get('admin/home/items/child_index_view_update/{id}', 'ItemController@child_index_view_update')->name('child_index_view_update')->middleware('auth');
Route::post('admin/home/items/child_index_view_update/{id}', 'ItemController@child_index_view_update_save')->name('child_index_view_update')->middleware('auth');

Route::get('admin/home/items/item_view_no_child/{id}', 'ItemController@item_view_no_child')->name('item_view_no_child')->middleware('auth');
Route::post('admin/home/items/item_view_no_child/{id}', 'ItemController@item_view_no_child_save')->name('item_view_no_child')->middleware('auth');





////////////////////////////////////////route for get dynamic ids
Route::post('admin/item/show_zone', 'ShowIdController@show_zone')->name('show_zone')->middleware('auth');
Route::post('admin/item/show_generic', 'ShowIdController@show_generic')->name('show_generic')->middleware('auth');
Route::post('admin/item/show_brande', 'ShowIdController@show_brande')->name('show_brande')->middleware('auth');



//////////////////////////////Demo routes

Route::get('admin/demo/demo_index', 'DemoController@demo_index')->name('demo_index')->middleware('auth');
Route::get('admin/demo/demo_get_generic/{zone_id}', 'DemoController@demo_get_generic')->name('demo_get_generic')->middleware('auth');

Route::get('admin/demo/brande_view_by_generic/{generic_id}', 'DemoController@brande_view_by_generic')->name('brande_view_by_generic')->middleware('auth');

Route::get('admin/demo/item_view_domo/{brand_id}', 'DemoController@item_view_domo')->name('item_view_domo')->middleware('auth');
Route::get('admin/demo/child_view_domo/{item_id}', 'DemoController@child_view_domo')->name('child_view_domo')->middleware('auth');




