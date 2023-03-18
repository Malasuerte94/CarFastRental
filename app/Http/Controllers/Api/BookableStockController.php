<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bookable;
use Illuminate\Http\Request;

class BookableStockController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {


        $data = $request->validate([
            'from' => 'required|date_format:Y-m-d H:i:s|after_or_equal:now',
            'to'   => 'required|date_format:Y-m-d H:i:s|after_or_equal:from',
        ]);


        $bookable = Bookable::findOrFail($id);

        return $bookable->stockFor($data['from'], $data['to'])
            ? response()->json([])
            : response()->json([], 404);
    }
}
