<?php

use App\Http\Controllers\Addresses\AddressController;
use App\Http\Controllers\Auth\Api\LoginController;
use App\Http\Controllers\Auth\Api\RegisterController;
use App\Http\Controllers\Cupons\CuponsController;
use App\Http\Controllers\Gastronomies\GastronomyController;
use App\Http\Controllers\Items\ItemController;
use App\Http\Controllers\Menus\MenuController;
use App\Http\Controllers\Purchases\PurchasesController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
    Route::resource("/menus", MenuController::class);
    Route::resource("/itens", ItemController::class);
    Route::resource("/purchases", PurchasesController::class);
    Route::resource("/cupons", CuponsController::class);
    Route::fallback(function(){
        echo "This route doesn't exists.";
    });
});

// Authentication Route
Route::prefix('auth')->group(function() {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
