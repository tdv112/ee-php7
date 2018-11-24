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

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', 'LoginController@show')->name('frontend_getLogin');
    Route::post('/login', 'LoginController@login')->name('frontend_postLogin');
    Route::get('/logout', 'LoginController@logout')->name('frontend_postLogout');
    Route::get('/register', 'RegisterController@show')->name('frontend_getRegister');
    Route::post('/register/', 'RegisterController@store')->name('frontend_postRegister');

//default frontend Routing
    Route::get('/', 'IndexController@show')->name('frontend_index');

//Login with G+
    Route::get('auth/google', 'LoginController@redirectToGoogle')->name('gg_login');
    Route::get('auth/google/callback', 'LoginController@handleGoogleCallback');
    Route::post('social-register', 'RegisterController@googleRegister')->name('gg_register');
//Login with FB
    Route::get('auth/facebook', 'LoginController@redirectToFacebook')->name('fb_login');
    Route::get('auth/callback/facebook', 'LoginController@handleFacebookCallback');

//group routing hire
    Route::prefix('thue-lao-dong')->group(function () {
        Route::get('/', 'HireController@category')->name('hire');
        Route::group(['middleware' => ['auth']], function () {
            Route::get('dang-tin', 'HireController@create')->name('hire_createposts');
            Route::post('create-posts', 'HireController@store')->name('hire_storeposts');
           
        });
        Route::get('kho-thong-tin', 'HireController@show')->name('hire_listposts');
        Route::get('tin/{slug}', 'HireController@detail')->name('hire_detailposts');
    });
//group routing worker
    Route::prefix('tim-viec')->group(function () {
        Route::get('/', 'WorkerController@category')->name('worker');
        Route::group(['middleware' => ['auth']], function () {
            Route::get('dang-tin', 'WorkerController@create')->name('worker_createposts');
            Route::post('create-posts', 'WorkerController@store')->name('worker_storeposts');
        });
        Route::get('kho-thong-tin', 'WorkerController@show')->name('worker_listposts');
        Route::get('tin/{slug}', 'WorkerController@detail')->name('worker_detailposts');
    });
    /*Upload image */
    Route::group(['middleware' => ['auth']], function () {
        Route::post('upload', 'UploadController@upload')->name('upload');
    });
    Route::get('get_location_post', 'Controller@getlocationpost')->name('get_location_post');
    Route::get('/mypost/{userid}', 'Controller@getmypost')->name('frontend_mypost');
    Route::get('/edit-post/{id}', 'Controller@editmypost')->name('frontend_editmypost');
    Route::get('/location-hire', 'HireController@locationHire')->name('location-hire');
    Route::get('/location-worker', 'WorkerController@locationWorker')->name('location-worker');
    Route::post('store-post/{id}', 'Controller@storemypost')->name('storemypost');
});
