<?php
include("conection.php");

// Extraer datos del formulario
$historia = $_POST["historia"];
$direccion = $_POST['direccion'];
$categoria = $_POST['categoria'];
$fecha = $_POST['fecha'];

// Fecha
date_default_timezone_set('America/Chihuahua');
$fecha_denuncia = date('Y-m-d');

if(empty($historia) || empty($direccion) || empty($fecha)){
    echo "
        <script>
            alert(\"Se deben llenar todos los campos\");
            setTimeout(function() {
                window.location.href = '../src/denunciar.php';
            });
        </script>
    ";
}else{
    // Insertar los datos 
    $query = "INSERT INTO denuncias 
    (historia, direccion, categoria, fecha, fecha_denuncia) 
    VALUES ('$historia', '$direccion', '$categoria', '$fecha', '$fecha_denuncia')";

    mysqli_query($conn, $query);

    // Redireccionar
    //header('Location: ../src/denunciar.php');
    echo "
        <script>
            alert(\"Se ha enviado la denuncia. No estas sola\");
            setTimeout(function() {
                window.location.href = '../src/denunciar.php';
            });
        </script>
    ";
    exit;
}
?>