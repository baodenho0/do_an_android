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
// Route::get('create', function() {
//     \App\User::create([
//     	'name' => 'Le Hiếu',
//     	'email' => 'admin@gmail.com',
//     	'password' => bcrypt('admin'),
//     ]);
// });
// 
Route::group(['namespace' => 'API'], function() {
//===========================

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');


Route::group(['middleware' => 'jwt.auth'], function() {

    
    Route::group(['prefix' => 'user'], function() {
        Route::get('info', 'UserController@getInfo');
        Route::post('update-profile', 'UserController@updateProfile');
        Route::post('update-password', 'UserController@updatePassword');

    });


    Route::get('/website', 'WebsiteController@getWebsite');
    Route::get('/category', 'CategoryController@getCategoryByWebsiteId');
    

    Route::group(['prefix' => 'news'], function() {
        Route::get('/', 'NewsController@getNewsByWebsiteIdAndCategoryId');
        Route::get('/detail', 'NewsController@getById');
    });

    Route::group(['prefix' => 'activity'], function() {
        Route::get('/', 'ActivityController@getByUserId');
    });

    Route::group(['prefix' => 'rating'], function() {
        Route::get('/get-by-news-id', 'RatingController@getRatingByNewsId');
        Route::post('/update', 'RatingController@updateRating')->name("updateRating");
    });

    Route::group(['prefix' => 'commnet'], function() {
        Route::get('/get-by-news-id', 'CommentController@getCommentByNewsId')->name("getCommentByNewsId");
        Route::post('/save', 'CommentController@saveComment')->name("saveComment");
    });



    


});
    Route::get("/ket-qua-xo-so","XoSoController@index");
    Route::get("/ket-qua-bong-da","BongDaController@index");

//===========================
});
