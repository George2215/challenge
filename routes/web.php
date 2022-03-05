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

Route::get('/', function () {
    return view('welcome');
});


Route::get('invoice', 'InvoiceController@getTotalInvoice')->name('invoice');
Route::get('invoice/hundred', 'InvoiceController@getIdInvoiceProductsHigherHundred')->name('invoice.hundred');

Route::post('product/store', 'ProductController@store')->name('product.store');
Route::get('products', 'ProductController@getFinalPriceProduct')->name('products');

Auth::routes(['register' => false]);

Route::get('register', 'Auth\NewRegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\NewRegisterController@create')->name('register-user');

Route::group(['middleware'=>['auth']],function(){
    Route::get('/home', 'TaskController@index')->name('home');
    Route::resource('task', 'TaskController', ['show']);
});

