<?php

use App\Http\Controllers\Api\WebHooksController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Rota raiz: redireciona para /track com UTMs
|--------------------------------------------------------------------------
*/
Route::get('/', function(Request $request) {
    $queryString = $request->getQueryString(); // captura todos os parâmetros da URL
    $redirectUrl = '/track' . ($queryString ? '?' . $queryString : '');
    return redirect()->to($redirectUrl);
});

/*
|--------------------------------------------------------------------------
| Rota intermediária: captura UTMs e redireciona para login do painel
|--------------------------------------------------------------------------
*/
Route::get('/track', function(Request $request) {
    $utmKeys = ['utm_source','utm_medium','utm_campaign','utm_term','utm_content','xcod'];

    foreach ($utmKeys as $key) {
        if ($request->has($key)) {
            session([$key => $request->get($key)]); // salva UTMs na session
        }
    }

    return redirect()->to('/painel/login'); // vai para o login do Filament
});

/*
|--------------------------------------------------------------------------
| Webhooks
|--------------------------------------------------------------------------
*/
Route::post('/page/message', [WebHooksController::class, 'whatsAppPage']);
Route::post('/createThread', [WebHooksController::class, 'createTread']);
