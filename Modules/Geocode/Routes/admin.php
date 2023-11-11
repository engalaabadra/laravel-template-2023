<?php

use Modules\Geocode\Http\Controllers\API\Admin\Country\CountryResourceController;
use Modules\Geocode\Http\Controllers\API\Admin\Country\CountryController;
use Modules\Geocode\Http\Controllers\API\Admin\Country\CountryServiceResourceController;
use Modules\Geocode\Http\Controllers\API\Admin\City\CityResourceController;
use Modules\Geocode\Http\Controllers\API\Admin\City\CityController;
use Modules\Geocode\Http\Controllers\API\Admin\State\StateResourceController;
use Modules\Geocode\Http\Controllers\API\Admin\State\StateController;
use Modules\Geocode\Http\Controllers\API\Admin\Area\AreaResourceController;
use Modules\Geocode\Http\Controllers\API\Admin\Area\AreaController;
use Modules\Geocode\Http\Controllers\API\Admin\Address\AddressResourceController;
use Modules\Geocode\Http\Controllers\API\Admin\Address\AddressTypeResourceController;
use Modules\Geocode\Http\Controllers\API\Admin\Address\AddressTypeController;
    
/**************************Routes countries***************************** */

Route::resource('countries', CountryResourceController::class);
//another routes for module countries
Route::prefix('countries')->as('countries')->group(function(){
        //routes  additional for module cities
        Route::as('additional')->group(function(){
            Route::get('get-cities-country/{countryId}',[CountryController::class,'getCitiesCountry']);    
        });
});

/**************************Routes cities***************************** */
Route::resource('cities', CityResourceController::class);
//another routes for module cities
    Route::prefix('cities')->as('cities')->group(function(){
        //routes  additional for module cities
        Route::as('additional')->group(function(){
            Route::get('get-states-city/{cityId}',[CityController::class,'getStatesCity']);    
        });

        //routes  services for module cities
        Route::prefix('services')->as('services')->group(function(){

        });
    });

/**************************Routes states***************************** */
Route::resource('states', StateResourceController::class);
//another routes for module states
Route::prefix('states')->as('states')->group(function(){
    Route::as('additional')->group(function(){
        Route::get('get-areas-state/{stateId}', [StateController::class,'getAreasState'])->name('.areas-state');
    });
    //routes  services for module states
    Route::prefix('services')->as('services')->group(function(){

    });
});
/**************************Routes areas***************************** */
Route::resource('areas', AreaResourceController::class);
//another routes for module areas
Route::prefix('areas')->as('areas')->group(function(){
    Route::as('additional')->group(function(){
        Route::get('get-addresses-types-area/{areaId}', [AreaController::class,'getAddressesTypesArea'])->name('.addresses-types-area');
    });
    //routes  services for module areas
    Route::prefix('services')->as('services')->group(function(){

    });
});
    

/**************************Routes addresses types***************************** */
Route::resource('addresses-types', AddressTypeResourceController::class);
//another routes for module addresses-types
Route::prefix('addresses-types')->as('addresses-types')->group(function(){
    Route::as('additional')->group(function(){
        Route::get('get-addresses-type/{typeId}', [AddressTypeController::class,'getAddressesType'])->name('.addresses-type');
    });
    //routes  services for module addresses-types
    Route::prefix('services')->as('services')->group(function(){

    });
});

/**************************Routes addresses***************************** */
Route::resource('addresses', AddressResourceController::class);
//another routes for module addresses
Route::prefix('addresses')->as('addresses')->group(function(){

    //routes  services for module addresses
    Route::prefix('services')->as('services')->group(function(){

    });
});



