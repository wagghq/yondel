<?php



\

Route::group(['middleware' => 'guest'], function () {
    Route::get('/auth/register/{invitationCode?}', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
    Route::post('/auth/register', 'Auth\RegisterController@register');
    Route::get('/auth/login', 'Auth\LoginController@showLoginForm')->name('auth.login');
    Route::post('/auth/login', 'Auth\LoginController@login');
    Route::get('/', 'FacadeController@facade')->name('facade');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'hasTeam'], function () {
        Route::get('/home', 'HomeController@home')->name('home');
        Route::resource('book', 'BookController');
        Route::post('/book/{id}/read', 'BookController@read')->name('book.read');
        Route::get('/user/{id}', 'UserController@show')->name('user.show');
        Route::resource('invitation', 'InvitationController', ['except' => ['edit', 'update']]);
        Route::get('team/{id}/switch', 'TeamController@switch')->name('team.switch');
    });
    Route::resource('team', 'TeamController', ['except' => ['index', 'show']]);
    Route::get('/auth/logout', 'Auth\LoginController@logout')->name('auth.logout');
});
