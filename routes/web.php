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

Route::get('/', 'product\ProductController@htmlPage');
Route::get('listdata', 'product\ProductController@listData');
Route::put('get', 'product\ProductController@getOne');
Route::post('save', 'product\ProductController@createUpdate');
Route::post('upload', 'product\ProductController@uploadImage');
Route::delete('delete', 'product\ProductController@delete');
