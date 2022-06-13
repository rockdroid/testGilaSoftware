<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth routes
// Route::post('login', 'API\AuthController@login');
// Route::post('register', 'API\AuthController@register');

// Route for admin permissions
Route::prefix('admin')->group(function() {
	Route::post('login', 'API\AuthController@adminLogin');
	Route::post('register', 'API\AuthController@adminRegister');
});

Route::get('products', 'ProductController@index')->middleware(['auth:api', 'scope:read']);
Route::post('product', 'ProductController@store')->middleware(['auth:api', 'scope:create']);
Route::get('productdel', 'ProductController@destroy')->middleware(['auth:api', 'scope:delete']);

Route::get('types', 'ProductController@types');
Route::get('chars', 'ProductController@chars');
