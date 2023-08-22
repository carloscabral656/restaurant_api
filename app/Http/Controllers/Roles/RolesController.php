<?php

namespace App\Http\Controllers\Roles;

use App\DTOs\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Roles\RolesServiceConcrete;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RolesController extends Controller
{

    protected RolesServiceConcrete $service;

    public function __construct(RolesServiceConcrete $rolesServiceConcrete)
    {
        $this->service = $rolesServiceConcrete;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $roles = $this->service->index();
            if(empty($roles)) 
                return (new ApiResponse(true, null, 'No resource found.', 404))->createResponse();
            return (new ApiResponse(true, $roles, '', 200))->createResponse();
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
                'description'     => 'required',
            ]);
            // Creating a resource in DataBase
            $address = $this->service->store($request->all());
            return (new ApiResponse(true, $address, 'Role created.', 201))->createResponse();
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
            if(empty($address)) return (new ApiResponse(false, null, 'Role not found.', 404))->createResponse();
            return (new ApiResponse(true, $address, 'Role found.', 200))->createResponse();    
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
            if(empty($updated)) return (new ApiResponse(true, null, 'Role not found.', 404))->createResponse();
            return (new ApiResponse(true, $updated, 'Role updated.', 200))->createResponse();
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
            if(empty($address)) return (new ApiResponse(false, null, 'Role not found.', 404))->createResponse();
            return (new ApiResponse(true, null, 'Role deleted.', 200))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), 500))->createResponse();
        }
    }
}
