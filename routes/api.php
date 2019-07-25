<?php

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

Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1', 'as' => 'v1.'], function () {
    Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function () {
        Route::post('register', 'RegisterController@register');
        Route::post('login', 'AuthController@login');
        
        Route::post('user/changepassword/{id}', 'RegisterController@updateAuthUserPassword');
        // Password Reset
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
        Route::get('user/edit/{id}', 'RegisterController@edit');
        Route::post('user/update/{id}', 'RegisterController@update');
        Route::get('stateborad', 'RegisterController@stateBoard');
        Route::get('school', 'RegisterController@school');
        Route::get('schoolclass/{id}', 'RegisterController@schoolClass');
        Route::get('schoolclass', 'RegisterController@getschoolClass');
        Route::get('subject', 'RegisterController@subject');
        Route::get('getchapter/{id}', 'ChapterController@getchapter');
        Route::post('chaptercontent', 'ChapterController@chapterContent');
        Route::get('getchapterContent/{id}', 'ChapterController@getchapterContent');

        Route::post('videoCount', 'RegisterController@videoCount');


        /* banner route */
        Route::get('banner', 'RegisterController@getbanner');

        /* send OTP */

        Route::post('sendOtp', [
            'middleware' => 'checkSession',
            'uses' => 'RegisterController@sendOtp'
        ]);

        Route::post('verifyOtp', [
            'middleware' => 'checkSession',
            'uses' => 'RegisterController@verifyOtp'
        ]);
    });

    Route::group(['middleware' => ['auth:api']], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('logout', 'AuthController@logout');
            Route::post('password/reset', 'ResetPasswordController@reset')->name('password.reset');
        });
        // Users
        Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);
        Route::post('users/delete-all', 'UsersController@deleteAll');
        //@todo need to change the route name and related changes
        Route::get('deactivated-users', 'DeactivatedUsersController@index');
        Route::get('deleted-users', 'DeletedUsersController@index');

        // Roles
        Route::resource('roles', 'RolesController', ['except' => ['create', 'edit']]);

        // Permission
        Route::resource('permissions', 'PermissionController', ['except' => ['create', 'edit']]);

        // Page
        Route::resource('pages', 'PagesController', ['except' => ['create', 'edit']]);

        // Faqs
        Route::resource('faqs', 'FaqsController', ['except' => ['create', 'edit']]);

        // Blog Categories
        Route::resource('blog_categories', 'BlogCategoriesController', ['except' => ['create', 'edit']]);

        // Blog Tags
        Route::resource('blog_tags', 'BlogTagsController', ['except' => ['create', 'edit']]);

        // Blogs
        Route::resource('blogs', 'BlogsController', ['except' => ['create', 'edit']]);

        // Chapter
    });
});
