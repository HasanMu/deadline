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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {
    Route::apiResource('/users', 'Api\UserController');
    Route::apiResource('/categories', 'Api\CategoryController');
    Route::apiResource('/tags', 'Api\TagController');
    Route::apiResource('/comments', 'Api\CommentController');
    Route::group(['prefix' => 'post'], function () {
        Route::apiResource('/questions', 'Api\PostQuestionController');
    });
    Route::get('/isLogged', 'Api\UserController@isLogged');
});
