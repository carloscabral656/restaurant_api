<?php

namespace App\Http\Controllers\Addresses;

use App\DTOs\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Addresses\AddressesServiceConcrete;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\FlareClient\Api;

class AddressController extends Controller
{
    protected $service;

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
            return (new ApiResponse(true, $address, 'test'))->createResponse();
        } catch(\Exception $e){
            return (new ApiResponse(false, 'test', 'teset'))->createResponse();
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
        /*try{
            $request->validate([
                'name'     => 'required',
                'email'    => 'required',
                'password' => 'required',
            ]);

            return response($user, 201)
                ->header("Content-Type", "application/json");
        }catch(ValidationException $v){
            return response($v->errors(), 400)
                ->header("Content-Type", "application/json");
        }catch(\Exception $e){
            return response($e->getMessage(), 400)
                ->header("Content-Type", "application/json");
        }*/
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
