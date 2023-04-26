<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bookable;
use App\Services\Bookings\BookingPriceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookablePriceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function __invoke($id, Request $request): JsonResponse
    {
        $bookable = Bookable::findOrFail($id);

        $data = $request->validate([
            'fromDate'   => 'required|date_format:Y-m-d|after_or_equal:fromDate',
            'fromTime' => 'required|date_format:H:i:s|after_or_equal:fromTime',
            'toDate'   => 'required|date_format:Y-m-d|after_or_equal:fromDate',
            'toTime'   => 'required|date_format:H:i:s|after_or_equal:fromTime',
        ]);

        $from = $data['fromDate'].' '.$data['fromTime'];
        $to = $data['toDate'].' '.$data['toTime'];

        $bookingPriceService = new BookingPriceService($bookable, $from, $to);
        $priceList = $bookingPriceService->calculatePrice();

        return response()->json([
            'data' => $priceList
            //'data' => $bookable->priceFor($data['from'], $data['to'])
        ]);
    }
}
