<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::resource('products', 'ProductController');
    Route::group(['middleware' => 'censor'], function () {
        Route::post('/product/{id}/review', 'ProductController@review');
    });
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('products/{id}/owner', 'ProductController@checkProductOwner');
});
