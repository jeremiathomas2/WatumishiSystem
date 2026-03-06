@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="space-y-6 fade-in">
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-white">Notifications</h2>
            <button onclick="markAllAsRead()" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm">
                <i class="fas fa-check-double mr-2"></i>
                Mark All Read
            </button>
        </div>

        <div class="space-y-4">
            @forelse ($notifications as $notification)
                <div class="glass-effect p-4 rounded-lg border-l-4 {{ $notification['read'] ? 'border-gray-600' : 'border-blue-500' }} hover:bg-white hover:bg-opacity-5 transition-all duration-200">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            @if($notification['read'])
                                <div class="w-10 h-10 bg-gray-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-envelope-open text-gray-400"></i>
                                </div>
                            @else
                                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center relative">
                                    <i class="fas fa-envelope text-white"></i>
                                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="text-white font-semibold mb-1">{{ $notification['title'] }}</h4>
                            <p class="text-blue-300 text-sm mb-2">{{ $notification['message'] }}</p>
                            <div class="flex items-center text-xs text-gray-400">
                                <i class="fas fa-clock mr-2"></i>
                                <span>{{ $notification['time'] }}</span>
                                @if(!$notification['read'])
                                    <span class="ml-auto bg-blue-600 text-white px-2 py-1 rounded-full">New</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <i class="fas fa-bell-slash text-6xl text-gray-500 mb-4"></i>
                    <p class="text-gray-400 text-lg">No notifications yet</p>
                    <p class="text-gray-500 text-sm">You're all caught up!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
function markAllAsRead() {
    fetch('{{ route('notifications.mark-read') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload page to show updated state
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error marking notifications as read:', error);
    });
}
</script>
@endsection
