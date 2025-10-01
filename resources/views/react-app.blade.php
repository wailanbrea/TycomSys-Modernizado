<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Argon Dashboard React con Laravel 12" />
    <title>Argon Dashboard - Laravel + React</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen',
                'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue',
                sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background-color: #f8f9fe;
        }
        
        .loading-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        
        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .loading-text {
            margin-top: 20px;
            color: #666;
            font-size: 16px;
        }
        
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin: 20px;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <noscript>Necesitas habilitar JavaScript para ejecutar esta aplicación.</noscript>
    <div id="root">
        <div class="loading-container">
            <div class="loading-spinner"></div>
            <div class="loading-text">Cargando Argon Dashboard...</div>
        </div>
    </div>
    
    <div class="error-message" style="display: none;" id="error-message">
        <strong>Error:</strong> No se pudo cargar la aplicación React. 
        Asegúrate de que el frontend esté compilado ejecutando <code>npm run build</code> en la carpeta frontend.
    </div>
    
    <script>
        // Mostrar error si la aplicación no carga en 10 segundos
        setTimeout(function() {
            document.getElementById('error-message').style.display = 'block';
        }, 10000);
    </script>
</body>
</html>
