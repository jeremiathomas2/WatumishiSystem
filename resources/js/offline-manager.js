// Advanced Offline Manager for Watumishi HR System
class OfflineManager {
    constructor() {
        this.cacheName = 'watumishi-hr-v2';
        this.isOnline = navigator.onLine;
        this.syncQueue = [];
        this.cachedResources = new Set();
        this.init();
    }

    init() {
        // Listen for online/offline events
        window.addEventListener('online', () => this.handleOnline());
        window.addEventListener('offline', () => this.handleOffline());
        
        // Register service worker
        this.registerServiceWorker();
        
        // Load queued actions
        this.loadSyncQueue();
        
        // Show offline status
        this.updateOfflineStatus();
        
        // Check for updates
        this.checkForUpdates();
    }

    async registerServiceWorker() {
        if ('serviceWorker' in navigator) {
            try {
                const registration = await navigator.serviceWorker.register('/sw.js');
                console.log('Service Worker registered:', registration);
                
                // Listen for messages from service worker
                navigator.serviceWorker.addEventListener('message', (event) => {
                    this.handleServiceWorkerMessage(event);
                });
                
                return registration;
            } catch (error) {
                console.error('Service Worker registration failed:', error);
            }
        }
    }

    handleOnline() {
        this.isOnline = true;
        this.updateOfflineStatus();
        this.processSyncQueue();
        this.showNotification('Back online! Syncing your data...', 'success');
    }

    handleOffline() {
        this.isOnline = false;
        this.updateOfflineStatus();
        this.showNotification('You are now offline. Some features may be limited.', 'warning');
    }

    updateOfflineStatus() {
        const statusElement = document.getElementById('offline-status');
        if (statusElement) {
            statusElement.textContent = this.isOnline ? 'Online' : 'Offline';
            statusElement.className = this.isOnline ? 'text-green-400' : 'text-red-400';
        }
    }

    // Queue actions for when offline
    queueAction(type, data) {
        const action = {
            id: Date.now(),
            type,
            data,
            timestamp: new Date().toISOString()
        };
        
        this.syncQueue.push(action);
        this.saveSyncQueue();
        
        if (!this.isOnline) {
            this.showNotification('Action queued for when you\'re back online', 'info');
        }
    }

    // Process queued actions when online
    async processSyncQueue() {
        if (this.syncQueue.length === 0) return;
        
        const actions = [...this.syncQueue];
        this.syncQueue = [];
        this.saveSyncQueue();
        
        for (const action of actions) {
            try {
                await this.processAction(action);
            } catch (error) {
                console.error('Failed to process action:', action, error);
                // Re-queue failed actions
                this.syncQueue.push(action);
            }
        }
    }

    async processAction(action) {
        const { type, data } = action;
        
        switch (type) {
            case 'attendance':
                return this.syncAttendance(data);
            case 'payroll':
                return this.syncPayroll(data);
            case 'employee':
                return this.syncEmployee(data);
            case 'performance':
                return this.syncPerformance(data);
            default:
                console.warn('Unknown action type:', type);
        }
    }

    async syncAttendance(data) {
        const response = await fetch('/attendance/sync', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });
        
        if (!response.ok) throw new Error('Sync failed');
        return response.json();
    }

    async syncPayroll(data) {
        const response = await fetch('/payroll/sync', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });
        
        if (!response.ok) throw new Error('Sync failed');
        return response.json();
    }

    async syncEmployee(data) {
        const response = await fetch('/employees/sync', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });
        
        if (!response.ok) throw new Error('Sync failed');
        return response.json();
    }

    async syncPerformance(data) {
        const response = await fetch('/performance/sync', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });
        
        if (!response.ok) throw new Error('Sync failed');
        return response.json();
    }

    saveSyncQueue() {
        localStorage.setItem('syncQueue', JSON.stringify(this.syncQueue));
    }

    loadSyncQueue() {
        const saved = localStorage.getItem('syncQueue');
        if (saved) {
            this.syncQueue = JSON.parse(saved);
        }
    }

    handleServiceWorkerMessage(event) {
        const { type, data } = event.data;
        
        switch (type) {
            case 'CACHE_UPDATED':
                this.showNotification('Content updated', 'info');
                break;
            case 'SYNC_COMPLETED':
                this.showNotification('Sync completed successfully', 'success');
                break;
            case 'SYNC_FAILED':
                this.showNotification('Sync failed, will retry later', 'error');
                break;
        }
    }

    showNotification(message, type = 'info') {
        // Use existing notification system if available
        if (typeof showNotification === 'function') {
            showNotification(message, type);
        } else {
            // Fallback notification
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.textContent = message;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 12px 20px;
                border-radius: 8px;
                color: white;
                z-index: 9999;
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            
            const colors = {
                success: '#10b981',
                error: '#ef4444',
                warning: '#f59e0b',
                info: '#3b82f6'
            };
            
            notification.style.background = colors[type] || colors.info;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
    }

    // Check for updates
    async checkForUpdates() {
        if ('serviceWorker' in navigator) {
            const registration = await navigator.serviceWorker.ready;
            registration.addEventListener('updatefound', () => {
                const newWorker = registration.installing;
                newWorker.addEventListener('statechange', () => {
                    if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                        this.showNotification('New version available! Refresh to update.', 'info');
                    }
                });
            });
        }
    }
}

// Initialize offline manager when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.offlineManager = new OfflineManager();
});

// Export for global access
window.OfflineManager = OfflineManager;
