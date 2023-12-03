<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Auth::routes();
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware(['token.active', 'role:Admin'])->group(function () {

    // Route::get('/', 'HomeController@index')->name('home');
    Route::get('/show/{id}/{languagesString}', 'HomeController@show')->name('show');

    // channel resources splited
    // Route::get('/admin/channels', 'Admin\ChannelController@index')->name('admin.channels.index');
    // Route::get('/admin/channels/create', 'Admin\ChannelController@create')->name('admin.channels.create');
    // Route::post('/admin/channels', 'Admin\ChannelController@store')->name('admin.channels.store');
    // Route::get('/admin/channels/{channel}/edit', 'Admin\ChannelController@edit')->name('admin.channels.edit');
    // Route::put('/admin/channels/{channel}', 'Admin\ChannelController@update')->name('admin.channels.update');
    // Route::delete('/admin/channels/{channel}', 'Admin\ChannelController@destroy')->name('admin.channels.destroy');

    // cuntry resources splited
    // Route::get('/admin/countries', 'Admin\CountryController@index')->name('admin.countries.index');
    // Route::get('/admin/countries/create', 'Admin\CountryController@create')->name('admin.countries.create');
    // Route::post('/admin/countries', 'Admin\CountryController@store')->name('admin.countries.store');
    // Route::get('/admin/countries/{country}/edit', 'Admin\CountryController@edit')->name('admin.countries.edit');
    // Route::put('/admin/countries/{country}', 'Admin\CountryController@update')->name('admin.countries.update');
    // Route::delete('/admin/countries/{country}', 'Admin\CountryController@destroy')->name('admin.countries.destroy');
// });