<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolerController;
use App\Http\Controllers\UserController;
use App\Models\Purchase;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use Database\Factories\GastronomyFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("/v1")->group(function(){
    Route::resource("/users", UserController::class);
    Route::resource("/roles", RoleController::class);
    Route::resource("/address", AddressController::class);
    Route::resource("/gastronomy", GastronomyFactory::class);
    Route::resource("/restaurant-type", RestaurantType::class);
    Route::resource("/restaurant", RestaurantController::class);
    Route::resource("/menu", MenuController::class);
    Route::resource("/item", ItemController::class);
    Route::resource("/purchase", PurchaseController::class);


    // Routes for the filters
    Route::prefix('/filters')->group(function(){
        Route::get('/restaurants', [RestaurantController::class, 'filterRestaurantByCriteria']);
    });
    
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
