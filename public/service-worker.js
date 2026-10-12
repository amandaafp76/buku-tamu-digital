const CACHE_VERSION = 'buku-tamu-v4';
const STATIC_CACHE  = CACHE_VERSION + '-static';
const RUNTIME_CACHE = CACHE_VERSION + '-runtime';
const OFFLINE_URL   = '/offline.html';

const STATIC_ASSETS = [
    '/',
    '/bukutamu-masuk',
    '/assets/css/bootstrap.min.css',
    '/assets/css/app.css',
    '/assets/css/components.css',
    '/assets/css/login.css',
    '/assets/js/bootstrap.bundle.min.js',
    '/assets/js/app.js',
    '/assets/icons/icon-72x72.png',
    '/assets/icons/icon-96x96.png',
    '/assets/icons/icon-128x128.png',
    '/assets/icons/icon-144x144.png',
    '/assets/icons/icon-192x192.png',
    '/assets/icons/icon-256x256.png',
    '/assets/icons/icon-384x384.png',
    '/assets/icons/icon-512x512.png',
    '/assets/icons/icon-maskable-512x512.png',
    '/manifest.json',
    OFFLINE_URL,
];

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(STATIC_CACHE)
            .then((cache) => {
                console.log('[SW] Pre-caching static assets');

                return Promise.all(
                    STATIC_ASSETS.map((url) =>
                        cache.add(url).catch((err) => {
                            console.warn('[SW] Gagal cache:', url, err);
                        })
                    )
                );
            })
            .then(() => self.skipWaiting())
    );
});


self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames
                    .filter((name) => name !== STATIC_CACHE && name !== RUNTIME_CACHE)
                    .map((name) => {
                        console.log('[SW] Menghapus cache lama:', name);
                        return caches.delete(name);
                    })
            );
        }).then(() => self.clients.claim())
    );
});


self.addEventListener('fetch', (event) => {
    const { request } = event;

    if (request.method !== 'GET') {
        return;
    }

    const url = new URL(request.url);

    if (url.origin !== self.location.origin) {
        return;
    }

    const pathname = url.pathname;

const isAdminOrPetugas =
    pathname.startsWith('/admin/') ||
    pathname.startsWith('/petugas/') ||
    pathname.startsWith('/index.php/admin/') ||
    pathname.startsWith('/index.php/petugas/');

if (isAdminOrPetugas) {
        event.respondWith(
            fetch(request).catch(() => {
                
                return caches.open(STATIC_CACHE).then((cache) => {
                    return cache.match(OFFLINE_URL).then((offline) => {
                        if (offline) {
                            return offline;
                        }
                        return new Response('Anda sedang offline.', {
                            status: 503,
                            headers: { 'Content-Type': 'text/html; charset=utf-8' },
                        });
                    });
                });
            })
        );
        return;
    }

    if (pathname.startsWith('/uploads/')) {
        event.respondWith(fetch(request));
        return;
    }

    if (
        pathname.startsWith('/assets/') ||
        pathname.endsWith('.css') ||
        url.pathname.endsWith('.js') ||
        url.pathname.endsWith('.png') ||
        url.pathname.endsWith('.jpg') ||
        url.pathname.endsWith('.jpeg') ||
        url.pathname.endsWith('.webp') ||
        url.pathname.endsWith('.svg') ||
        url.pathname.endsWith('.woff') ||
        url.pathname.endsWith('.woff2') ||
        url.pathname.endsWith('.ttf')
    ) {
        event.respondWith(cacheFirst(request));
        return;
    }

    if (request.headers.get('accept')?.includes('text/html')) {
        event.respondWith(networkFirstWithOffline(request));
        return;
    }

    event.respondWith(networkFirst(request));
});

async function cacheFirst(request) {
    const cache = await caches.open(STATIC_CACHE);
    const cached = await cache.match(request);

    if (cached) {
        return cached;
    }

    try {
        const response = await fetch(request);
        if (response && response.status === 200) {
            cache.put(request, response.clone());
        }
        return response;
    } catch (err) {
        console.warn('[SW] cacheFirst gagal:', request.url, err);
        throw err;
    }
}

async function networkFirst(request) {
    const cache = await caches.open(RUNTIME_CACHE);

    try {
        const response = await fetch(request);
        if (response && response.status === 200) {
            cache.put(request, response.clone());
        }
        return response;
    } catch (err) {
        const cached = await cache.match(request);
        if (cached) {
            return cached;
        }
        throw err;
    }
}

async function networkFirstWithOffline(request) {
    const cache = await caches.open(RUNTIME_CACHE);

    try {
        const response = await fetch(request);
        if (response && response.status === 200) {
            cache.put(request, response.clone());
        }
        return response;
    } catch (err) {
        const cached = await cache.match(request);
        if (cached) {
            return cached;
        }

        const offlineCache = await caches.open(STATIC_CACHE);
        const offline = await offlineCache.match(OFFLINE_URL);

        if (offline) {
            return offline;
        }

        return new Response(
            '<h1>Anda sedang offline</h1><p>Periksa koneksi Anda.</p>',
            {
                status: 503,
                headers: { 'Content-Type': 'text/html; charset=utf-8' },
            }
        );
    }
}