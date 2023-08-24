<?php

namespace App\Http\Controllers\Menus;

use App\DTOs\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Menus\DTOs\MenuDTO;
use App\Models\Menu;
use App\Services\Menus\MenuServiceConcrete;
use App\Services\ServiceAbstract;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MenuController extends Controller
{

    protected ServiceAbstract $service;

    public function __construct(MenuServiceConcrete $service)
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
            $menus = $this->service->index();
            $menus = $menus->map(function($m){
                return (new MenuDTO())->createDTO($m);
            });
            return (new ApiResponse(true, $menus, '', 200))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, $e->getMessage(), '', 400))->createResponse();
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
            $request->validate([
                'id_restaurant' => 'required',
                'name'          => 'required'
            ]);
            $menu = $this->service->store($request->all());
            $menu = (new MenuDTO())->createDTO($menu);
            return (new ApiResponse(true, $menu, '', 200))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(false, $e->errors(), '', 404))->createResponse();
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
            $menu = $this->service->findBy($id);
            if(empty($menu)) {
                return (new ApiResponse(true, 'No Menu found', '', 200))->createResponse();
            }
            $menu = (new MenuDTO())->createDTO($menu);
            return (new ApiResponse(true, $menu, '', 200))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(true, $menu, '', 400))->createResponse();
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
                'id_restaurant' => 'required',
                'name'          => 'required'
            ]);
            $menu = $this->service->findBy($id);
            if(empty($menu)){
                return (new ApiResponse(true, null, 'No Menu found.', 200))->createResponse();
            }
            $menu = $this->service->update($request->all(), $id);
            $menu = (new MenuDTO())->createDTO($menu);
            return (new ApiResponse(true, $menu, '', 200))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, $menu, '', 400))->createResponse();
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
            $menu = $this->service->findBy($id);
            if(empty($menu)){
                return (new ApiResponse(true, null, 'No Menu found.', 200))->createResponse();
            }
            $menu = $this->service->destroy($id);
            return (new ApiResponse(true, $menu, 'Menu destroyed.', 200))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, $menu, '', 400))->createResponse();
        }
    }
}
