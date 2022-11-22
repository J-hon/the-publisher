<?php

use App\Http\Controllers\PublisherController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SubscriptionController;
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

Route::post('subscribe/{topic}', [SubscriptionController::class, 'store']);
Route::post('publish/{topic}', [PublisherController::class, 'store']);

Route::post('test1', [SubscriberController::class, 'get']);
Route::post('test2', [SubscriberController::class, 'get2']);
