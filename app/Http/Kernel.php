<?php

namespace portaria\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
    \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    \portaria\Http\Middleware\EncryptCookies::class,
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \portaria\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
    'auth' => \portaria\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'guest' => \portaria\Http\Middleware\RedirectIfAuthenticated::class,

    //middlewares do sistema
    'administrador' => \portaria\Http\Middleware\Administrador::class,
    'sindico' => \portaria\Http\Middleware\Sindico::class,
    'funcionario' => \portaria\Http\Middleware\Funcionario::class,
    'morador' => \portaria\Http\Middleware\Morador::class,
    ];
}
