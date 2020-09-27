<?php

//Route::get('/foo', 'CodeEduBookController@index');
Route::group(['middleware' => ['auth', 'isVerified', 'auth.resource']], function () {
    Route::resource('categories', 'CategoriesController', ['except' => 'show']);
    Route::resource('books', 'BooksController', ['except' => 'show']);

    Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
        Route::resource('books', 'BooksTrashedController', ['except' => ['destroy', 'create', 'edit']]);
    });
});
