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

Auth::routes();

Route::redirect('/', '/enquiries');

Route::middleware(['auth'])->group(function () {
    Route::get('/enquiries', 'EnquiriesController@index');
    Route::get('/enquiries/analytics', 'EnquiriesAnalyticsController@index');
});

