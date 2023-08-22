<?php

use App\Http\Controllers\Addresses\AddressController;
use App\Http\Controllers\Gastronomies\GastronomyController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Restaurants\RestaurantController;
use App\Http\Controllers\Restaurants\RestaurantsController;
use App\Http\Controllers\RestaurantsType\RestaurantTypeController;
use App\Http\Controllers\Roles\RolesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

Route::prefix("/v1")->group(function(){
    Route::resource("/users", UserController::class);
    Route::resource("/roles", RolesController::class);
    Route::resource("/addresses", AddressController::class);
    Route::resource("/gastronomies", GastronomyController::class);
    Route::resource("/restaurants-type", RestaurantTypeController::class);
    Route::resource("/restaurants", RestaurantsController::class);
    Route::resource("/menu", MenuController::class);
    Route::resource("/item", ItemController::class);
    Route::resource("/purchase", PurchaseController::class);
    Route::fallback(function(){
        echo "This route doesn't exists.";
    });
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
