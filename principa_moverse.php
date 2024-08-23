<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOVERSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8pwtM7M3Mo7GgO8gGWPC1fD43I-J8b5k&callback=initMap" async defer></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
        .chat-message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <header class="bg-dark text-white text-center py-3">
        <h1>Transporte App</h1>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" id="chat"><i class="fas fa-comments"></i> Chat de la ruta A</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="rutas"><i class="fas fa-route"></i> Ver Rutas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="report"><i class="fas fa-map-marker-alt"></i> Reportar Problema</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        <div id="content">
            <div class="map-container bg-light p-4 rounded" id="map" style="display: none;">
                <p class="text-center">Mapa de Rutas</p>
            </div>

            <div class="chat-container bg-light p-4 rounded mt-4" id="div_chat" style="display: none;">
                <h2>Chat Público</h2>
                <div id="message">
                    <!-- Mensajes del chat aparecerán aquí -->
                </div>
                <input type="text" id="chatInput" class="form-control mt-3" placeholder="Escribe un mensaje..." />
                <button id="sendMessage" class="btn btn-primary mt-2">Enviar</button>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const chat = document.getElementById('chat');
        const rutas = document.getElementById('rutas');
        const report = document.getElementById('report');
        const div_chat = document.getElementById('div_chat');
        const mapContainer = document.getElementById('map');
        const chatInput = document.getElementById('chatInput');
        const sendMessage = document.getElementById('sendMessage');
        const messageContainer = document.getElementById('message');

        chat.addEventListener('click', function() {
            div_chat.style.display = 'block';
            mapContainer.style.display = 'none';
        });

        rutas.addEventListener('click', function() {
            div_chat.style.display = 'none';
            mapContainer.style.display = 'block';
            if (typeof initMap === 'function') {
                initMap(); // Inicializa el mapa cuando se selecciona la opción de rutas
            }
        });

        report.addEventListener('click', function() {
            alert('Problema reportado en el mapa.');
        });

        sendMessage.addEventListener('click', function() {
            const messageText = chatInput.value.trim();
            if (messageText) {
                const messageElement = document.createElement('div');
                messageElement.classList.add('chat-message');
                messageElement.textContent = messageText;
                messageContainer.appendChild(messageElement);
                chatInput.value = ''; // Limpia el campo de entrada
                messageContainer.scrollTop = messageContainer.scrollHeight; // Desplaza hacia abajo
            }
        });

        // Permitir el envío del mensaje al presionar Enter
        chatInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                sendMessage.click();
            }
        });

        function initMap() {
            // Coordenadas iniciales del mapa
            const initialLatLng = { lat: -34.397, lng: 150.644 };

            // Crear el mapa
            const map = new google.maps.Map(mapContainer, {
                center: initialLatLng,
                zoom: 8
            });

            // Añadir marcador
            new google.maps.Marker({
                position: initialLatLng,
                map: map
            });
        }
    </script>
</body>
</html>
