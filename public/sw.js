// Service Worker for Watumishi HR System
const CACHE_NAME = 'watumishi-hr-v2';
const STATIC_CACHE = 'watumishi-static-v2';
const DYNAMIC_CACHE = 'watumishi-dynamic-v2';

// Files to cache for offline functionality
const STATIC_FILES = [
    '/',
    '/login',
    '/dashboard',
    '/employees',
    '/attendance',
    '/payroll',
    '/performance',
    '/reports',
    '/build/assets/app-D-D1AOmr.js',
    '/build/assets/vendor-BQa4MRMe.js',
    '/build/assets/app-C4IfW9Cw.css',
    '/build/assets/app-CACh5-cS.css',
    '/build/assets/fa-solid-900-DRAbZTg.woff2',
    '/build/assets/fa-regular-400-nyy7hhHF.woff2',
    '/build/assets/fa-brands-400-BP5tdqmh.woff2',
    '/build/assets/fa-v4compatibility-DD84SGiu.woff2'
];

// Install event - cache static files
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(STATIC_CACHE)
            .then((cache) => {
                console.log('Service Worker: Caching static files');
                return cache.addAll(STATIC_FILES);
            })
            .then(() => {
                console.log('Service Worker: Static files cached successfully');
                return self.skipWaiting();
            })
    );
});

// Activate event - clean up old caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cache) => {
                    if (cache !== STATIC_CACHE && cache !== DYNAMIC_CACHE) {
                        console.log('Service Worker: Clearing old cache');
                        return caches.delete(cache);
                    }
                })
            );
        })
        .then(() => self.clients.claim())
    );
});

// Fetch event - serve from cache when offline
self.addEventListener('fetch', (event) => {
    // Skip non-GET requests
    if (event.request.method !== 'GET') {
        return;
    }

    event.respondWith(
        caches.match(event.request)
            .then((response) => {
                // Return cached version or fetch from network
                if (response) {
                    return response;
                }

                // Fetch from network
                return fetch(event.request)
                    .then((response) => {
                        // Check if valid response
                        if (!response || response.status !== 200 || response.type !== 'basic') {
                            return response;
                        }

                        // Clone response for caching
                        const responseClone = response.clone();

                        // Cache dynamic content
                        caches.open(DYNAMIC_CACHE)
                            .then((cache) => {
                                cache.put(event.request, responseClone);
                            });

                        return response;
                    })
                    .catch(() => {
                        // Offline fallback for HTML requests
                        if (event.request.headers.get('accept').includes('text/html')) {
                            return caches.match('/login');
                        }
                    });
            })
    );
});

// Background sync for offline actions
self.addEventListener('sync', (event) => {
    if (event.tag === 'background-sync') {
        event.waitUntil(doBackgroundSync());
    }
});

async function doBackgroundSync() {
    // Handle background sync for queued requests
    const pendingRequests = await getPendingRequests();
    
    for (const request of pendingRequests) {
        try {
            await fetch(request.url, request.options);
            await removePendingRequest(request.id);
        } catch (error) {
            console.error('Failed to sync request:', error);
        }
    }
}

// Push notification handler
self.addEventListener('push', (event) => {
    const options = {
        body: event.data ? event.data.text() : 'New notification',
        icon: '/build/assets/fa-solid-900-DRAAbZTg.woff2',
        badge: '/build/assets/fa-solid-900-DRAAbZTg.woff2',
        vibrate: [100, 50, 100],
        data: {
            dateOfArrival: Date.now(),
            primaryKey: 1
        }
    };

    event.waitUntil(
        self.registration.showNotification('Watumishi HR', options)
    );
});

// Notification click handler
self.addEventListener('notificationclick', (event) => {
    event.notification.close();
    
    event.waitUntil(
        clients.openWindow('/dashboard')
    );
});

// Helper functions for offline queue management
async function getPendingRequests() {
    // Implementation for getting pending requests from IndexedDB
    return [];
}

async function removePendingRequest(id) {
    // Implementation for removing synced request from IndexedDB
    return true;
}
