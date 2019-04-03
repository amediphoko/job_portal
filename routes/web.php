<?php
use App\Notifications\NewApplication;
use App\User;
use App\Job;
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
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'PagesController@index');
Route::get('/forum', 'PagesController@forum');
Route::get('/search', 'PagesController@search');

Route::resource('jobs', 'JobsController');

Route::resource('applications', 'ApplicationsController');
Route::get('review/{id}', 'ApplicationsController@setReview');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/download/{document}', 'DashboardController@getDownload');
Route::get('/dashboard/{id}', 'DashboardController@showInbox');

Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('employer')->group(function() {
    Route::get('/register', 'Auth\EmployerRegisterController@showRegistrationForm')->name('employer.register');
    Route::post('/register', 'Auth\EmployerRegisterController@register')->name('employer.register.submit');
    Route::get('/login', 'Auth\EmployerLoginController@showLoginForm')->name('employer.login');
    Route::post('/login', 'Auth\EmployerLoginController@login')->name('employer.login.submit');
    Route::get('/', 'EmployerController@index')->name('employer.dashboard');
    Route::get('/logout', 'Auth\EmployerController@logout')->name('employer.logout');
});
