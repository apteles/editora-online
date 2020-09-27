<?php
Route::group(['middleware' => ['auth', 'isVerified']], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'can:user-admin'], function () {
        Route::resource('users', 'UsersController', ['except' => 'show']);
        Route::resource('roles', '\Users\Http\Controllers\RolesController', ['except' => 'show']);
        Route::get('roles/{role}/permissions', '\Users\Http\Controllers\RolesController@editPermission')->name('roles.permissions.edit');
        Route::put('roles/{role}/permissions', '\Users\Http\Controllers\RolesController@updatePermission')->name('roles.permissions.update');
    });

    Route::get('email-verification/error', '\Users\Http\Controllers\UserConfirmationController@getVerificationError')->name('email-verification.error');
    Route::get('email-verification/check/{token}', '\Users\Http\Controllers\UserConfirmationController@getVerification')->name('email-verification.check');

    Route::group(['prefix' => 'users'], function () {
        Route::get('settings', '\Users\Http\Controllers\UserSettingsController@edit')->name('user_settings.edit');
        Route::put('settings', '\Users\Http\Controllers\UserSettingsController@update')->name('user_settings.update');
    });
});
