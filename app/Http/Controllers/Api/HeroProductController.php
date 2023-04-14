<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeroProductResource;
use App\Models\HeroProduct;
use App\Services\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HeroProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        try {
            return ApiResponse::json(
                HeroProductResource::collection(HeroProduct::where('active', true)->get())
            );
        } catch (Exception $exception) {
            return ApiResponse::jsonException($exception);
        }
    }
}
