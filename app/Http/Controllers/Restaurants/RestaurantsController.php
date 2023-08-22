<?php

namespace App\Http\Controllers\Restaurants;

use App\DTOs\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Services\Restaurants\RestaurantsService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestaurantsController extends Controller
{

    protected RestaurantsService $service;

    public function __construct(RestaurantsService $service){
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : JsonResponse
    {
        try{
            $restaurants = $this->service->index();
            if(empty($restaurants))
                return (new ApiResponse(true, null, 'No resource found.', 404))->createResponse();
            return (new ApiResponse(true, $restaurants, '', 200))->createResponse();
        }catch(\Exception $e){
            return (new ApiResponse(false, null, '', 500))->createResponse();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $restaurant)
    {
        try{
            $restaurant = $this->service->store($restaurant->all());
            return response($restaurant, 201)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                    ->header("Content-Type", "application/json");
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
            if(empty($restaurant)){
                return response("Restaurant doesn't found.", 404)
                    ->header("Content-Type", "application/json");
            }
            return response($restaurant, 200)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                    ->header("Content-Type", "application/json");
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $restaurant, $id)
    {
        try{
            $restaurant = Restaurant::find($id);
            if(empty($user)){
                return response("Restaurant doesn't found.", 404)
                    ->header("Content-Type", "application/json");
            }
            $restaurant = Restaurant::find($id);
            $restaurant->update($restaurant->all());
            return response($restaurant, 200)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                    ->header("Content-Type", "application/json");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $restaurant = Restaurant::find($id);
            if(empty($restaurant)){
                return response("Restaurant doesn't found.", 404)
                    ->header("Content-Type", "application/json");
            }
            $restaurant = $restaurant->delete();
            return response(null, 204)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                ->header("Content-Type", "application/json");
        }
    }
}
