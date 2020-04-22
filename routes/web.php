<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'GuestController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('invention', 'InventionController');
Route::resource('domain', 'DomainController');

Route::get('/search/invention', 'InventionController@search')->name('invention.search');
Route::post('/search/invention', 'InventionController@query')->name('invention.query');

Route::get('/list/domain', 'DomainController@list')->name('domain.list');
Route::get('/list/invention', 'InventionController@list')->name('invention.list');

