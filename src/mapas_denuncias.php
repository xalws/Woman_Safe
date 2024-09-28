<?php
include("../db/conection.php");
try {
    $denuncias = "SELECT lat, longitude, nombre FROM mapa";
    $sentencia_zonas = $conn->prepare($denuncias);
    if ($sentencia_zonas->execute()) {
        $result = $sentencia_zonas->get_result();
        $data_zonas = [];
        while ($row = $result->fetch_assoc()) {
            $data_zonas[] = $row;
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
    <link rel="stylesheet" href="../assets/css/estilo.css">
    <link rel="shortcut icon" href="/assets/img/woman.svg" type="image/x-icon">
</head>
<header>
    <!-- Nabvar -->
    <nav class="navbar bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../index.php">MujerSegura</a>
            <div class="d-flex align-items-center ms-auto">
                <!-- Agregamos un contenedor flexible -->
                <a href="denunciar.php" class="btn btn-brand ms-4">Denunciar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Mapa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ayuda.php">Ayuda</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<body>
    <div id="map_e"></div>
    <script>
        // Si no da la ubicación
        var defaultLatitude = 31.6899507139661;
        var defaultLongitude = -106.42805552045542;

        // Ubicar el mapa
        var map_e = L.map('map_e', {
            attributionControl: true
        }).setView([defaultLatitude, defaultLongitude], 12);

        // Azulejo
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map_e);

        // Marcadores de las zonas
        var zonas = <?php echo json_encode($data_zonas); ?>;

        zonas.forEach(function(denuncia) {
            var marker = L.marker([denuncia.lat, denuncia.longitude]).addTo(map_e);
            marker.bindPopup(denuncia.nombre);
        });

        /*var popup = L.popup();
        function clickMapa(e) {
            popup
                .setLatLng(e.latlng)
                .setContent(e.latlng.toString())
                .openOn(map_e);
        }

        map_e.on('click', clickMapa);*/

        // Obtener ubicación del usuario
        navigator.geolocation.getCurrentPosition(function(position) {
            // Obtener las coordenadas de latitud y longitud 
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Mostrar el marcador de la ubicación del usuario
            var latlng = L.latLng(latitude, longitude);
            L.marker(latlng).addTo(map_e)
                .bindPopup('Tu ubicación').openPopup();
            map_e.setView([latitude, longitude], 12);

            // Calcular la Zona más cercana con Haversine
            function haversineDistance(lat1, lon1, lat2, lon2) {
                var R = 6378;
                var dLat = (lat2 - lat1) * Math.PI / 180;
                var dLon = (lon2 - lon1) * Math.PI / 180;
                var a =
                    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                var d = R * c;
                return d;
            }

            // Rango de 2 km
            var minDistance = 2;
            var zonaCercana = null;

            zonas.forEach(function(zona) {
                var distance = haversineDistance(latitude, longitude, zona.lat, zona.longitude);
                if (distance < minDistance) {
                    minDistance = distance;
                    zonaCercana = zona;
                }
            });

            // Si obtuvo una zona
            if (zonaCercana) {
                Swal.fire({
                    title: '¡Alerta!',
                    text: 'Cuidado la zona de riesgo ' + zonaCercana.nombre + 'esta en un rango de ' + minDistance.toFixed(2) + 'kilometros ',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
            } else {
                Swal.fire({
                title: 'Sin riesgo',
                text: 'No se encontraron zonas de riesgo en un radio de 2 kilometros.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
            }

        }, function() {
            Swal.fire({
                title: 'Permiso de ubicación',
                text: 'No se han proporcionado permisos de ubicación.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>