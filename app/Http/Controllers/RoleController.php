<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $roles = Roles::all();
            return response($roles, 200)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                    ->header("Content-Type", "application/json");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $role)
    {
        try{
            $role = Roles::create($role->all());
            return response($role, 201)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($role, 400)
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
            $role = Roles::find($id);
            return response($role, 200)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($role, 400)
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
            $role = Roles::find($id);
            $roleUpdated = $role->update($request->all());
            return response($roleUpdated, 200)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($role, 400)
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
            $role = Roles::find($id);
            $roleDeleted = $role->delete();
            return response($roleDeleted, 200)
                    ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($role, 400)
                    ->header("Content-Type", "application/json");
        }
    }
}
