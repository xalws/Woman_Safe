<?php
include("../db/conection.php");

function haversine($lat1, $lon1, $lat_h, $lon_h){
    // Radio de la tierra
    $radio_tierra = 6371;

    // Grados a radianes
    $R_lat = deg2rad($lat_h - $lat1);
    $R_lon = deg2rad($lon_h - $lon1);

    // Formula haversine
    $a = sin($R_lat / 2) * sin($R_lat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat_h)) * sin($R_lon / 2) * sin($R_lon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distancia = $radio_tierra * $c;

    return $distancia;
}

if (isset($_POST['lat']) && isset($_POST['longitude'])) {
    $lat1 = $_POST['lat'];
    $lon1 = $_POST['longitude'];

    // Coordenadas extraídas de la base de datos
    $query = "SELECT lat, longitude FROM historias";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $lat_h = $row["lat"];
        $lon_h = $row["longitude"];

        $distancia = haversine($lat1, $lon1, $lat_h, $lon_h);

        if ($distancia <= 1) {
            $cerca = true;
            break;
        }
    }

    if ($cerca) {
        echo json_encode(['status' => 'alert', 'message' => 'Cuidado, estás cerca de una denuncia reciente.']);
    } else {
        echo json_encode(['status' => 'ok', 'message' => 'No hay coordenadas cercanas.']);
    }
}

?>