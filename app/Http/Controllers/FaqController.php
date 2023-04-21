<?php

namespace App\Http\Controllers;

use App\Http\Resources\FaqCollection;
use App\Models\Faq;
use App\Services\ApiResponse;
use Illuminate\Http\JsonResponse;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return ApiResponse::json(
            FaqCollection::collection(
                Faq::all()
            )
        );
    }

}
