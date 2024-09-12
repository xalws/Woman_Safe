<?php
include("conection.php");

// Extraer datos del formulario
$historia = $_POST["historia"];
$lat = $_POST['lat'];
$longitude = $_POST['longitude'];

// Zona Horaria
date_default_timezone_set('America/Chihuahua');

// Fecha y hora
$fecha = date('Y-m-d');
$hora = date('H:i:s');

// Insertar los datos 
$query = "INSERT INTO historias 
(historia, fecha, hora, lat, longitude) 
VALUES ('$historia', '$fecha', '$hora', '$lat', '$longitude')";

mysqli_query($conn, $query);

// Redireccionar
header('Location: ../src/blog.php');
exit;
?>