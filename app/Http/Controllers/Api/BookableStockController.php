<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bookable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookableStockController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function __invoke($id, Request $request): JsonResponse
    {

        $data = $request->validate([
            'fromDate'   => 'required|date_format:Y-m-d|after_or_equal:fromDate',
            'fromTime' => 'required|date_format:H:i:s|after_or_equal:fromTime',
            'toDate'   => 'required|date_format:Y-m-d|after_or_equal:fromDate',
            'toTime'   => 'required|date_format:H:i:s|after_or_equal:fromTime',
        ]);

        $from = $data['fromDate'].' '.$data['fromTime'];
        $to = $data['toDate'].' '.$data['toTime'];

        $bookable = Bookable::findOrFail($id);

        if ($bookable->is_restricted_by_one) {
            return $bookable->stockFor($from, $to)
            ? response()->json([])
            : response()->json([], 404);
        }

        return response()->json([]);

    }
}
