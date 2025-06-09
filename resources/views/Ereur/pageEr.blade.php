<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur Critique</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --error-color: #ff4757;
            --dark-color: #2f3542;
            --light-color: #f1f2f6;
        }
        
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--dark-color);
            color: var(--light-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
        }
        
        .error-card {
            position: relative;
            width: 90%;
            max-width: 500px;
            padding: 2.5rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            text-align: center;
            z-index: 1;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: fadeIn 0.8s ease-out;
        }
        
        .error-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                transparent 0%,
                rgba(255, 71, 87, 0.1) 50%,
                transparent 100%
            );
            transform: rotate(30deg);
            z-index: -1;
            animation: shine 3s infinite;
        }
        
        .error-icon {
            font-size: 5rem;
            color: var(--error-color);
            margin-bottom: 1.5rem;
            animation: pulse 2s infinite;
        }
        
        h1 {
            margin: 0 0 1rem 0;
            font-size: 2rem;
            color: var(--error-color);
        }
        
        .error-message {
            margin-bottom: 2rem;
            line-height: 1.6;
            font-size: 1.1rem;
        }
        
        .error-details {
            background: rgba(0, 0, 0, 0.2);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            font-family: monospace;
            font-size: 0.9rem;
            text-align: left;
            max-height: 150px;
            overflow-y: auto;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }
        
        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary {
            background-color: var(--error-color);
            color: white;
        }
        
        .btn-secondary {
            background-color: transparent;
            color: var(--light-color);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .btn-primary:hover {
            background-color: #ff6b81;
        }
        
        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        /* Animations */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes shine {
            0% { transform: rotate(30deg) translate(-10%, -10%); }
            100% { transform: rotate(30deg) translate(10%, 10%); }
        }
        
        /* Particules d'erreur */
        .particle {
            position: absolute;
            background-color: var(--error-color);
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.6;
        }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="error-icon">
            <i class="fas fa-bug"></i>
        </div>
        <h1>ERREUR SYSTÈME</h1>
        <div class="error-message">
        Un problème technique est survenu, veuillez réessayer plus tard. Si le problème persiste, contactez l'assistance.
        </div>
        <div class="error-details">
            <div>Code d'erreur: <strong>500-INTERNAL_SERVER_ERROR</strong></div>
            <div>Timestamp: <span id="timestamp"></span></div>
            <div>Transaction ID: <strong>ERR-<span id="transaction-id"></span></strong></div>
            <br>
            <div>Message technique: Connection to database failed after 3 attempts</div>
        </div>
        <div class="action-buttons">
            <button class="btn btn-primary">
                <i class="fas fa-sync-alt"></i> Réessayer
            </button>
            <button class="btn btn-secondary">
                <i class="fas fa-headset"></i> Support
            </button>
        </div>
    </div>

    <script>
        
        document.getElementById('timestamp').textContent = new Date().toLocaleString();
        document.getElementById('transaction-id').textContent = Math.random().toString(36).substr(2, 8).toUpperCase();
        function createParticles() {
            const colors = ['#ff4757', '#ff6b81', '#ff6348', '#ff7f50'];
            const particleCount = 20;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                const size = Math.random() * 10 + 5;
                const posX = Math.random() * window.innerWidth;
                const posY = Math.random() * window.innerHeight;
                const color = colors[Math.floor(Math.random() * colors.length)];
                const duration = Math.random() * 20 + 10;
                const delay = Math.random() * 5;
                
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${posX}px`;
                particle.style.top = `${posY}px`;
                particle.style.backgroundColor = color;
                particle.style.animation = `float ${duration}s ease-in-out ${delay}s infinite`;
                
                document.body.appendChild(particle);
            }
        }
        
        createParticles();
    </script>
</body>
</html>