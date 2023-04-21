<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeatureCardIconCollection;
use App\Models\FeatureCardIcon;
use App\Services\ApiResponse;
use Illuminate\Http\JsonResponse;

class FeatureCardIconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return ApiResponse::json(
            FeatureCardIconCollection::collection(
                FeatureCardIcon::all()
            )
        );
    }


}
