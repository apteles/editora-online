<?php

Route::group(['prefix' => 'admin'], function () {
    Route::resource('users', 'UsersController', ['except' => 'show']);
    Route::get('email-verification/error', '\Users\Http\Controllers\UserConfirmationController@getVerificationError')->name('email-verification.error');
    Route::get('email-verification/check/{token}', '\Users\Http\Controllers\UserConfirmationController@getVerification')->name('email-verification.check');
});
