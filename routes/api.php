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
Route::middleware(['secret.key'])->group(function () {

// for public
Route::get('/countries', 'CountryController@index')->name('countries.index');
Route::get('/languages', 'LanguageController@index')->name('languages.index');
    
Route::prefix('user')->middleware(['token.active'])->group(function () {
    Route::get('/channels', 'User\ChannelController@index')->name('user.channels.index');
    Route::get('/channels/{id}/{languagesString}', 'User\ChannelController@show')->name('user.channels.show');
    
    Route::post('/channellink/{user}', 'User\ChannelLinkController@index')->name('user.channellink.index');

    Route::post('/news/{user}', 'User\NewsController@getUserFeedByChannelLink')->name('user.news.getByChannelLinks');
    // Route::get('/news/{id}/{languagesString}', 'User\NewsController@show')->name('user.news.show');
    Route::get('/news', 'User\NewsController@index')->name('user.news.all');
    // Route::get('/show/{id}/{languagesString}', 'User\NewsController@show')->name('user.news.show');
    // usersettings
    Route::get('/usersettings', 'User\UserSettingController@index')->name('user.usersettings.index');
    Route::get('/usersettings/{user}', 'User\UserSettingController@edit')->name('user.usersettings.edit');
    Route::post('/usersettings', 'User\UserSettingController@store')->name('user.usersettings.store');
    Route::post('/usersettings/{user}', 'User\UserSettingController@update')->name('user.usersettings.update');
    Route::delete('/usersettings/{user}', 'User\UserSettingController@destroy')->name('user.usersettings.destroy');

});

// group route prefix admin
Route::prefix('admin')->middleware(['role.admin'])->group(function () {
    Route::get('/channels', 'Admin\ChannelController@index')->name('admin.channels.index');
    Route::get('/channels/{channel}/{languagesString}', 'Admin\ChannelController@edit')->name('admin.channels.edit');
    Route::post('/channels', 'Admin\ChannelController@store')->name('admin.channels.store');
    Route::post('/channels/{channel}', 'Admin\ChannelController@update')->name('admin.channels.update');
    Route::delete('/channels/{channel}', 'Admin\ChannelController@destroy')->name('admin.channels.destroy');
    // channelgroup
    Route::get('/channelgroups', 'Admin\ChannelGroupController@index')->name('admin.channelgroups.index');
    Route::get('/channelgroups/{channelgroup}', 'Admin\ChannelGroupController@edit')->name('admin.channelgroups.edit');
    Route::post('/channelgroups', 'Admin\ChannelGroupController@store')->name('admin.channelgroups.store');
    Route::post('/channelgroups/{channelgroup}', 'Admin\ChannelGroupController@update')->name('admin.channelgroups.update');
    Route::delete('/channelgroups/{channelgroup}', 'Admin\ChannelGroupController@destroy')->name('admin.channelgroups.destroy');
    
    Route::get('/channellink', 'Admin\ChannelLinkController@index')->name('admin.channellink.index');
    Route::get('/channellink/{channellink}', 'Admin\ChannelLinkController@edit')->name('admin.channellink.edit');
    Route::post('/channellink', 'Admin\ChannelLinkController@store')->name('admin.channellink.store');
    Route::post('/channellink/{channellink}', 'Admin\ChannelLinkController@update')->name('admin.channellink.update');
    Route::delete('/channellink/{channellink}', 'Admin\ChannelLinkController@destroy')->name('admin.channellink.destroy');

    Route::get('/show/{id}/{languagesString}', 'HomeController@show')->name('show');

    Route::get('/batch', 'Admin\BatchController@index')->name('admin.batch.index');
});
});