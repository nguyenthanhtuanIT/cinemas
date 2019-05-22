<?php

Route::group(['prefix' => 'v1'], function () {
	//Route::post('auth/login', 'Auth\AuthController@login');
	Route::post('auth/google', 'Auth\AuthGoogleController@login');
	//Route::post('auth/facebook', 'Auth\AuthFacebookController@login');
	Route::post('password/forgot/request', 'Auth\ForgotPasswordController@getResetToken');
	Route::post('password/forgot/reset', 'Auth\ResetPasswordController@reset');
	Route::post('register', 'UsersController@register');
	//user information
	Route::get('me', 'UsersController@me');
	//auth
	Route::post('auth/logout', 'Auth\AuthController@logout');
	//password
	Route::post('password/change', 'UsersController@changePass');
	//films
	Route::get('list_films', 'FilmsController@listFilm');
	Route::get('max_vote', 'FilmsController@maxRegister');
	Route::post('search_films', 'FilmsController@getFilmsByDate');
	Route::get('choose_chair/{vote_id}', 'ChooseChairsController@choose');
	Route::resource('choose_chairs', 'ChooseChairsController');
});

Route::group(['prefix' => 'v1'], function () {
	//users
	Route::resource('users', 'UsersController');
	//votes
	Route::resource('votes', 'VotesController');
	Route::get('search', 'VotesController@searchByTitle');
	//film
	Route::resource('films', 'FilmsController');
	//cinema
	Route::resource('cinemas', 'CinemasController');
	//votedetail
	Route::resource('votedetails', 'VoteDetailsController');
	// images
	Route::resource('images', 'ImagesController')->only(['store', 'destroy']);
	//register
	Route::resource('registers', 'RegistersController');
	//excel
	Route::get('excel', 'RegistersController@Export');
	//blog
	Route::resource('blogs', 'BlogsController');
	//cinema
	Route::resource('cinemas', 'CinemasController');
	//type-cinemas
	Route::resource('typecinemas', 'TypeCinemasController');
	//chair
	Route::resource('chairs', 'ChairsController');

});
