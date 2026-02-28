/* ============================================
   DGIE — Service Worker
   Cache des assets et pages pour navigation hors-ligne
   ============================================ */

const CACHE_VERSION = 'dgie-v11';
const STATIC_CACHE = CACHE_VERSION + '-static';
const PAGES_CACHE = CACHE_VERSION + '-pages';
const IMAGES_CACHE = CACHE_VERSION + '-images';

// Assets essentiels pré-cachés à l'installation
const PRECACHE_ASSETS = [
  '/',
  '/offline.html',
  '/assets/css/style.css?v=11',
  '/assets/js/main.js?v=11',
  '/assets/images/logo-dgie.png',
  '/assets/images/favicon.svg',
  '/assets/images/armoirie-ci.png'
];

// Pages front-end à cacher quand visitées
const CACHEABLE_PAGES = [
  '/', '/la-dgie', '/actualites', '/nos-services',
  '/coin-des-diaspos', '/dossiers', '/galerie',
  '/contact', '/retour-reintegration', '/investir-contribuer',
  '/mentions-legales', '/politique-confidentialite'
];

/* --- Installation : pré-cache des assets essentiels --- */
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(STATIC_CACHE).then(cache => {
      return cache.addAll(PRECACHE_ASSETS);
    }).then(() => self.skipWaiting())
  );
});

/* --- Activation : nettoyage des anciens caches --- */
self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(keys => {
      return Promise.all(
        keys.filter(key => key.startsWith('dgie-') && key !== STATIC_CACHE && key !== PAGES_CACHE && key !== IMAGES_CACHE)
            .map(key => caches.delete(key))
      );
    }).then(() => self.clients.claim())
  );
});

/* --- Fetch : stratégie réseau d'abord, cache en fallback --- */
self.addEventListener('fetch', event => {
  const { request } = event;
  const url = new URL(request.url);

  // Ignorer les requêtes non-GET, admin, et les requêtes cross-origin non-image
  if (request.method !== 'GET') return;
  if (url.pathname.startsWith('/admin')) return;
  if (url.pathname.startsWith('/api')) return;

  // Requêtes de navigation (pages HTML)
  if (request.mode === 'navigate') {
    event.respondWith(networkFirstPage(request));
    return;
  }

  // Assets statiques (CSS, JS)
  if (isStaticAsset(url)) {
    event.respondWith(cacheFirst(request, STATIC_CACHE));
    return;
  }

  // Images
  if (isImage(url)) {
    event.respondWith(cacheFirst(request, IMAGES_CACHE));
    return;
  }
});

/* --- Stratégie : réseau d'abord pour les pages --- */
async function networkFirstPage(request) {
  try {
    const response = await fetch(request);
    // Cacher les pages front réussies
    if (response.ok && response.status === 200) {
      const cache = await caches.open(PAGES_CACHE);
      cache.put(request, response.clone());
    }
    return response;
  } catch (err) {
    // Hors-ligne : chercher dans le cache
    const cached = await caches.match(request);
    if (cached) return cached;
    // Sinon : page offline de secours
    return caches.match('/offline.html');
  }
}

/* --- Stratégie : cache d'abord pour les assets --- */
async function cacheFirst(request, cacheName) {
  const cached = await caches.match(request);
  if (cached) return cached;

  try {
    const response = await fetch(request);
    if (response.ok) {
      const cache = await caches.open(cacheName);
      cache.put(request, response.clone());
    }
    return response;
  } catch (err) {
    // Pour les images, retourner un SVG placeholder transparent
    if (cacheName === IMAGES_CACHE) {
      return new Response(
        '<svg xmlns="http://www.w3.org/2000/svg" width="400" height="300" viewBox="0 0 400 300"><rect fill="#f1f5f9" width="400" height="300"/><text x="200" y="150" text-anchor="middle" fill="#94a3b8" font-family="sans-serif" font-size="14">Image non disponible</text></svg>',
        { headers: { 'Content-Type': 'image/svg+xml' } }
      );
    }
    return new Response('', { status: 408 });
  }
}

/* --- Helpers --- */
function isStaticAsset(url) {
  return url.pathname.match(/\.(css|js|woff2?|ttf|eot)(\?.*)?$/i) ||
         url.hostname === 'fonts.googleapis.com' ||
         url.hostname === 'fonts.gstatic.com';
}

function isImage(url) {
  return url.pathname.match(/\.(png|jpe?g|gif|svg|webp|ico)(\?.*)?$/i);
}
