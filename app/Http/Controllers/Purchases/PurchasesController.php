<?php

namespace App\Http\Controllers\Purchases;

use App\DTOs\ApiResponse;
use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Purchases\DTOs\PurchaseDTO;
use App\Models\Purchase;
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
            return $purchase;
        }catch(ValidationException $e){
            return (new ApiResponse(false, $e->errors(), '', HttpStatus::BAD_REQUEST))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, $e->getMessage(), '', 400))->createResponse();
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
            $purchase = (new PurchaseDTO())->createDTO($purchase);
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
