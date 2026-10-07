<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
   
    ->withMiddleware(function (Middleware $middleware): void {
        
        // Désactiver les CSRF pour certaines routes
        $middleware->validateCsrfTokens(except: [
            'register',
            'admin/login',
            'login',
            'logout',
            'recipes',
            'recipes/my',
            'me',
            'favorites',
            'favorites/*',
            'recipes/*',
            'admin/users/*',
            'admin/recipes/*',
            'admin/dashboardStats',
            '/categories',
            '/admin/categories/*',
            '/admin/comments',
            '/admin/comments/*',
            'meal-plans',
            'meal-plans/*',
            
            'admin/categories/add'
        ]);
        
        $middleware->statefulApi();
         $middleware->alias([
    'auth' => \App\Http\Middleware\Authenticate::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
]);
      })
    ->withExceptions(function (Exceptions $exceptions): void {
        // ici tu peux configurer les exceptions si besoin
    })
    ->create();