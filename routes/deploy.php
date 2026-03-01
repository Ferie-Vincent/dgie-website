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

    Route::middleware([])->group(function () {

        Route::get('/migrate', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            try {
                Artisan::call('migrate', ['--force' => true]);
                return '<pre>Migrations exécutées ✓' . "\n\n" . Artisan::output() . '</pre>';
            } catch (\Throwable $e) {
                return '<pre style="color:red">ERREUR: ' . $e->getMessage() . "\n\n" . $e->getTraceAsString() . '</pre>';
            }
        });

        Route::get('/migrate-fresh', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            try {
                Artisan::call('migrate:fresh', ['--force' => true]);
                return '<pre>Migrate fresh exécuté ✓ (toutes les tables recréées)' . "\n\n" . Artisan::output() . '</pre>';
            } catch (\Throwable $e) {
                return '<pre style="color:red">ERREUR: ' . $e->getMessage() . "\n\n" . $e->getTraceAsString() . '</pre>';
            }
        });

        Route::get('/seed', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            try {
                Artisan::call('db:seed', ['--force' => true]);
                return '<pre>Seeders exécutés ✓' . "\n\n" . Artisan::output() . '</pre>';
            } catch (\Throwable $e) {
                return '<pre style="color:red">ERREUR: ' . $e->getMessage() . "\n\n" . $e->getTraceAsString() . '</pre>';
            }
        });

        Route::get('/storage-link', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            try {
                Artisan::call('storage:link');
                return '<pre>Storage link créé ✓' . "\n\n" . Artisan::output() . '</pre>';
            } catch (\Throwable $e) {
                return '<pre style="color:red">ERREUR: ' . $e->getMessage() . "\n\n" . $e->getTraceAsString() . '</pre>';
            }
        });

        Route::get('/cache-clear', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            try {
                Artisan::call('config:clear');
                Artisan::call('view:clear');
                Artisan::call('route:clear');
                Artisan::call('cache:clear');
                return '<pre>Caches vidés ✓</pre>';
            } catch (\Throwable $e) {
                return '<pre style="color:red">ERREUR: ' . $e->getMessage() . "\n\n" . $e->getTraceAsString() . '</pre>';
            }
        });

        Route::get('/optimize', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            try {
                Artisan::call('config:cache');
                Artisan::call('route:cache');
                Artisan::call('view:cache');
                return '<pre>Application optimisée ✓' . "\n\n" . Artisan::output() . '</pre>';
            } catch (\Throwable $e) {
                return '<pre style="color:red">ERREUR: ' . $e->getMessage() . "\n\n" . $e->getTraceAsString() . '</pre>';
            }
        });

        Route::get('/key-generate', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            try {
                Artisan::call('key:generate', ['--force' => true]);
                return '<pre>Clé générée ✓' . "\n\n" . Artisan::output() . '</pre>';
            } catch (\Throwable $e) {
                return '<pre style="color:red">ERREUR: ' . $e->getMessage() . "\n\n" . $e->getTraceAsString() . '</pre>';
            }
        });

        Route::get('/create-admin', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            try {
                $user = \App\Models\User::firstOrCreate(
                    ['email' => 'admin@dgie.gouv.ci'],
                    [
                        'name' => 'Super Admin DGIE',
                        'password' => \Illuminate\Support\Facades\Hash::make('Dgie@2026!'),
                        'role' => 'super-admin',
                    ]
                );
                return '<pre>Admin créé ✓' . "\n\nEmail: admin@dgie.gouv.ci\nMot de passe: Dgie@2026!\nRôle: super-admin</pre>";
            } catch (\Throwable $e) {
                return '<pre style="color:red">ERREUR: ' . $e->getMessage() . "\n\n" . $e->getTraceAsString() . '</pre>';
            }
        });

        Route::get('/test-login', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            try {
                $user = \App\Models\User::where('email', 'admin@dgie.gouv.ci')->first();
                if (!$user) {
                    return '<pre style="color:red">Utilisateur admin@dgie.gouv.ci introuvable en base</pre>';
                }
                $passwordOk = \Illuminate\Support\Facades\Hash::check('Dgie@2026!', $user->password);
                return '<pre>' .
                    'User trouvé: ' . $user->email . "\n" .
                    'Role: ' . $user->role . "\n" .
                    'Password hash match: ' . ($passwordOk ? 'OUI ✓' : 'NON ✗') . "\n" .
                    'ID: ' . $user->id . "\n" .
                    '</pre>';
            } catch (\Throwable $e) {
                return '<pre style="color:red">ERREUR: ' . $e->getMessage() . "\n\n" . $e->getTraceAsString() . '</pre>';
            }
        });

        Route::get('/check-files', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            $files = [
                'resources/views/front-end/partials/banner-pub.blade.php',
                'resources/views/front-end/partials/header.blade.php',
                'resources/views/front-end/partials/footer.blade.php',
                'resources/views/front-end/layouts/app.blade.php',
                'resources/views/back-end/layouts/admin.blade.php',
                'resources/views/back-end/dashboard.blade.php',
                'app/Http/Middleware/SecurityHeadersMiddleware.php',
                'app/Http/Middleware/AdminMiddleware.php',
            ];
            $output = '';
            foreach ($files as $f) {
                $exists = file_exists(base_path($f)) ? '✓' : '✗ MISSING';
                $output .= "$exists  $f\n";
            }
            return '<pre>' . $output . '</pre>';
        });

        Route::get('/check-logs', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            $logFile = storage_path('logs/laravel.log');
            if (!file_exists($logFile)) {
                return '<pre>Aucun fichier log trouvé.</pre>';
            }
            $lines = file($logFile);
            $last = array_slice($lines, -80);
            return '<pre>' . htmlspecialchars(implode('', $last)) . '</pre>';
        });

        Route::get('/check-permissions', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            $paths = [
                'storage' => storage_path(),
                'storage/logs' => storage_path('logs'),
                'storage/framework/sessions' => storage_path('framework/sessions'),
                'storage/framework/cache' => storage_path('framework/cache'),
                'storage/framework/views' => storage_path('framework/views'),
                'bootstrap/cache' => base_path('bootstrap/cache'),
            ];
            $output = '';
            foreach ($paths as $name => $path) {
                $exists = file_exists($path) ? 'EXISTS' : 'MISSING';
                $writable = is_writable($path) ? 'WRITABLE' : 'NOT WRITABLE';
                $output .= "$name: $exists / $writable\n";
            }
            return '<pre>' . $output . '</pre>';
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
