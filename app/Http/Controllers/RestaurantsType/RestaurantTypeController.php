<?php

namespace App\Http\Controllers\RestaurantsType;

use App\DTOs\ApiResponse;
use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RestaurantsType\DTOs\RestaurantsTypeDTO;
use App\Services\RestaurantsType\RestaurantsTypeServiceConcrete;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestaurantTypeController extends Controller
{
    protected RestaurantsTypeServiceConcrete $restaurantsTypeService;
    protected RestaurantsTypeDTO $restaurantsTypeDTO;

    public function __construct(
        RestaurantsTypeServiceConcrete $restaurantsTypeService, 
        RestaurantsTypeDTO $restaurantsTypeDTO
    )
    {
        $this->restaurantsTypeService = $restaurantsTypeService;
        $this->restaurantsTypeDTO     = $restaurantsTypeDTO;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        try{
            $restaurantsType = $this->restaurantsTypeService->index();

            if(empty($restaurantsType)) return (new ApiResponse(true, null, 'No resource found.', HttpStatus::NOT_FOUND))->createResponse();

            $restaurantsType = $restaurantsType->map(function($g){
                return (new restaurantsTypeDTO($g))->createDTO();
            });
            
            return (new ApiResponse(true, $restaurantsType, '', HttpStatus::OK))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
        }
    }
}
