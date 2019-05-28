<?php

use Illuminate\Http\Request;

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

Route::post('/login', 'API\UserController@login')->name('user.login');

Route::group(['prefix' => 'books'], function(){
	Route::group(['middleware' => 'APIToken'], function(){
		Route::get('/', 'Api\BookController@index')->name('books.index');
		Route::get('/{id}', 'Api\BookController@show')->name('books.show');
		Route::post('/add', 'Api\BookController@store')->name('books.store');
		Route::put('/{id}/edit', 'Api\BookController@update')->name('books.update');
		Route::get('/{id}/delete', 'Api\BookController@destroy')->name('books.delete');
	});
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
