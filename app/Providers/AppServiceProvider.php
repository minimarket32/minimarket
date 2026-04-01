<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Importamos la clase URL

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        /**
         * Forzamos el esquema HTTPS si no estamos en entorno local.
         * Esto elimina la pantalla de "Formulario no seguro" en Render.
         */
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
