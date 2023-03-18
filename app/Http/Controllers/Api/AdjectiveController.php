<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdjectiveIndexResource;
use App\Http\Resources\AdjectiveShowResource;
use App\Models\Adjective;

class AdjectiveController extends Controller
{
    public function index()
    {
        return AdjectiveIndexResource::collection(
            Adjective::all()
        );
    }

    public function show($id)
    {
        return new AdjectiveShowResource(Adjective::findOrFail($id));
    }
}
