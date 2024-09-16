<?php
include("conection.php");

// Extraer datos del formulario
$historia = $_POST["historia"];
$lat = $_POST['lat'];
$longitude = $_POST['longitude'];
$img = $_POST['img'];

// Zona Horaria
date_default_timezone_set('America/Chihuahua');

// Fecha y hora
$fecha = date('Y-m-d');
$hora = date('H:i:s');

if(empty($historia)){
    echo "
        <script>
            alert(\"No se puede insertar una historia vacia\");
            setTimeout(function() {
                window.location.href = '../src/blog.php';
            });
        </script>
    ";
}else{
    // Insertar los datos 
    $query = "INSERT INTO historias 
    (historia, fecha, hora, lat, longitude, img) 
    VALUES ('$historia', '$fecha', '$hora', '$lat', '$longitude', '$img')";

    mysqli_query($conn, $query);

    // Redireccionar
    header('Location: ../src/blog.php');
    exit;
}
?>