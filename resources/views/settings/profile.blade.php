@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="space-y-6 fade-in">
    <div class="glass-card p-6 rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-white">My Profile</h2>
            <div class="flex items-center space-x-4">
                <!-- Profile Photo Section -->
                <div class="relative group">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg overflow-hidden">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}" 
                                 alt="Profile Photo" class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-user text-white text-2xl"></i>
                        @endif
                    </div>
                    <!-- Add Photo Button -->
                    <button onclick="document.getElementById('photo-upload').click()" 
                            class="absolute inset-0 w-full h-full bg-black bg-opacity-50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer">
                        <i class="fas fa-camera text-white text-xl"></i>
                    </button>
                    <!-- Hidden File Input -->
                    <input type="file" id="photo-upload" name="profile_photo" 
                           accept="image/*" class="hidden" onchange="handlePhotoUpload(this)">
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">{{ Auth::user()->name }}</h3>
                    <p class="text-blue-300 text-sm">{{ Auth::user()->email }}</p>
                    <p class="text-blue-200 text-xs uppercase tracking-wider font-semibold">{{ ucfirst(Auth::user()->role) }}</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-blue-300 mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" 
                           class="w-full glass-input rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-blue-300 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" 
                           class="w-full glass-input rounded-lg" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-blue-300 mb-2">Phone Number</label>
                    <input type="tel" name="phone" value="{{ Auth::user()->phone ?? '' }}" 
                           class="w-full glass-input rounded-lg" placeholder="+255 123 4567">
                </div>
                <div>
                    <label class="block text-sm font-medium text-blue-300 mb-2">Department</label>
                    <input type="text" value="IT Department" 
                           class="w-full glass-input rounded-lg" readonly>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-blue-300 mb-2">Position</label>
                    <input type="text" value="System Administrator" 
                           class="w-full glass-input rounded-lg" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-blue-300 mb-2">Employee ID</label>
                    <input type="text" value="ADM001" 
                           class="w-full glass-input rounded-lg" readonly>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-blue-300 mb-2">Bio</label>
                <textarea name="bio" rows="4" 
                          class="w-full glass-input rounded-lg" 
                          placeholder="Tell us about yourself...">System administrator with expertise in HR management systems.</textarea>
            </div>

            <!-- Photo Upload Progress (Hidden by default) -->
            <div id="upload-progress" class="hidden">
                <div class="bg-gray-700 rounded-full h-2 overflow-hidden">
                    <div id="progress-bar" class="bg-gradient-to-r from-blue-500 to-purple-600 h-full rounded-full transition-all duration-300" style="width: 0%"></div>
                </div>
                <p class="text-blue-300 text-sm mt-2">Uploading photo...</p>
            </div>

            <div class="flex justify-between items-center">
                <!-- Close Button -->
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-all duration-300 font-medium">
                    <i class="fas fa-times mr-2"></i>
                    Close
                </a>
                
                <!-- Update Profile Button -->
                <button type="submit" 
                        class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-lg hover:from-blue-600 hover:to-purple-700 transition-all duration-300 font-medium">
                    <i class="fas fa-save mr-2"></i>
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function handlePhotoUpload(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Validate file type
        if (!file.type.startsWith('image/')) {
            showNotification('Please select an image file', 'error');
            input.value = '';
            return;
        }
        
        // Validate file size (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            showNotification('Image size should be less than 5MB', 'error');
            input.value = '';
            return;
        }
        
        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            const profileImage = document.querySelector('.w-20.h-20');
            profileImage.innerHTML = `<img src="${e.target.result}" alt="Profile Preview" class="w-full h-full object-cover">`;
        };
        reader.readAsDataURL(file);
        
        // Show upload progress (simulated)
        showUploadProgress();
    }
}

function showUploadProgress() {
    const progressDiv = document.getElementById('upload-progress');
    const progressBar = document.getElementById('progress-bar');
    
    progressDiv.classList.remove('hidden');
    
    // Simulate upload progress
    let progress = 0;
    const interval = setInterval(() => {
        progress += 10;
        progressBar.style.width = progress + '%';
        
        if (progress >= 100) {
            clearInterval(interval);
            setTimeout(() => {
                progressDiv.classList.add('hidden');
                showNotification('Photo uploaded successfully!', 'success');
            }, 500);
        }
    }, 100);
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transform transition-all duration-300 translate-x-full`;
    
    // Set color based on type
    if (type === 'success') {
        notification.classList.add('bg-green-600', 'text-white');
    } else if (type === 'error') {
        notification.classList.add('bg-red-600', 'text-white');
    } else {
        notification.classList.add('bg-blue-600', 'text-white');
    }
    
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Hide notification after 3 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}
</script>
@endsection
