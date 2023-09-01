<?php

namespace App\Http\Controllers\Purchases;

use App\DTOs\ApiResponse;
use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Purchases\DTOs\PurchaseDTO;
use App\Services\Purchases\PurchasesServiceConcrete;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PurchasesController extends Controller
{
    
    protected PurchasesServiceConcrete $service;

    
    public function __construct(PurchasesServiceConcrete $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $purchases = $this->service->index();
            $purchases = $purchases->map(function($p){
                return (new PurchaseDTO())->createDTO($p);
            });
            return (new ApiResponse(true, $purchases, '', HttpStatus::OK))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, $e->getMessage(), '', HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
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
                    "id_user" => "required", 
                    "items"   => "required"
                ]
            );
            $purchase = $this->service->store($request->all());
            $purchase->items()->attach($request->all()["items"]);
            $newPurchase = $this->service->findBy($purchase->id);
            $newPurchase = (new PurchaseDTO())->createDTO($newPurchase);
            return (new ApiResponse(true, $newPurchase, '', HttpStatus::OK))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(false, $e->errors(), '', HttpStatus::BAD_REQUEST))->createResponse();
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
            $purchase = $this->service->findBy($id);
            if(empty($purchase))
                return (new ApiResponse(true, null, 'No purchase found.', HttpStatus::OK))->createResponse();
            $purchase = (new PurchaseDTO)->createDTO($purchase);
            return (new ApiResponse(true, $purchase, '', HttpStatus::OK))->createResponse();
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
            $request->validate(
                [
                    "id_user" => "required", 
                    "items"   => "required"
                ]
            );
            $purchase = $this->service->update($request->all(), $id);
            if(empty($purchase)) return (new ApiResponse(false, null, '', HttpStatus::NOT_FOUND))->createResponse();
            $purchase->items()->sync($request->all()["items"]);
            $newPurchase = $this->service->findBy($purchase->id);
            $newPurchase = (new PurchaseDTO)->createDTO($newPurchase);
            return (new ApiResponse(true, $newPurchase, '', HttpStatus::OK))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(false, $e->errors(), '', HttpStatus::BAD_REQUEST))->createResponse();
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
            $deleted  = $this->service->destroy($id);
            if(!$deleted) return (new ApiResponse(false, null, 'Purchase not deleted.', HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
            return (new ApiResponse(true, null, 'Purchase deleted.', HttpStatus::OK))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, $e->getMessage(), '', HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
        }
    }
}
