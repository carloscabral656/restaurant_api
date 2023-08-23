<?php

namespace App\Http\Controllers\Restaurants;

use App\DTOs\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Restaurants\DTOs\RestaurantsDTO;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Services\Restaurants\RestaurantsService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RestaurantsController extends Controller
{

    protected RestaurantsService $service;

    public function __construct(RestaurantsService $service){
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        try{
            $restaurants = $this->service->index();
            if(empty($restaurants))
                return (new ApiResponse(true, null, 'No resource found.', 404))->createResponse();
            $restaurants = $restaurants->map(function($r){
                return (new RestaurantsDTO())->createDTO($r);
            });
            return (new ApiResponse(true, $restaurants, '', 200))->createResponse();
        }catch(\Exception $e){
            return (new ApiResponse(false, null, '', 500))->createResponse();
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
        try{
            $request->validate([
                'name'           => 'required',
                'id_address'     => 'required',  
                'id_gastronomy'  => 'required',
                'id_restaurant_type' => 'required',
                'id_owner'   => 'required',
                'id_address' => 'required'
            ]);
            $restaurant = $this->service->store($request->all());
            return (new ApiResponse(true, $restaurant, '', 200))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(true, '', '', 400))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(true, $e->getMessage(), '', 400))->createResponse();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $restaurant = $this->service->findBy($id);
            if(empty($restaurant)) 
                return (
                        new ApiResponse(true, (new RestaurantsDTO())->createDTO($restaurant), 
                        "Restaurant doesn't found.", 404)
                    )->createResponse();
            return (new ApiResponse(true, $restaurant, "", 200))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(true, $e->getMessage(), "", 200))->createResponse();
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
            // Validation
            $request->validate([
                'name'           => 'required',
                'id_address'     => 'required',  
                'id_gastronomy'  => 'required',
                'id_restaurant_type' => 'required',
                'id_owner'   => 'required',
                'id_address' => 'required'
            ]);
            $restaurant = $this->service->findBy($id);
            if(empty($restaurant)){
                return (new ApiResponse(true, "", "", 404))->createResponse();
            }
            $restaurant = $this->service->update($request->all(), $id);
            return (new ApiResponse(true, $restaurant, "", 200))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(true, $e->errors(), '', 400))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(true, $e->getMessage(), '', 400))->createResponse();
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
            if(empty($restaurant)){
                return (new ApiResponse(true, null, "Restaurant not found.", 404))->createResponse();
            }
            $menu = $restaurant->menus()->first();
            Menu::destroy($menu->id);
            $destroyed = $this->service->destroy($id);
            return (new ApiResponse(true, $destroyed, "", 200))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(true, $e->getMessage(), '', 400))->createResponse();
        }
    }
}
