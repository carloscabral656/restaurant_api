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
use Illuminate\Validation\ValidationException;

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

    /**
     * Creates new Resource.
     *
     * @return JsonResponse
     */
    public function store(Request $restaurantType) : JsonResponse
    {
        try{
            $restaurantType->validate(
                ['description' => 'required']
            );
            $restaurantType = $this->restaurantsTypeService->store($restaurantType->all());
            if(empty($restaurantType)) 
                return (new ApiResponse(false, null, 'No resource created.', HttpStatus::NOT_FOUND))->createResponse();
            $gastronomies = (new RestaurantsTypeDTO($restaurantType))->createDTO();
            return (new ApiResponse(true, $gastronomies, '', HttpStatus::CREATED))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(false, $e->errors(), 'Validation error.', HttpStatus::BAD_REQUEST))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) : JsonResponse
    {
        try{
            $restaurantType = $this->restaurantsTypeService->findBy($id);
            if(empty($restaurantType)) 
                return (new ApiResponse(false, null, 'No resource found.', HttpStatus::NOT_FOUND))->createResponse();
            $restaurantType = (new RestaurantsTypeDTO($restaurantType))->createDTO();
            return (new ApiResponse(true, $restaurantType, '', HttpStatus::OK))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(false, $e->errors(), 'Validation error.', HttpStatus::BAD_REQUEST))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $restaurantType, $id) : JsonResponse
    {
        try{
            $restaurantType->validate(
                ['description' => 'required']
            );
            $restaurantType = $this->restaurantsTypeService->update($restaurantType->all(), $id);
            if(empty($restaurantType)) 
                return (new ApiResponse(false, null, 'No resource found.', HttpStatus::NOT_FOUND))->createResponse();
            $restaurantType = (new RestaurantsTypeDTO($restaurantType))->createDTO();
            return (new ApiResponse(true, $restaurantType, '', HttpStatus::OK))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(false, $e->errors(), 'Validation error.', HttpStatus::BAD_REQUEST))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) : JsonResponse
    {
        try{
            $restaurantType = $this->restaurantsTypeService->destroy($id);
            if(!$restaurantType) return (new ApiResponse(false, null, 'No resource found.', HttpStatus::NOT_FOUND))->createResponse();
            return (new ApiResponse(true, null, 'Resource deleted.', HttpStatus::OK))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
        }
    }
}
