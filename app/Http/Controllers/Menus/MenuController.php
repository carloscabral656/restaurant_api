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
            // Filtering in DTO
            $menus = $menus->map(function($m){
                return (new MenuDTO())->createDTO($m);
            });
            return (new ApiResponse(true, $menus, '', 200))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, $menus, '', 400))->createResponse();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $menu)
    {
        try{
            $menu = Menu::create($menu->all());
            return response($menu, 201)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                    ->header("Content-Type", "application/json");
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
            $menu = Menu::find($id);
            if(empty($menu)){
                return response("Menu doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            return response($menu, 200)
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
    public function update(Request $menu, $id)
    {
        try{
            $menu = Menu::find($id);
            if(empty($menu)){
                return response("Menu doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            $menu = Menu::find($id);
            $menu->update($menu->all());
            return response($menu, 200)
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
            $menu = Menu::find($id);
            if(empty($menu)){
                return response("Menu doesn't found.", 404)
                    ->header("Content-Type", "application/json"); 
            }
            $menu = $menu->delete();
            return response(null, 204)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                ->header("Content-Type", "application/json"); 
        }
    }
}
