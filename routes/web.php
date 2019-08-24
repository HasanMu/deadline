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


Route::get('/', 'HomeController@index')->name('home');

//
Route::get('/user/logout', 'Auth\LoginController@logoutUser')->name('user.logout');

Route::group(['prefix' => 'admin'], function() {
    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');

    //
	Route::get('/password/reset', 'AuthAdmin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'AuthAdmin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'AuthAdmin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'AuthAdmin\ResetPasswordController@reset');
    //

    Route::group(['middleware' => 'cors'], function () {
        Route::group(['middleware' => 'auth:admin', 'as' => 'admin.'], function(){
            Route::group(['middleware' => ['auth:admin']], function () {
                Route::resource('/users', 'Admin\UserController');
                Route::resource('/categories', 'Admin\CategoryController');
                Route::resource('/tags', 'Admin\TagController');
                Route::group(['prefix' => 'post'], function () {
                Route::resource('/questions', 'Admin\PostQuestionController');
            });
            });
        });
    });
});
//
