<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'prefix'     => 'auth',
    'as'         => 'auth.',
    'namespace'  => 'Auth',
], function () {
    Route::group([
        'middleware' => 'role:administrator' || 'role:officer'
    ], function () {
        /*
         * User Management
         */
        Route::group(['namespace' => 'User'], function () {

            /*
             * User Status'
             */
            Route::get('user/deactivated', 'UserStatusController@getDeactivated')->name('user.deactivated');
            Route::get('user/deleted', 'UserStatusController@getDeleted')->name('user.deleted');

            /*
             * User CRUD
             */
            Route::resource('user', 'UserController');
            Route::get('officer/get/user', 'UserController@officer_user')->name('officer.get.user');
            Route::get('officer/create/user', 'UserController@officer_create_user')->name('officer.create.user');
            Route::Post('officer/store/user', 'UserController@officer_store_user')->name('officer.store.user');

            /*
             * Specific User
             */
            Route::group(['prefix' => 'user/{user}'], function () {
                // Account
                Route::get('account/confirm/resend', 'UserConfirmationController@sendConfirmationEmail')->name('user.account.confirm.resend');

                // Status
                Route::get('mark/{status}', 'UserStatusController@mark')->name('user.mark')->where(['status' => '[0,1]']);

                // Social
                Route::delete('social/{social}/unlink', 'UserSocialController@unlink')->name('user.social.unlink');

                // Confirmation
                Route::get('confirm', 'UserConfirmationController@confirm')->name('user.confirm');
                Route::get('unconfirm', 'UserConfirmationController@unconfirm')->name('user.unconfirm');

                // Password
                Route::get('password/change', 'UserPasswordController@edit')->name('user.change-password');
                Route::patch('password/change', 'UserPasswordController@update')->name('user.change-password.post');

                // Access
                Route::get('login-as', 'UserAccessController@loginAs')->name('user.login-as');

                // Session
                Route::get('clear-session', 'UserSessionController@clearSession')->name('user.clear-session');

                // Deleted
                Route::get('delete', 'UserStatusController@delete')->name('user.delete-permanently');
                Route::get('restore', 'UserStatusController@restore')->name('user.restore');
            });
        });

        /*
         * Role Management
         */
        Route::group(['namespace' => 'Role'], function () {
            Route::resource('role', 'RoleController', ['except' => ['show']]);
        });

        /*
         * Role Management
         */
        Route::group(['namespace' => 'Transaction'], function () {
            Route::resource('transaction', 'TransactionController');
            Route::get('debit', 'TransactionController@debit')->name('transaction.debit');
            Route::get('transaction/get/user/{account}', 'TransactionController@get_user');

            Route::get('importExport', 'TransactionController@importExport');
            Route::get('downloadExcel/{type}', 'TransactionController@downloadExcel');
            Route::get('downloadUserExcel/{type}', 'TransactionController@downloadUserExcel');
            Route::post('importExcel', 'TransactionController@importExcel');
            Route::get('generate-pdf','TransactionController@generatePDF');
        });
    });
});
