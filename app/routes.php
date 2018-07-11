<?php
/**
 * Laravel Routing
 *
 * Provides for Versioned API Routing
 *
 * created for rateGenius 3.22.15
 * @author kronus tam@kronusproductions.com
 */
/*
 * This route will display a phpinfo() page
 *
    Route::get('/config', 'ConfigController@index');

 * Simple HOME Route to return some status / name / other info
 */
Route::get('/', function () {
    return 200;
});


/*
 * ROUTING RG API Version 1
 * e.g.  https://hostname/v1
 */
Route::group(['prefix' => 'v1'], function () {

     /*
     * Retrieve Lenders
     * e.g. https://hostname/v1/lenders/retrieves/
     */
    Route::get('lenders/retrieves/', 'LendersController@getLenders');

    /*
     * Update Lenders
     * e.g. https://hostname/v1/lenders/update
     */
    Route::post('lenders/update', 'LendersController@putLenders');

    /*
     * Update image in someTable
     * e.g. https://hostname/v1/lenders/update/image/{param1}/{param2}
     */
    Route::get('lenders/update/image/{param1}/{param2}', 'LendersController@setUploadedImage');

    /*
     * Retrieve late-fees-lenders
     * e.g. https://hostname/v1/lenders/late-fees-lenders/
     */
    Route::get('lenders/late-fees-lenders/', 'LendersController@getLateFeeLenders');

    /*
     * Insert LATE_FEES
     * e.g. https://hostname/v1/lenders/late-fees/create
     */
    Route::post('lenders/late-fees/create', 'LendersController@setLateFees');

    /*
     * Update LATE_FEES
     * e.g. https://hostname/v1/lenders/late-fees/update
     */
    Route::post('lenders/late-fees/update', 'LendersController@putLateFees');

    /*
     * Retrieve return-check-fees-lenders
     * e.g. https://hostname/v1/lenders/return-check-fees-lenders/
     */
    Route::get('lenders/return-check-fees-lenders/', 'LendersController@getReturnCheckFeeLenders');

    /*
     * Update RETURN_CHECK_FEES
     * e.g. https://hostname/v1/lenders/late-fees/update
     */
    Route::post('lenders/return-check-fees/update', 'LendersController@putReturnCheckFees');

    /*
     * Insert RETURN_CHECK_FEES
     * e.g. https://hostname/v1/lenders/return-check-fees/create
     */
    Route::post('lenders/return-check-fees/create', 'LendersController@setReturnCheckFees');

    /*
     * Retrieve someSponsorTable
     * e.g. https://hostname/v1/sponsors/retrieves/
     */
    Route::get('sponsors/retrieves/', 'SponsorsController@getSponsor');

    /*
     * Insert someSponsorTable
     * e.g. https://hostname/v1/sponsors/create
     */
    Route::post('sponsors/create', 'SponsorsController@setSponsor');

    /*
     * Insert someSponsorTable
     * e.g. https://hostname/v1/sponsors/update
     */
    Route::post('sponsors/update', 'SponsorsController@putSponsor');
});
