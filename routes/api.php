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

    //---------------------------------------------------------------------
    //                      Authentication Route
    //---------------------------------------------------------------------
    Route::prefix('auth')->group(function() {
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('/logout', [LoginController::class, 'logout']);
    });

    Route::middleware('auth:sanctum')->group(function() {

        // User Authenticated -------------------------------------------------
        Route::get('/user-authenticated', [LoginController::class, 'me']);
        // --------------------------------------------------------------------

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

        // Menus's CRUD -------------------------------------------------------
        Route::resource("/menus", MenuController::class);
        //---------------------------------------------------------------------

        // Itens's CRUD -------------------------------------------------------
        Route::resource("/itens", ItemController::class);
        //---------------------------------------------------------------------

        // Purchases's CRUD ---------------------------------------------------
        Route::resource("/purchases", PurchasesController::class);
        //---------------------------------------------------------------------

        // Cupons's CRUD ------------------------------------------------------
        Route::resource("/cupons", CuponsController::class);
        //---------------------------------------------------------------------


        // Imagens routes -----------------------------------------------------
        Route::get("/imagens/{id}", [ItemController::class, 'imagem']);
        //---------------------------------------------------------------------

    });

});

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
