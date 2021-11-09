<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PickupAndReturnPointIndexResource;
use App\Http\Resources\PickupAndReturnPointShowResource;
use App\Models\PickupAndReturnPoint;

class PickupAndReturnPointController extends Controller
{
    public function index()
    {
        return PickupAndReturnPointIndexResource::collection(
            PickupAndReturnPoint::all()
        );
    }

    public function show($id)
    {
        return new PickupAndReturnPointShowResource(PickupAndReturnPoint::findOrFail($id));
    }
}
