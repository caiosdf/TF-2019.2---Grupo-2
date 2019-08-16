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


// Rotas da PassportController que não precisam de token
Route::get('userPhoto/{id}', 'API\PassportController@downloadPhoto');
Route::post('login', 'API\PassportController@login');
Route::post('cadastro', 'API\PassportController@register');
Route::get('UserPosts','API\PassportController@myPosts');


Route::group(['middleware' => 'auth:api'], function() {

    Route::post('criaPost', 'postController@store');
    Route::post('editarPost/{id}', 'postController@update');

    Route::get('get-details','API\PassportController@getDetails');
    Route::post('editarPerfil', 'API\PassportController@update');
});

Route::get('posts', 'postController@getPosts');
Route::get('postPhoto/{id}', 'postController@downloadPhoto');
Route::get('postUser/{id}', 'postController@postUser');
