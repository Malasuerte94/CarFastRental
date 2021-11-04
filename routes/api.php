<?php

use App\Http\Controllers\Api\BookableAdjectiveController;
use App\Http\Controllers\Api\BookableController;
use App\Http\Controllers\Api\BookablePriceController;
use App\Http\Controllers\Api\BookableReviewController;
use App\Http\Controllers\Api\BookableStockController;
use App\Http\Controllers\Api\BookingByReviewController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('bookables', BookableController::class)->only(['index', 'show']);
Route::get('bookables/{bookable}/stock', BookableStockController::class)
    ->name('bookables.stock.show');
Route::get('bookables/{bookable}/reviews', BookableReviewController::class)->name('bookable.reviews.index');
Route::get('bookables/{bookable}/adjectives', BookableAdjectiveController::class)->name('bookable.adjectives.index');
Route::get('bookables/{bookable}/price', BookablePriceController::class)->name('bookables.price.show');

Route::get('/booking-by-review/{reviewKey}', BookingByReviewController::class)->name('booking.by.review.show');

Route::apiResource('reviews', ReviewController::class)->only(['show', 'store']);

Route::post('checkout', CheckoutController::class)->name('checkout');
