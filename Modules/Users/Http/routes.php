<?php

Route::group(['prefix' => 'admin'], function () {
    Route::resource('users', 'UsersController', ['except' => 'show']);
});
