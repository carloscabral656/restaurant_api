<?php

namespace App\Http\Controllers\Cupons;

use App\DTOs\ApiResponse;
use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Services\Cupoms\CupomsServiceConcrete;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CuponsController extends Controller
{

    // Controller service
    protected CupomsServiceConcrete $service;

    public function __construct(CupomsServiceConcrete $cupomsServiceConcrete){
        $this->service = $cupomsServiceConcrete;
    }

    /**
     * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        try{
            $cupom = $this->service->index();
            if(empty($cupom))
                return (new ApiResponse(true, null, 'No resource found.', HttpStatus::NOT_FOUND))->createResponse();
            return (new ApiResponse(true, $cupom, '', HttpStatus::OK))->createResponse();
        } catch(\Exception $e){
            return (new ApiResponse(false, null, '', HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
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
                'name'             => 'required',
                'description'      => 'required',
                'initial_date'     => 'required',
                'expiration_date'  => 'required',
                'percentage_descount' => 'required'
            ]);
            // Creating a resource in DataBase
            $cupom = $this->service->store($request->all());
            return (new ApiResponse(true, $cupom, '', HttpStatus::CREATED))->createResponse();
        }catch(ValidationException $v){
            return (new ApiResponse(false, $v->errors(), '', HttpStatus::BAD_REQUEST))->createResponse();
        }catch(\Exception $e){
            return (new ApiResponse(false, $e->getMessage(), '', HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
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
            $cupom = $this->service->findBy($id);
            if(empty($cupom)) return (new ApiResponse(false, null, '', HttpStatus::NOT_FOUND))->createResponse();
            return (new ApiResponse(true, $cupom, '', HttpStatus::OK))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
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
                'name'             => 'required',
                'description'      => 'required',
                'initial_date'     => 'required',
                'expiration_date'  => 'required',
                'percentage_descount' => 'required'
            ]);
            $cupom = $this->service->update($request->all(), $id);
            if(empty($updated)) return (new ApiResponse(true, null, '', HttpStatus::NOT_FOUND))->createResponse();
            return (new ApiResponse(true, $updated, '', HttpStatus::OK))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
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
            if(empty($address)) return (new ApiResponse(false, null, '', HttpStatus::NOT_FOUND))->createResponse();
            return (new ApiResponse(true, null, '', HttpStatus::OK))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
        }
    }

}
