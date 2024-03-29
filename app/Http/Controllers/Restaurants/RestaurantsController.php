<?php

namespace App\Http\Controllers\Restaurants;

use App\DTOs\ApiResponse;
use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Restaurants\DTOs\RestaurantsDTO;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use App\Services\Restaurants\RestaurantsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class RestaurantsController extends Controller
{

    protected RestaurantsService $service;

    public function __construct(RestaurantsService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try{

            $restaurant = null;
            $item = null;

            // Restaurant's name
            if($request->has('restaurant'))
            {
                $restaurant = $request->get('restaurant');
            }

            // Restaurant's order
            if($request->has('item'))
            {
                $item = $request->get('item');
            }

            // Query
            $restaurants = $this->service->index($restaurant, $item);

            if(empty($restaurants))
            {
                return
                (
                    new ApiResponse
                    (
                        success: true,
                        data   : null,
                        message: trans('Responses/Restaurants.NotFound'),
                        code   : HttpStatus::OK
                    )
                )->createResponse();
            }

            // Mapping retrivied data to input in a DTO class
            $restaurants = $restaurants->map(
                function(Restaurant $r){
                    return (new RestaurantsDTO($r))->createDTO();
                }
            );

            return response()->json($restaurants->toArray());

            return (
                new ApiResponse
                (
                    success: true,
                    data   : $restaurants->toArray(),
                    message: trans('Responses/Restaurants.Found'),
                    code   : HttpStatus::OK
                )
            )->createResponse();

        } catch(\Exception $e)
        {
            return
            (
                new ApiResponse
                (
                    success   : false,
                    data      : null,
                    message   : $e->getMessage(),
                    code      : HttpStatus::BAD_REQUEST
                )
            )->createResponse();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        try
        {
            $request->validate([
                'name'           => 'required',
                'id_address'     => 'required',
                'id_gastronomy'  => 'required',
                'image_restaurant' => 'required',
                'id_restaurant_type' => 'required',
                'id_owner'   => 'required',
                'id_address' => 'required'
            ]);
            $restaurant = $this->service->store($request->all());
            return
            (
                new ApiResponse
                (
                    success: true,
                    data   : $restaurant,
                    message: trans('Responses/Restaurants.Found'),
                    code   : HttpStatus::OK
                )
            )->createResponse();
        }
        catch(ValidationException $e)
        {
            return
            (
                new ApiResponse
                (
                    success: false,
                    data   : null,
                    message: $e->getMessage(),
                    code   : HttpStatus::BAD_REQUEST
                )
            )->createResponse();
        }
        catch(Exception $e)
        {
            return
            (
                new ApiResponse
                (
                    success: false,
                    data   : $e->getMessage(),
                    message: '',
                    code   : HttpStatus::INTERNAL_SERVER_ERROR
                )
            )->createResponse();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id): JsonResponse
    {
        try
        {
            $restaurant = $this->service->findBy($id);

            if(empty($restaurant))
            {
                return
                (
                    new ApiResponse
                    (
                        success: false,
                        data   : null,
                        message: trans('Responses/Restaurants.NotFound'),
                        code   : HttpStatus::OK
                    )
                )->createResponse();
            }

            return
            (
                new ApiResponse
                (
                    success: true,
                    data   : (new RestaurantsDTO($restaurant))->createDTO(),
                    message: trans('Responses/Restaurants.Found'),
                    code   : HttpStatus::OK
                )
            )->createResponse();

        }catch(Exception $e)
        {
            return
            (
                new ApiResponse
                (
                    success: false,
                    data   : null,
                    message: $e->getMessage(),
                    code   : HttpStatus::OK
                )
            )->createResponse();
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'name'               => 'required',
                'id_address'         => 'required',
                'image_restaurant'   => 'required',
                'id_gastronomy'      => 'required',
                'id_restaurant_type' => 'required',
                'id_owner'           => 'required',
                'id_address'         => 'required'
            ]);
            $restaurant = $this->service->findBy($id);
            if(empty($restaurant)){
                return
                (
                    new ApiResponse (
                        success: false,
                        data   : null,
                        message: trans('Responses/Restaurants.NotFound'),
                        code   : HttpStatus::BAD_REQUEST
                    )
                )->createResponse();
            }

            $restaurant = $this->service->update($request->all(), $id);
            return
            (
                new ApiResponse (
                    success: true,
                    data   : $restaurant,
                    message: trans('Responses/Restaurants.Update.Success'),
                    code   : HttpStatus::BAD_REQUEST
                )
            )->createResponse();
        }catch(ValidationException $e)
        {
            return (
                    new ApiResponse(
                        success: false,
                        data   : null,
                        message: $e->errors(),
                        code   : HttpStatus::BAD_REQUEST
                    )
                )->createResponse();
        }catch(Exception $e)
        {
            return (
                    new ApiResponse(
                        success: false,
                        data   : null,
                        message: $e->getMessage(),
                        code   : HttpStatus::INTERNAL_SERVER_ERROR
                    )
                )->createResponse();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try{
            $restaurant = $this->service->findBy($id);
            if(empty($restaurant)) {
                return (
                        new ApiResponse(
                            success: false,
                            data   : null,
                            message: "Restaurant not found.",
                            code   : HttpStatus::BAD_REQUEST
                        )
                    )->createResponse();
            }
            $destroyed = $this->service->destroy($id);
            return (
                    new ApiResponse(
                        success: true,
                        data   : $destroyed,
                        message: "Restaurant deleted successfully.",
                        code   : HttpStatus::OK
                    )
                )->createResponse();
        }catch(Exception $e){
            return (
                new ApiResponse(
                    success: true,
                    data   : null,
                    message: $e->getMessage(),
                    code   : HttpStatus::INTERNAL_SERVER_ERROR
                )
            )->createResponse();
        }
    }
}
