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
///////////////////////////////////////////