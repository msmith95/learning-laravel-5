<?php
Route::get('/', 'ArticlesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');

/*Route::get('/articles', 'ArticlesController@index');
Route::group(['middleware' => ['web']], function () {
    Route::get('/articles/create', 'ArticlesController@create');
    Route::post('articles', 'ArticlesController@store');
});
Route::get('/articles/{id}', 'ArticlesController@show');*/

Route::group(['middleware' => ['web']], function () {
	Route::resource('articles', 'ArticlesController');
	Route::get('tags/{tags}', 'TagsController@show');
});

//Route::controller('auth', 'Auth\AuthController');
//Route::controller('password', 'Auth\PasswordController');

//Creates basic auth routs
Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
