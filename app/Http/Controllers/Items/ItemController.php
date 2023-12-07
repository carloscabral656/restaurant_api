<?php

namespace App\Http\Controllers\Items;

use App\DTOs\ApiResponse;
use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Services\Items\ItemsServiceConcrete;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{
    protected ItemsServiceConcrete $service;

    public function __construct(ItemsServiceConcrete $service)
    {
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
            $item = $this->service->index();
            return (new ApiResponse(true, $item, '', HttpStatus::OK))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, $e->getMessage(), '', HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        try{
            $request->validate([
                'id_menu'      => 'required',
                'name'         => 'required',  
                'description'  => 'required',
                'img_item'     => 'required',
                'unit_price'   => 'required',
                'discount'     => 'required'
            ]);
            $item = $this->service->store($request->all());
            return (new ApiResponse(true, $item, '', HttpStatus::CREATED))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(false, null, '', HttpStatus::BAD_REQUEST))->createResponse();
        }catch(Exception $e){
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
            $item = $this->service->findBy($id);
            return (new ApiResponse(true, $item, '', HttpStatus::OK))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(false, null, '', HttpStatus::BAD_REQUEST))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, $e->getMessage(), '', HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
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
                'id_menu'      => 'required',
                'name'         => 'required',  
                'description'  => 'required',
                'img_item'     => 'required',
                'unit_price'   => 'required',
                'discount'     => 'required'
            ]);
            $item = $this->service->update($request->all(), $id);
            return (new ApiResponse(true, $item, '', HttpStatus::OK))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(false, null, '', HttpStatus::BAD_REQUEST))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, $e->getMessage(), '', HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
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
            $item = $this->service->destroy($id);
            return (new ApiResponse(true, $item, '', HttpStatus::OK))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(false, null, '', HttpStatus::BAD_REQUEST))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, $e->getMessage(), '', HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
        }
    }
}
