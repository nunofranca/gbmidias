<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\WebHooksController;

Route::get('/webhook/9237werwer', [WebHooksController::class, 'validateWebHook']);
Route::post('/webhook/9237werwer', [WebHooksController::class, 'webhook']);
Route::post('/webhook/openpix/autoatendimento', [WebHooksController::class, 'webHookOpenPix']);
Route::post('/webhook/pushinpay/autoatendimento', [WebHooksController::class, 'webHookPushinPay']);
Route::post('/webhook/zapi', [WebHooksController::class, 'webhookZApi']);