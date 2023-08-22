<?php

namespace App\Http\Controllers\Gastronomies;

use App\DTOs\ApiResponse;
use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gastronomies\DTOs\GastronomiesDTO;
use App\Services\Gastronomies\GastronomiesServiceConcrete;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GastronomyController extends Controller
{

    // Service
    protected GastronomiesServiceConcrete $gastronomiesService;
    protected GastronomiesDTO $gastronomiesDTO;

    public function __construct(
        GastronomiesServiceConcrete $gastronomiesService,
        GastronomiesDTO $gastronomiesDTO
    )
    {
        $this->gastronomiesService = $gastronomiesService;
        $this->gastronomiesDTO     = $gastronomiesDTO;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        try{
            // Taking from a service.
            $gastronomies = $this->gastronomiesService->index();

            if(empty($gastronomies)) return (new ApiResponse(true, null, 'No resource found.', HttpStatus::NOT_FOUND))->createResponse();

            // Creating response from a DTO.
            $gastronomies = $gastronomies->map(function($g){
                return (new GastronomiesDTO($g))->createDTO();
            });

            // Response's application.
            return (new ApiResponse(true, $gastronomies, '', HttpStatus::OK))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $gastronomy) : JsonResponse
    {
        try{
            $gastronomy->validate(
                ['description' => 'required']
            );
            $gastronomy = $this->gastronomiesService->store($gastronomy->all());
            if(empty($gastronomy))
                return (new ApiResponse(false, null, 'No resource created.', HttpStatus::NOT_FOUND))->createResponse();

            $gastronomies = (new GastronomiesDTO($gastronomy))->createDTO();
            return (new ApiResponse(true, $gastronomies, '', HttpStatus::CREATED))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(false, $e->errors(), 'Validation error.', HttpStatus::BAD_REQUEST))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) : JsonResponse
    {
        try{
            $gastronomy = $this->gastronomiesService->findBy($id);
            if(empty($gastronomy))
                return (new ApiResponse(false, null, 'No resource found.', HttpStatus::NOT_FOUND))->createResponse();

            $gastronomy = (new GastronomiesDTO($gastronomy))->createDTO();
            return (new ApiResponse(true, $gastronomy, '', HttpStatus::OK))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(false, $e->errors(), 'Validation error.', HttpStatus::BAD_REQUEST))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $gastronomy, $id) : JsonResponse
    {
        try{
            $gastronomy->validate(
                ['description' => 'required']
            );
            $gastronomy = $this->gastronomiesService->update($gastronomy->all(), $id);
            if(empty($gastronomy))
                return (new ApiResponse(false, null, 'No resource found.', HttpStatus::NOT_FOUND))->createResponse();
            $gastronomies = (new GastronomiesDTO($gastronomy))->createDTO();
            return (new ApiResponse(true, $gastronomies, '', HttpStatus::OK))->createResponse();
        }catch(ValidationException $e){
            return (new ApiResponse(false, $e->errors(), 'Validation error.', HttpStatus::BAD_REQUEST))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) : JsonResponse
    {
        try{
            $gastronomy = $this->gastronomiesService->destroy($id);
            if(empty($gastronomy))
                return (new ApiResponse(false, null, 'No resource found.', HttpStatus::NOT_FOUND))->createResponse();
            return (new ApiResponse(true, null, 'Gastronomy deleted.', HttpStatus::OK))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), HttpStatus::INTERNAL_SERVER_ERROR))->createResponse();
        }
    }
}
