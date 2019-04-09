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

Route::get('/', 'PagesController@index');
Route::get('/forum', 'PagesController@forum');
Route::get('/search', 'PagesController@search');

Route::resource('jobs', 'JobsController');

Route::resource('applications', 'ApplicationsController');
Route::get('review/{id}', 'ApplicationsController@setReview');
Route::get('shortlist/{id}', 'ApplicationsController@shortlist');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/download/{document}', 'DashboardController@getDownload');
Route::get('/dashboard/{id}', 'DashboardController@showInbox');
Route::get('/inbox_search', 'DashboardController@searchInbox');

Route::get('/manage_employers', 'AdminController@accountRequests')->name('admin.manage.employers');
Route::put('/accept/{id}', 'AdminController@acceptAccount')->name('admin.accept.employer');
Route::delete('/decline/{id}', 'AdminController@destroy')->name('admin.decline.employer');
Route::get('/account_info', 'AdminController@accountInfo')->name('admin.account.info');
Route::put('/change_password', 'AdminController@change_password');

Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('employer')->group(function() {
    Route::get('/register', 'Auth\EmployerRegisterController@showRegistrationForm')->name('employer.register');
    Route::post('/register', 'Auth\EmployerRegisterController@register')->name('employer.register.submit');
    Route::get('/login', 'Auth\EmployerLoginController@showLoginForm')->name('employer.login');
    Route::post('/login', 'Auth\EmployerLoginController@login')->name('employer.login.submit');
    Route::get('/', 'EmployerController@index')->name('employer.dashboard');
    Route::get('/logout', 'Auth\EmployerController@logout')->name('employer.logout');
});

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminController@logout')->name('admin.logout');
});