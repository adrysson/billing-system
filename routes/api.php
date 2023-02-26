<?php

use App\Presentation\Http\Controllers\V1\Csv\CsvDebtController;
use App\Presentation\Http\Controllers\V1\Webhook\WebhookPaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    Route::post('/csv/debts', [CsvDebtController::class, 'store']);
    Route::post('/webhook/payments', [WebhookPaymentController::class, 'store']);
});