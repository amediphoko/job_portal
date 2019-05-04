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


Route::resource('jobs', 'JobsController');
Route::get('/search', 'JobsController@search');

Route::resource('posts', 'PostsController');

Route::resource('comments', 'CommentsController');

Route::resource('applications', 'ApplicationsController');
Route::get('review/{id}', 'ApplicationsController@setReview');
Route::get('shortlist/{id}', 'ApplicationsController@shortlist');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard/applications/{id}', 'DashboardController@applications');
Route::get('/dashboard/messages/{id}', 'DashboardController@messages');
Route::get('/dashboard/profile', 'DashboardController@profile');
Route::get('/dashboard/coverinfo/{id}', 'DashboardController@coverInfo');
Route::get('/download/{document}', 'DashboardController@getDownload');
Route::get('/dashboard/{id}', 'DashboardController@showInbox');
Route::get('/inbox_search', 'DashboardController@searchInbox');
Route::put('/user_update/{id}', 'DashboardController@update')->name('user.update');
Route::put('/img_update/{id}', 'DashboardController@img_update')->name('user.pro_pic.update');
Route::put('/update_documents/{id}', 'DashboardController@update_documents');
Route::post('/delete_msg', 'DashboardController@delete_msg');

Route::put('/employer_update/{id}', 'EmployerController@update')->name('employer.update');
Route::put('/logo_update/{id}', 'EmployerController@logo_update')->name('employer.logo.update');

Route::get('/manage_employers', 'AdminController@accountRequests')->name('admin.manage.employers');
Route::put('/accept/{id}', 'AdminController@acceptAccount')->name('admin.accept.employer');
Route::get('/manage_posts', 'AdminController@postRequests')->name('admin.manage.post');
Route::put('/accept/post/{id}', 'AdminController@acceptPost')->name('admin.accept.post');
Route::delete('/decline/{id}', 'AdminController@destroy')->name('admin.decline.employer');
Route::delete('/delete/{id}', 'AdminController@delete_post')->name('admin.decline.post');
Route::get('/account_info', 'AdminController@accountInfo')->name('admin.account.info');
Route::put('/change_password', 'AdminController@change_password');

Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('employer')->group(function() {
    Route::get('/register', 'Auth\EmployerRegisterController@showRegistrationForm')->name('employer.register');
    Route::post('/register', 'Auth\EmployerRegisterController@register')->name('employer.register.submit');
    Route::get('/login', 'Auth\EmployerLoginController@showLoginForm')->name('employer.login');
    Route::post('/login', 'Auth\EmployerLoginController@login')->name('employer.login.submit');
    Route::get('/', 'EmployerController@index')->name('employer.dashboard');
    Route::get('/jobs_posted/{id}', 'EmployerController@jobsPosted');
    Route::get('/applications/{id}', 'EmployerController@applications');
    Route::get('/applications/pending/{id}', 'EmployerController@pending');
    Route::get('/applications/reviewed/{id}', 'EmployerController@reviewed');
    Route::get('/applications/shortlisted/{id}', 'EmployerController@shortlisted');
    Route::get('/profile', 'EmployerController@profile');
    Route::post('/send', 'EmployerController@sendmail');
    Route::get('/logout', 'Auth\EmployerController@logout')->name('employer.logout');

    //Password reset routes
    Route::post('/password/email', 'Auth\EmployerForgotPasswordController@sendResetLinkEmail')->name('employer.password.email');
    Route::get('/password/reset', 'Auth\EmployerForgotPasswordController@showLinkRequestForm')->name('employer.password.request');
    Route::post('/password/reset', 'Auth\EmployerResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\EmployerResetPasswordController@showResetForm')->name('employer.password.reset');

});

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminController@logout')->name('admin.logout');

    //Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});