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

// Auth::routes();
Route::post('/register', 'AuthController@register')->name('register');
Route::post('/login', 'AuthController@login')->name('login');
Route::post('/logout', 'AuthController@logout')->middleware('auth:sanctum');
// group route prefix user
Route::prefix('user')->group(function () {
    Route::get('/channels', 'User\ChannelController@index')->name('user.channels.index');
    Route::get('/channels/{id}/{languagesString}', 'User\ChannelController@show')->name('user.channels.show');
    Route::get('/news/{id}/{languagesString}', 'User\NewsController@show')->name('user.news.show');
    Route::get('/news', 'User\NewsController@index')->name('user.news.all');
    // Route::get('/show/{id}/{languagesString}', 'User\NewsController@show')->name('user.news.show');
});

// group route prefix admin
// Route::prefix('admin')->group(function () {
//     Route::get('/channels', 'Api\Admin\ChannelController@index')->name('admin.channels.index');
//     Route::get('/channels/{id}/{languagesString}', 'Api\Admin\ChannelController@show')->name('admin.channels.show');
//     Route::get('/news/{id}/{languagesString}', 'Api\Admin\NewsController@show')->name('admin.news.show');
// });



// Route::middleware(['token.active'])->group(function () {
// Route::middleware(['token.active', 'role:Admin'])->group(function () {
    // Route::get('/', 'HomeController@index')->name('home');
    Route::get('/show/{id}/{languagesString}', 'HomeController@show')->name('show');
    Route::get('/channels', 'Admin\ChannelController@index')->name('admin.channels.index');
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