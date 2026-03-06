// Offline Resource Manager
class OfflineManager {
    constructor() {
        this.cacheName = 'watumishi-hr-v1';
        this.cachedResources = new Set();
        this.init();
    }

    init() {
        // Register service worker if available
        if ('serviceWorker' in navigator) {
            this.registerServiceWorker();
        }

        // Cache critical resources
        this.cacheCriticalResources();

        // Setup online/offline event listeners
        this.setupConnectivityListeners();
    }

    async registerServiceWorker() {
        try {
            const registration = await navigator.serviceWorker.register('/sw.js');
            console.log('Service Worker registered:', registration);
        } catch (error) {
            console.log('Service Worker registration failed:', error);
        }
    }

    async cacheCriticalResources() {
        const criticalResources = [
            '/',
            '/dashboard',
            '/login',
            '/css/app.css',
            '/js/app.js',
            '/js/vendor.js'
        ];

        try {
            const cache = await caches.open(this.cacheName);
            await cache.addAll(criticalResources);
            console.log('Critical resources cached successfully');
        } catch (error) {
            console.error('Failed to cache critical resources:', error);
        }
    }

    setupConnectivityListeners() {
        window.addEventListener('online', () => {
            this.showNotification('You are back online!', 'success');
            this.syncPendingData();
        });

        window.addEventListener('offline', () => {
            this.showNotification('You are offline. Some features may be limited.', 'warning');
        });
    }

    async syncPendingData() {
        // Sync any pending data when back online
        const pendingData = localStorage.getItem('pendingData');
        if (pendingData) {
            try {
                const data = JSON.parse(pendingData);
                for (const item of data) {
                    await this.sendPendingRequest(item);
                }
                localStorage.removeItem('pendingData');
                this.showNotification('All pending data synced successfully', 'success');
            } catch (error) {
                console.error('Failed to sync pending data:', error);
            }
        }
    }

    async sendPendingRequest(requestData) {
        try {
            const response = await fetch(requestData.url, {
                method: requestData.method,
                headers: requestData.headers,
                body: requestData.body
            });
            return response;
        } catch (error) {
            console.error('Failed to send pending request:', error);
        }
    }

    queueRequestForSync(requestData) {
        const pendingData = localStorage.getItem('pendingData') || '[]';
        const data = JSON.parse(pendingData);
        data.push(requestData);
        localStorage.setItem('pendingData', JSON.stringify(data));
    }

    isOnline() {
        return navigator.onLine;
    }

    showNotification(message, type = 'info') {
        if (window.showNotification) {
            window.showNotification(message, type);
        } else {
            console.log(`[${type.toUpperCase()}] ${message}`);
        }
    }

    // Method to prefetch resources for offline use
    async prefetchResources(resources) {
        if (!this.isOnline()) return;

        try {
            const cache = await caches.open(this.cacheName);
            const promises = resources.map(resource => 
                cache.add(resource).catch(error => 
                    console.warn(`Failed to cache ${resource}:`, error)
                )
            );
            await Promise.all(promises);
            console.log('Resources prefetched successfully');
        } catch (error) {
            console.error('Failed to prefetch resources:', error);
        }
    }

    // Method to clear cache
    async clearCache() {
        try {
            await caches.delete(this.cacheName);
            console.log('Cache cleared successfully');
        } catch (error) {
            console.error('Failed to clear cache:', error);
        }
    }
}

// Initialize offline manager
window.offlineManager = new OfflineManager();

// Export for use in other modules
export default OfflineManager;
