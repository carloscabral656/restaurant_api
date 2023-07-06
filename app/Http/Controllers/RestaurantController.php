<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $restaurant = Restaurant::all();
            return response($restaurant , 200)
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
    public function store(Request $restaurant)
    {
        try{
            $restaurant = Restaurant::create($restaurant->all());
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
            $restaurant = Restaurant::find($id);
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

    /**
     * List a
     * 
     * 
    */
    public function filterRestaurantByCriteria(Request $request){
        
        // Creating 
        $query = DB::table('restaurants as r');

        // Filtering for name
        if($request->has('name')){
            $query->where('name', 'like', "%{request->get('name')}%");
        }

        // TODO: Filtering for price

        // Filtering for menu itens
        if($request->has('itemName')){
            $query
            ->join('menu as m', 'r.id', '=', 'm.id') // Restaurant's menu
            ->join('item as i', 'm.id', '=', 'i.id')
            ->where('i.name', 'like', "%{request->get('itemName')}%");
        }

        return $query->get();
        // Finding 
    }
}
