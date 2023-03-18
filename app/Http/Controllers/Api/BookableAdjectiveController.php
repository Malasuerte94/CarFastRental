<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookableAdjectiveIndexResource;
use App\Models\Adjective;
use App\Models\Bookable;
use Illuminate\Http\Request;

class BookableAdjectiveController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {
        $bookable = Bookable::findOrFail($id);

        return BookableAdjectiveIndexResource::collection(
            $bookable->bookableAdjective()->latest()->get()
        );
    }
}
