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
            $address = $this->service->findBy($id);
            if(empty($address)) return (new ApiResponse(false, null, 'Address not found.', 404))->createResponse();
            return (new ApiResponse(true, $address, 'Address found.', 200))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), 500))->createResponse();
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
            $updated = $this->service->update($request->all(), $id);
            if(empty($updated)) return (new ApiResponse(true, null, 'Address not found.', 404))->createResponse();
            return (new ApiResponse(true, $updated, 'Address updated.', 200))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), 500))->createResponse();
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
            $address = $this->service->destroy($id);
            if(empty($address)) return (new ApiResponse(false, null, 'Address not found.', 404))->createResponse();
            return (new ApiResponse(true, null, 'Address deleted.', 200))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), 500))->createResponse();
        }
    }
}
