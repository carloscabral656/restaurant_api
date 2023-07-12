<?php

namespace App\Http\Controllers;

use App\Models\RestaurantType;
use Exception;
use Illuminate\Http\Request;

class RestaurantTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $users = RestaurantType::all();
            return response($users , 200)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                    ->header("Content-Type", "application/json");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $restaurantType)
    {
        try{
            $restaurantType = RestaurantType::create($restaurantType->all());
            return response($restaurantType, 201)
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
            $restaurantType = RestaurantType::find($id);
            if(empty($restaurantType)){
                return response("Restaurant Type doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            return response($restaurantType, 200)
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
    public function update(Request $restaurantType, $id)
    {
        try{
            $restaurantType = RestaurantType::find($id);
            if(empty($restaurantType)){
                return response("Restaurant Type doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            $restaurantType = RestaurantType::find($id);
            $restaurantType->update($restaurantType->all());
            return response($restaurantType, 200)
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
            $restaurantType = RestaurantType::find($id);
            if(empty($restaurantType)){
                return response("Restaurant Type doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            $restaurantType = $restaurantType->delete();
            return response(null, 204)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                ->header("Content-Type", "application/json"); 
        }
    }
}
