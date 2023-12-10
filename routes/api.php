<?php

use App\DTOs\ApiResponse;
use App\Helpers\HttpStatus;
use App\Http\Controllers\Addresses\AddressController;
use App\Http\Controllers\Auth\Api\LoginController;
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
    
    Route::middleware('auth:sanctum')->group(function() {
        // User's CRUD --------------------------------------------------------
        Route::resource("/users", UserController::class);
        // --------------------------------------------------------------------

        // Role's CRUD --------------------------------------------------------
        Route::resource("/roles", RolesController::class);
        // --------------------------------------------------------------------
        
        // Addresses's CRUD ---------------------------------------------------
        Route::resource("/addresses", AddressController::class);
        // --------------------------------------------------------------------

        // Gastronomies's CRUD ------------------------------------------------
        Route::resource("/gastronomies", GastronomyController::class);
        // --------------------------------------------------------------------

        // Restaurants's Type -------------------------------------------------
        Route::resource("/restaurants-type", RestaurantTypeController::class);
        // --------------------------------------------------------------------
        
        // Restaurant's CRUD --------------------------------------------------
        Route::resource('/restaurants', RestaurantsController::class);
        //---------------------------------------------------------------------


        Route::resource("/menus", MenuController::class);
        Route::resource("/itens", ItemController::class);
        Route::resource("/purchases", PurchasesController::class);
        Route::resource("/cupons", CuponsController::class);
        Route::fallback(function()
        {
            return 
            (
                new ApiResponse(
                    success: false,
                    data   : null,
                    message: "This route doesn't exists.",
                    code   : HttpStatus::BAD_REQUEST  
                )
            );
        });
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
