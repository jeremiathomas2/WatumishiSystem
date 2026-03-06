<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline - Watumishi HR System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .offline-container {
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 500px;
            width: 90%;
        }
        
        .offline-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.8;
        }
        
        .offline-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .offline-message {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            line-height: 1.6;
        }
        
        .retry-button {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 10px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .retry-button:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .offline-features {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .feature-list {
            list-style: none;
            text-align: left;
            margin-top: 1rem;
        }
        
        .feature-list li {
            margin-bottom: 0.5rem;
            opacity: 0.8;
        }
        
        .feature-list li:before {
            content: "✓";
            margin-right: 0.5rem;
            color: #4ade80;
        }
        
        @media (max-width: 768px) {
            .offline-container {
                padding: 1.5rem;
                margin: 1rem;
            }
            
            .offline-title {
                font-size: 1.5rem;
            }
            
            .offline-message {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="offline-container">
        <div class="offline-icon">🌐</div>
        <h1 class="offline-title">You're Offline</h1>
        <p class="offline-message">
            It looks like you've lost your internet connection. 
            Don't worry - some features of the Watumishi HR System are still available offline.
        </p>
        
        <button class="retry-button" onclick="window.location.reload()">
            Try Again
        </button>
        
        <div class="offline-features">
            <h3>Available Offline:</h3>
            <ul class="feature-list">
                <li>View cached employee data</li>
                <li>Access recent reports</li>
                <li>View payroll records</li>
                <li>Browse attendance history</li>
                <li>Review performance data</li>
            </ul>
        </div>
    </div>
    
    <script>
        // Check connection status periodically
        setInterval(() => {
            if (navigator.onLine) {
                window.location.reload();
            }
        }, 5000);
        
        // Listen for connection changes
        window.addEventListener('online', () => {
            window.location.reload();
        });
    </script>
</body>
</html>
