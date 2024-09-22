<?php
include ("../admin/db.php");
try {
    $clinicas = "SELECT nombre, latitud, longitud, descripcion FROM clinics";
    $sentencia_clinicas = $conexion->prepare($clinicas);
    if ($sentencia_clinicas->execute()) {
        $data_clinicas = $sentencia_clinicas->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Maps</title>
    <link rel="shortcut icon" href="../assets/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mapas.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.css" />

</head>
<header class="hero">
    <nav class="nav container container--hero"><a href="../index.php">
            <img class="logo" src="../css/logo_medico.png" alt="Inicio"></a>
        <ul class="nav_list">
            <li class="nav_items">
                <a class="nav_link" href="../index.php">Start</a>
            </li>
            <!-- <li class="nav_items">
                <a class="nav_link" href="./chat/index_chat.php">Chatbot</a>
            </li> -->
            <li>
                <a class="nav_link" href="informate.php">Get informed</a>
            </li>
            <li>
                <a class="nav_link" href="./agenda/index.php">Appointment</a>
            </li>
        </ul>

        <img class="nav_menu" src="../css/svg/menu.svg" alt="">

    </nav>
</header>

<body>
    <div id="map_e"></div>
    <script>

        // Si no da la ubicacion
        var defaultLatitude = 44.44890332783091;
        var defaultLongitude = 26.115079163191222;

        // ubicar el mapa 
        var map_e = L.map('map_e', {
            attributionControl: true
        }).setView([defaultLatitude, defaultLongitude], 12);

        // Azulejo
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map_e);

        // Marcadores de las clínicas
        var clinicas = [
            <?php foreach ($data_clinicas as $clinica): ?>{
                    lat: <?php echo $clinica['latitud']; ?>,
                    lng: <?php echo $clinica['longitud']; ?>,
                    nombre: '<?php echo $clinica["nombre"]; ?>',
                    descripcion: '<?php echo addslashes($clinica["descripcion"]); ?>'
                },
            <?php endforeach; ?>
        ];

        clinicas.forEach(function (clinica) {
            var marker = L.marker([clinica.lat, clinica.lng]).addTo(map_e);
            var popupContent = '<b>' + clinica.nombre + '</b>';

            if (clinica.descripcion.trim() !== "") {
                popupContent += '<br><a href="' + clinica.descripcion + '">Know</a>';
            }

            marker.bindPopup(popupContent);
        });

        //Evento click en el mapa
        var popup = L.popup();
        function clickMapa(e) {
            popup
                .setLatLng(e.latlng)
                .setContent(e.latlng.toString())
                .openOn(map_e);
        }

        map_e.on('click', clickMapa);

        // Obtener la ubicación del usuario
        navigator.geolocation.getCurrentPosition(function (position) {
            // Obtener las coordenadas de latitud y longitud 
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Mostrar el marcador de la ubicación del usuario
            var latlng = L.latLng(latitude, longitude);
            L.marker(latlng).addTo(map_e)
                .bindPopup('Your location').openPopup();
            map_e.setView([latitude, longitude], 13);

            // Calcular la clínica más cercana con Haversine
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

            var minDistance = Number.MAX_VALUE;
            var clinicaCercana = null;

            clinicas.forEach(function (clinica) {
                var distance = haversineDistance(latitude, longitude, clinica.lat, clinica.lng);
                if (distance < minDistance) {
                    minDistance = distance;
                    clinicaCercana = clinica;
                }
            });


            // Si obtuvo una clinica
            if (clinicaCercana) {
                alert('The closest clinic is: ' + clinicaCercana.nombre + ' at a range of ' + minDistance.toFixed(2) + ' kilometres.');
                // Dibujar la ruta hacia la clínica más cercana
                L.Routing.control({
                    waypoints: [
                        L.latLng(latitude, longitude),
                        L.latLng(clinicaCercana.lat, clinicaCercana.lng)
                    ],
                    routeWhileDragging: true,
                    lineOptions: {
                        styles: [{ color: '#38619e', opacity: 0.8, weight: 5 }]
                    }
                }).addTo(map_e);
            } else {
                alert('Could not find the nearest clinic.');
            }
        }, function () {
            alert('User location is not available.');
        });

    </script>
    <script src="../js/menu.js"></script>
    <script type="text/javascript">
        (function (d, t) {
            var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
            v.onload = function () {
                window.voiceflow.chat.load({
                    verify: { projectID: '6616f7d8dc5c62d0e6ea926d' },
                    url: 'https://general-runtime.voiceflow.com',
                    versionID: 'production'
                });
            }
            v.src = "https://cdn.voiceflow.com/widget/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
        })(document, 'script');
    </script>
</body>

</html>