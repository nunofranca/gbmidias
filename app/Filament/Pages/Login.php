<?php

namespace App\Filament\Pages;

use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    /**
     * Caso queira mudar o guard de autenticação (opcional).
     */
    protected function getAuthenticationGuard(): string
    {
        return 'web';
    }

    /**
     * Caso queira usar um view Blade customizado.
     * Crie um arquivo em: resources/views/filament/auth/login.blade.php
     */
    protected static string $view = 'filament.auth.login';
}
