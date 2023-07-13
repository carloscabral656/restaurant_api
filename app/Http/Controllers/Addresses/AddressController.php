<?php

namespace App\Http\Controllers\Addresses;

use App\DTOs\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Addresses\AddressesServiceConcrete;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AddressController extends Controller
{

    // Controller service
    protected AddressesServiceConcrete $service;

    public function __construct(AddressesServiceConcrete $addressesServiceConcrete){
        $this->service = $addressesServiceConcrete;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $address = $this->service->index();
            if(empty($address)) 
                return (new ApiResponse(true, null, 'No resource found.', 404))->createResponse();
            return (new ApiResponse(true, $address, '', 200))->createResponse();
        } catch(\Exception $e){
            return (new ApiResponse(false, null, '', 500))->createResponse();
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
            // Validate the user input
            $request->validate([
                'address'     => 'required',
                'neighborhood'    => 'required',
                'number' => 'required',
                'city' => 'required',
                'state' => 'required'
            ]);
            // Creating a resource in DataBase
            $address = $this->service->store($request->all());
            return (new ApiResponse(true, $address, 'Address created.', 201))->createResponse();
        }catch(ValidationException $v){
            return (new ApiResponse(false, $v->errors(), 'Validation failed.', 201))->createResponse();
        }catch(\Exception $e){
            return (new ApiResponse(false, $e->getMessage(), 'Exception in API.', 500))->createResponse();
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
            $address = $this->service->show($id);
            if(empty($address)) return (new ApiResponse(false, null, 'Address not found.'))->createResponse();
            return (new ApiResponse(true, $address, 'Address found.'))->createResponse();    
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage()))->createResponse();
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
            $user = User::find($id);
            if(empty($user)){
                return response("User doesn't found.", 404)
                    ->header("Content-Type", "application/json");
            }else if(!empty($user) && $request->get('id_roles')){
                $user->roles()->sync($request->get('id_roles'));
            }
            $user->update($request->except('id_roles'));
            return response($user, 200)
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
            $user = User::find($id);
            if(empty($user)){
                return response("User doesn't found.", 404)
                    ->header("Content-Type", "application/json");
            }
            $user->roles()->detach();
            $user->delete();
            return response(null, 204)
                ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                ->header("Content-Type", "application/json");
        }
    }
}
