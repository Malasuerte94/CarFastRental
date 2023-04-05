<?php

namespace App\Services\Bookings;

use App\Models\Bookable;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Summary of BookingService
 */
class BookingService
{

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function __construct()
    {

    }

    public static function getTotalPrice(Bookable $bookable, string $from, string $to): float
    {
        return (new BookingPriceService($bookable, $from, $to))->calculatePrice()['total'];
    }

}
