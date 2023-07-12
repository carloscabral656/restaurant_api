<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Exception;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $purchase = Purchase::all();
            return response($purchase , 200)
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
    public function store(Request $purchase)
    {
        try{
            $uspurchaseer = Purchase::create($purchase->all());
            return response($purchase, 201)
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
            $purchase = Purchase::find($id);
            if(empty($purchase)){
                return response("Purchase doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            return response($purchase, 200)
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
    public function update(Request $purchase, $id)
    {
        try{
            $purchase = Purchase::find($id);
            if(empty($purchase)){
                return response("Purchase doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            $purchase->update($purchase->all());
            $purchase = Purchase::find($id);
            return response($purchase, 200)
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
            $purchase = Purchase::find($id);
            if(empty($purchase)){
                return response("Purchase doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            $purchase = $purchase->delete();
            return response(null, 204)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                ->header("Content-Type", "application/json"); 
        }
    }
}
