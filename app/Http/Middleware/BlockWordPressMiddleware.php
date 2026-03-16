<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockWordPressMiddleware
{
    /**
     * Legacy WordPress query parameters that should return 410 Gone.
     */
    private const WP_PARAMS = [
        'p', 'page_id', 'cat', 'tag', 'paged', 'm', 'feed', 'attachment_id', 'author',
    ];

    /**
     * Legacy WordPress path patterns that should return 410 Gone.
     */
    private const WP_PATH_PATTERNS = [
        '#^wp-(admin|login|content|includes|cron|json|signup|trackback)#',
        '#^(xmlrpc|wp-login)\.php$#',
        '#^feed/?$#',
        '#^comments/feed/?$#',
        '#^author/#',
        '#^category/#',
        '#^tag/#',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        // Check for WordPress query parameters on the root URL
        if ($request->path() === '/' || $request->path() === '') {
            foreach (self::WP_PARAMS as $param) {
                if ($request->query($param) !== null) {
                    abort(410);
                }
            }
        }

        // Check for WordPress path patterns
        $path = ltrim($request->path(), '/');
        foreach (self::WP_PATH_PATTERNS as $pattern) {
            if (preg_match($pattern, $path)) {
                abort(410);
            }
        }

        return $next($request);
    }
}
