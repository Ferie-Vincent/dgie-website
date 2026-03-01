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

        Route::get('/fix-autoloader', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            $output = '';

            // Delete all cached files
            $cacheDir = base_path('bootstrap/cache');
            foreach (glob($cacheDir . '/*.php') as $file) {
                if (basename($file) !== '.gitignore') {
                    $output .= 'Deleted: ' . basename($file) . "\n";
                    @unlink($file);
                }
            }

            // Check if SecurityHeadersMiddleware is in classmap
            $classmap = base_path('vendor/composer/autoload_classmap.php');
            if (file_exists($classmap)) {
                $content = file_get_contents($classmap);
                if (strpos($content, 'SecurityHeadersMiddleware') !== false) {
                    $output .= "\nSecurityHeadersMiddleware: FOUND in classmap ✓\n";
                } else {
                    $output .= "\nSecurityHeadersMiddleware: NOT in classmap ✗\n";
                    // Try to fix by adding it
                    $middlewarePath = base_path('app/Http/Middleware/SecurityHeadersMiddleware.php');
                    if (file_exists($middlewarePath)) {
                        $output .= "File exists at: $middlewarePath\n";
                    }
                }
            }

            // Check autoload type
            $output .= "\nAutoloader files in vendor/composer/:\n";
            foreach (glob(base_path('vendor/composer/autoload_*.php')) as $f) {
                $output .= '  ' . basename($f) . ' (' . filesize($f) . ' bytes)' . "\n";
            }

            return '<pre>' . $output . '</pre>';
        });

        Route::get('/fix-opcache', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            $output = '';
            if (function_exists('opcache_reset')) {
                opcache_reset();
                $output .= "OPcache reset ✓\n";
            } else {
                $output .= "OPcache not available\n";
            }
            // Also clear Laravel caches
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            $output .= "All Laravel caches cleared ✓\n";

            // Test route resolution
            try {
                $route = app('router')->getRoutes()->match(
                    \Illuminate\Http\Request::create('/admin/dashboard', 'GET')
                );
                $output .= "\nRoute /admin/dashboard resolved to: " . $route->getActionName() . "\n";
                $output .= "Middleware: " . implode(', ', $route->gatherMiddleware()) . "\n";
            } catch (\Throwable $e) {
                $output .= "\nRoute resolution error: " . $e->getMessage() . "\n";
            }

            return '<pre>' . $output . '</pre>';
        });

        Route::get('/test-dashboard', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            try {
                // Login as admin
                $user = \App\Models\User::where('email', 'admin@dgie.gouv.ci')->first();
                \Illuminate\Support\Facades\Auth::login($user);

                // Try to render dashboard
                $controller = app()->make(\App\Http\Controllers\Admin\DashboardController::class);
                $request = \Illuminate\Http\Request::create('/admin/dashboard', 'GET');
                $response = $controller->index($request);

                return '<pre>Dashboard OK ✓ - Status: 200</pre>';
            } catch (\Throwable $e) {
                return '<pre style="color:red">ERREUR: ' . $e->getMessage() . "\n\nFile: " . $e->getFile() . ':' . $e->getLine() . "\n\n" . $e->getTraceAsString() . '</pre>';
            }
        });

        Route::get('/check-views', function (string $token) {
            if ($token !== config('app.deploy_token')) {
                abort(404);
            }
            $output = "base_path: " . base_path() . "\n\n";

            $viewsPath = resource_path('views');
            $output .= "views path: $viewsPath\n";
            $output .= "exists: " . (is_dir($viewsPath) ? 'YES' : 'NO') . "\n\n";

            // List all blade files recursively
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($viewsPath, \RecursiveDirectoryIterator::SKIP_DOTS)
            );
            $count = 0;
            foreach ($iterator as $file) {
                if ($file->getExtension() === 'php') {
                    $relative = str_replace($viewsPath . '/', '', $file->getPathname());
                    $output .= $relative . "\n";
                    $count++;
                }
            }
            $output .= "\nTotal: $count blade files";
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
