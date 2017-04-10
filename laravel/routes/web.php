<?php



\

Route::group(['middleware' => 'guest'], function () {
    Route::get('/auth/register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
    Route::post('/auth/register', 'Auth\RegisterController@register');
    Route::get('/auth/login', 'Auth\LoginController@showLoginForm')->name('auth.login');
    Route::post('/auth/login', 'Auth\LoginController@login');
    Route::get('/', 'FacadeController@facade')->name('facade');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/auth/logout', 'Auth\LoginController@logout')->name('auth.logout');
    Route::get('/home', 'HomeController@home')->name('home');
    Route::resource('book', 'BookController');
    Route::post('/book/{id}/read', 'BookController@read')->name('book.read');
    Route::get('/user/{id}', 'UserController@show')->name('user.show');
});
