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


Route::group(['middleware' => 'auth:api'], function() {

    

    // Rotas da PassportController que precisam de token
    Route::get('get-details','API\PassportController@getDetails');
    Route::get('logout', 'API\PassportController@logout');
    Route::post('editarPerfil', 'API\PassportController@update');

    // Rotas da CommentController que precisam de token
    Route::post('fazComentario/{id}', 'CommentController@store');
    Route::post('editaComentario/{id}', 'CommentController@update');
    Route::delete('apagaComentario/{id}', 'CommentController@delete');

    
    // Rotas da postController que precisam de um usuário logado e que seja blogger.
    Route::post('criaPost', 'postController@store')->middleware('IsBlogger');
    Route::post('editarPost/{id}', 'postController@update')->middleware('IsBlogger');

    
    
});

// Rotas da PassportController que não precisam de token
Route::get('userPhoto/{id}', 'API\PassportController@downloadPhoto');
Route::get('UserPosts','API\PassportController@myPosts');
Route::post('login', 'API\PassportController@login');
Route::post('cadastro', 'API\PassportController@register');

// Rotas da posttController que não precisam de token
Route::get('posts', 'postController@getPosts');
Route::get('postPhoto/{id}', 'postController@downloadPhoto');
Route::get('postUser/{id}', 'postController@postUser');
Route::get('post/{id}', 'postController@getPost');





