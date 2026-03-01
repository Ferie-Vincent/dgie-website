<?php

/**
 * Routes de déploiement temporaires.
 * À SUPPRIMER après le premier déploiement réussi.
 *
 * Utilisation : /deploy/{token}/migrate
 * Le token doit correspondre à DEPLOY_TOKEN dans .env
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::prefix('deploy/{token}')->group(function () {

    // Vérification du token
    Route::middleware([])->group(function () {

        Route::get('/migrate', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            Artisan::call('migrate', ['--force' => true]);
            return '<pre>Migrations exécutées ✓' . "\n\n" . Artisan::output() . '</pre>';
        });

        Route::get('/seed', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            Artisan::call('db:seed', ['--force' => true]);
            return '<pre>Seeders exécutés ✓' . "\n\n" . Artisan::output() . '</pre>';
        });

        Route::get('/storage-link', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            Artisan::call('storage:link');
            return '<pre>Storage link créé ✓' . "\n\n" . Artisan::output() . '</pre>';
        });

        Route::get('/cache-clear', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            Artisan::call('cache:clear');
            return '<pre>Caches vidés ✓</pre>';
        });

        Route::get('/optimize', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            Artisan::call('config:cache');
            Artisan::call('route:cache');
            Artisan::call('view:cache');
            return '<pre>Application optimisée ✓' . "\n\n" . Artisan::output() . '</pre>';
        });

        Route::get('/key-generate', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            Artisan::call('key:generate', ['--force' => true]);
            return '<pre>Clé générée ✓' . "\n\n" . Artisan::output() . '</pre>';
        });

        Route::get('/status', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            return '<pre>' .
                'PHP: ' . phpversion() . "\n" .
                'Laravel: ' . app()->version() . "\n" .
                'Env: ' . app()->environment() . "\n" .
                'Debug: ' . (config('app.debug') ? 'ON' : 'OFF') . "\n" .
                'DB: ' . config('database.default') . "\n" .
                'Key set: ' . (config('app.key') ? 'Yes' : 'No') . "\n" .
                'Storage linked: ' . (file_exists(public_path('storage')) ? 'Yes' : 'No') . "\n" .
                '</pre>';
        });
    });
});
