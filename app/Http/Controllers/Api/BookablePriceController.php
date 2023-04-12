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
            'from' => 'required|date_format:Y-m-d H:i:s',
            'to' => 'required|date_format:Y-m-d H:i:s|after_or_equal:from'
        ]);

        $bookingPriceService = new BookingPriceService($bookable, $data['from'], $data['to']);
        $priceList = $bookingPriceService->calculatePrice();

        return response()->json([
            'data' => $priceList
            //'data' => $bookable->priceFor($data['from'], $data['to'])
        ]);
    }
}
