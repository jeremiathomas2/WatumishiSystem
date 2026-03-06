@extends('layouts.app')

@section('title', 'Notifications')
@section('subtitle', 'Manage your notifications and alerts')

@section('content')
<div class="space-y-6 fade-in">
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-white">Notifications</h2>
            <div class="flex items-center space-x-4">
                <button onclick="markAllAsRead()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm">
                    <i class="fas fa-check-double mr-2"></i>
                    Mark All Read
                </button>
                <button onclick="clearAllNotifications()" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors duration-200 text-sm">
                    <i class="fas fa-trash mr-2"></i>
                    Clear All
                </button>
            </div>
        </div>

        <div class="space-y-4">
            @forelse ($notifications as $notification)
            <div class="glass-effect p-4 rounded-xl border border-gray-700 hover:border-{{ $notification['color'] }}-500 transition-all duration-200 {{ !$notification['read'] ? 'bg-white bg-opacity-5' : '' }}">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-{{ $notification['color'] }}-500 bg-opacity-20 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas {{ $notification['icon'] }} text-{{ $notification['color'] }}-400 text-xl"></i>
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-white font-semibold mb-1">{{ $notification['title'] }}</h3>
                                <p class="text-blue-300 text-sm mb-2">{{ $notification['message'] }}</p>
                                <div class="flex items-center space-x-4 text-xs text-gray-400">
                                    <span>
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $notification['time'] }}
                                    </span>
                                    @if(!$notification['read'])
                                    <span class="px-2 py-1 bg-blue-600 text-white rounded-full">
                                        New
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-2 ml-4">
                                @if(!$notification['read'])
                                <button onclick="markAsRead({{ $notification['id'] }})" class="text-blue-400 hover:text-blue-300 transition-colors" title="Mark as read">
                                    <i class="fas fa-envelope"></i>
                                </button>
                                @endif
                                <button onclick="deleteNotification({{ $notification['id'] }})" class="text-red-400 hover:text-red-300 transition-colors" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <i class="fas fa-bell text-6xl text-gray-500 mb-4"></i>
                <p class="text-gray-400 text-lg">No notifications yet</p>
                <p class="text-gray-500 text-sm mt-2">You're all caught up!</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script>
function markAsRead(id) {
    fetch(`/notifications/${id}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Notification marked as read', 'success');
            location.reload();
        }
    })
    .catch(error => {
        showNotification('Error marking notification as read', 'error');
    });
}

function markAllAsRead() {
    fetch('/notifications/read-all', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('All notifications marked as read', 'success');
            location.reload();
        }
    })
    .catch(error => {
        showNotification('Error marking notifications as read', 'error');
    });
}

function deleteNotification(id) {
    if (confirm('Are you sure you want to delete this notification?')) {
        fetch(`/notifications/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Notification deleted', 'success');
                location.reload();
            }
        })
        .catch(error => {
            showNotification('Error deleting notification', 'error');
        });
    }
}

function clearAllNotifications() {
    if (confirm('Are you sure you want to clear all notifications?')) {
        // Implement clear all functionality
        showNotification('All notifications cleared', 'success');
        location.reload();
    }
}
</script>
@endsection
