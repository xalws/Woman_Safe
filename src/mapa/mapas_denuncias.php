<?php
include("../../db/conection.php");
try {
    $denuncias = "SELECT lat, longitude, nombre FROM mapa";
    $sentencia_denuncias = $conn->prepare($denuncias);
    if ($sentencia_denuncias->execute()) {
        $result = $sentencia_denuncias->get_result();
        $data_denuncias = [];
        while ($row = $result->fetch_assoc()) {
            $data_denuncias[] = $row;
        }
    } else {
        echo 'Error al ejecutar la consulta';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.css" />
    <link rel="stylesheet" href="../../assets/css/estilo.css">
</head>
<header>
    <!-- Nabvar -->
    <nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="../../index.php">MujerSegura</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mapa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../ayuda.php">Ayuda</a>

                    </li>
                </ul>
                <a href="../denunciar.php" class="btn btn-brand ms-lg-3">denunciar</a>
                </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<body>
    <div id="map_e"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicialización del mapa
            var defaultLatitude = 31.6899507139661;
            var defaultLongitude = -106.42805552045542;

            var map_e = L.map('map_e', {
                attributionControl: true
            }).setView([defaultLatitude, defaultLongitude], 12);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 20,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map_e);

            // Transformar los datos PHP a un objeto JavaScript válido usando json_encode
            var denuncias = <?php echo json_encode($data_denuncias); ?>;

            denuncias.forEach(function(denuncia) {
                var marker = L.marker([denuncia.lat, denuncia.longitude]).addTo(map_e);

                // Crear contenido del popup
                var popupContent = denuncia.nombre;
                marker.bindPopup(popupContent);
            });
        });

        // Obtener la ubicación del usuario
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            var latlng = L.latLng(latitude, longitude);
            L.marker(latlng).addTo(map_e)
                .bindPopup('Tu ubicación').openPopup();
            map_e.setView([latitude, longitude], 13);

            var minDistance = Number.MAX_VALUE;
            var zonaCercana = null;

            denuncias.forEach(function(denuncia) {
                var distance = haversineDistance(latitude, longitude, denuncia.lat, denuncia.longitude);
                if (distance < minDistance) {
                    minDistance = distance;
                    zonaCercana = denuncia;
                }
            });

            if (zonaCercana) {
                alert('Cuidado: ' + zonaCercana.nombre + ' una zona de riesgo está a ' + minDistance.toFixed(2) + ' kilómetros.');
                L.Routing.control({
                    waypoints: [
                        L.latLng(latitude, longitude),
                        L.latLng(zonaCercana.lat, zonaCercana.longitude)
                    ],
                    routeWhileDragging: true,
                    lineOptions: {
                        styles: [{
                            color: '#38619e',
                            opacity: 0.8,
                            weight: 5
                        }]
                    }
                }).addTo(map_e);
            } else {
                alert('No se encontró la zona más cercana.');
            }
        }, function() {
            alert('La ubicación del usuario no está disponible.');
        });
    </script>
</body>

</html>