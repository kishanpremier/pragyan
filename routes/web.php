<?php

/**
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', 'LanguageController@swap');

/* ----------------------------------------------------------------------- */

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/Frontend/');
});

/* ----------------------------------------------------------------------- */

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    includeRouteFiles(__DIR__.'/Backend/');
    
    Route::get('classlist','Subject\SubjectController@index')->name('class.list');
    Route::get('create','Subject\SubjectController@create')->name('class.create');
    Route::post('store','Subject\SubjectController@store')->name('class.store');
    Route::get('edit/{id}','Subject\SubjectController@edit')->name('class.edit');
    Route::get('delete/{id}','Subject\SubjectController@delete')->name('class.delete');


    Route::get('schoolList','School\SchoolController@index')->name('school.list');
    Route::get('schoolcreate','School\SchoolController@create')->name('school.create');
    Route::post('schoolstore','School\SchoolController@store')->name('school.store');
    Route::get('schooledit/{id}','School\SchoolController@edit')->name('school.edit');
    Route::get('schooldelete/{id}','School\SchoolController@delete')->name('school.delete');


    Route::get('boardList','Board\BoardController@index')->name('board.list');
    Route::get('schoolboardcreate','Board\BoardController@create')->name('schoolboard.create');
    Route::post('schoolboardstore','Board\BoardController@store')->name('schoolboard.store');
    Route::get('schoolboardedit/{id}','Board\BoardController@edit')->name('schoolboard.edit');
    Route::get('schoolboarddelete/{id}','Board\BoardController@delete')->name('schoolboard.delete');

    Route::get('subjectschoolList','Subject1\Subject1Controller@index')->name('subjectschool.list');
    Route::get('schoolsubjectcreate','Subject1\Subject1Controller@create')->name('subjectschool.create');
    Route::post('schoolsubjectstore','Subject1\Subject1Controller@store')->name('subjectschool.store');
    //Route::get('schoolboardedit/{id}','Board\BoardController@edit')->name('subjectschool.edit');
    //Route::get('schoolboarddelete/{id}','Board\BoardController@delete')->name('schoolboard.delete');
});
