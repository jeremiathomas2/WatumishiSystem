<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watumishi HR System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #1a1f2e 0%, #0f1419 100%);
            overflow: hidden;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        
        .progress-bar {
            background: linear-gradient(90deg, #4F46E5 0%, #7C3AED 100%);
            box-shadow: 0 0 20px rgba(79, 70, 229, 0.5);
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .rotate {
            animation: rotate 2s linear infinite;
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="glass-effect rounded-2xl p-12 max-w-md w-full mx-4 fade-in">
        <div class="text-center">
            <!-- Logo/Icon -->
            <div class="mb-8">
                <div class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center pulse">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Title -->
            <h1 class="text-3xl font-bold text-white mb-2">Watumishi HR</h1>
            <p class="text-blue-200 mb-8">Tanzania Labour Law Compliant HR System</p>
            
            <!-- Loading Progress -->
            <div class="mb-6">
                <div class="flex justify-between text-sm text-blue-200 mb-2">
                    <span>Initializing System</span>
                    <span id="progressPercent">0%</span>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2 overflow-hidden">
                    <div id="progressBar" class="progress-bar h-full rounded-full transition-all duration-300 ease-out" style="width: 0%"></div>
                </div>
            </div>
            
            <!-- Loading Messages -->
            <div id="loadingMessage" class="text-blue-200 text-sm mb-4">Loading system components...</div>
            
            <!-- Loading Icon -->
            <div class="flex justify-center">
                <div class="w-8 h-8 border-4 border-blue-300 border-t-transparent rounded-full rotate"></div>
            </div>
        </div>
    </div>

    <script>
        const messages = [
            'Loading system components...',
            'Initializing security protocols...',
            'Loading compliance modules...',
            'Setting up user authentication...',
            'Preparing dashboard...',
            'Almost ready...'
        ];
        
        let progress = 0;
        let messageIndex = 0;
        
        function updateProgress() {
            progress += Math.random() * 15 + 5;
            if (progress > 100) progress = 100;
            
            document.getElementById('progressBar').style.width = progress + '%';
            document.getElementById('progressPercent').textContent = Math.floor(progress) + '%';
            
            // Update message
            if (progress > (messageIndex + 1) * 16 && messageIndex < messages.length - 1) {
                messageIndex++;
                document.getElementById('loadingMessage').textContent = messages[messageIndex];
            }
            
            if (progress >= 100) {
                setTimeout(() => {
                    window.location.href = '/login';
                }, 1000);
            } else {
                setTimeout(updateProgress, 300 + Math.random() * 500);
            }
        }
        
        // Start progress after a short delay
        setTimeout(updateProgress, 500);
    </script>
</body>
</html>
