<?php

namespace App\Http\Controllers\Gastronomies;

use App\DTOs\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gastronomies\DTOs\GastronomiesDTO;
use App\Services\Gastronomies\GastronomiesServiceConcrete;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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

            if(empty($gastronomies)) return (new ApiResponse(true, null, 'No resource found.', 404))->createResponse();

            // Creating response from a DTO.
            $gastronomies = $gastronomies->map(function($g){
                return (new GastronomiesDTO($g))->createDTO();
            });
            
            // Response's application.
            return (new ApiResponse(true, $gastronomies, '', 200))->createResponse();
        }catch(Exception $e){
            return (new ApiResponse(false, null, $e->getMessage(), 500))->createResponse();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $gastronomy)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $gastronomy, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
