<?php

namespace App\Http\Controllers\Items;

use App\DTOs\ApiResponse;
use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Models\Item;
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
            $item = Item::find($id);
            if(empty($item)){
                return response("Item doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            return response($item, 200)
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
    public function update(Request $item, $id)
    {
        try{
            $item = Item::find($id);
            if(empty($item)){
                return response("User doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            $item = Item::find($id);
            $item->update($item->all());
            return response($item, 200)
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
            $item = Item::find($id);
            if(empty($item)){
                return response("Item doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            $item = $item->delete();
            return response(null, 204)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                ->header("Content-Type", "application/json"); 
        }
    }
}
