<?php

use App\Http\Controllers\Api\WebHooksController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'painel');

Route::post('/page/message', [WebHooksController::class, 'whatsAppPage']);
Route::post('/createThread', [WebHooksController::class, 'createTread']);


