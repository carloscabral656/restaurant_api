<?php

namespace App\Http\Controllers\Addresses;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $address = Address::all();
            return response($address , 200)
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
    public function store(Request $request)
    {
        try{
            $request->validate(
                [
                    'address' => 'required',
                    "neighborhood" => 'required',
                    "number" => 'required',
                    "city" => 'required',
                    "state" => 'required',
                ]
            );
            $address = Address::create($request->all());
            return response($address, 201)
                    ->header("Content-Type", "application/json");
        }catch(ValidationException $e){
            return response($e->getMessage(), 400)
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
            $address = Address::find($id);
            if(empty($address)){
                return response("Address doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            return response($address, 200)
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
    public function update(Request $address, $id)
    {
        try{
            $address = Address::find($id);
            if(empty($address)){
                return response("Address doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            $address = Address::find($id);
            $address->update($address->all());
            return response($address, 200)
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
            $address = Address::find($id);
            if(empty($address)){
                return response("Address doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            $address = $address->delete();
            return response(null, 204)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                ->header("Content-Type", "application/json"); 
        }
    }
}
