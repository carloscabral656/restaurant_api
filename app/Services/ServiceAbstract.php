<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Facades\DB;

class ServiceAbstract
{

    protected $model;

    /**
     * Construct the default Controller in the application.
     *
     * @param Model $model
     *
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $resource = $this->model->all();
            return response($resource , 200)
                ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                ->header("Content-Type", "application/json");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array $data
     *
     * @return
     */
    public function store(array $data)
    {
        try{
            DB::beginTransaction();
            $resourceCreated = $this->model->create($data);
            DB::commit();
            return response($resourceCreated, 201)
                ->header("Content-Type", "application/json");
        }catch(Exception $e){
            DB::rollBack();
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
            $resource = $this->model->find($id);
            if(empty($resource)){
                return response("Resource doesn't found.", 404)
                    ->header("Content-Type", "application/json");
            }
            return response($resource, 200)
                ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                ->header("Content-Type", "application/json");
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(array $data, $id)
    {
        try{
            $resource = $this->model->find($id);
            if(empty($resource)){
                return response("Resource doesn't found.", 404)
                    ->header("Content-Type", "application/json");
            }
            $resourceUpdated = $resource->update($data);
            return response($resourceUpdated, 200)
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
            $resource = $this->model->find($id);
            if(empty($resource)){
                return response("Resource doesn't found.", 404)
                    ->header("Content-Type", "application/json");
            }
            $this->model->delete();
            return response(null, 204)
                ->header("Content-Type", "application/json");
        }catch(Exception $e){
            return response($e->getMessage(), 400)
                ->header("Content-Type", "application/json");
        }
    }
}
