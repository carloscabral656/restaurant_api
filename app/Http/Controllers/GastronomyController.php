<?php

namespace App\Http\Controllers;

use App\Models\Gastronomy;
use App\Models\RestaurantType;
use Exception;
use Illuminate\Http\Request;

class GastronomyController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $gastronomy = Gastronomy::all();
            return response($gastronomy , 200)
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
    public function store(Request $gastronomy)
    {
        try{
            $gastronomy = Gastronomy::create($gastronomy->all());
            return response($gastronomy, 201)
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
            $gastronomy = Gastronomy::find($id);
            if(empty($user)){
                return response("Gastronomy doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            return response($user, 200)
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
    public function update(Request $gastronomy, $id)
    {
        try{
            $gastronomy = Gastronomy::find($id);
            if(empty($gastronomy)){
                return response("Gastronomy doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            $gastronomy = Gastronomy::find($id);
            $gastronomy->update($gastronomy->all());
            return response($gastronomy, 200)
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
            $gastronomy = Gastronomy::find($id);
            if(empty($user)){
                return response("Gastronomy doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            $user = $user->delete();
            return response(null, 204)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                ->header("Content-Type", "application/json"); 
        }
    }
}
