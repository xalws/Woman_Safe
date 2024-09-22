<?php
include("conection.php");

// Extraer datos del formulario
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$mail = $_POST['mail'];

if(empty($usuario)||empty($contrasena)||empty($mail)){
    echo"
    <script>
        alert('No se ingresaron todos los datos correctamente');
    </script>";
}else{
    // Insertar datos
    $query = "INSERT INTO usuarios (usuario, contrasena, mail)VALUES ('usuario', 'contrasena', 'mail')";

    mysqli_query($conn, $query);

    // Redireccionar
    header('Location: ../src/denunciar.php');
    exit;

}

?>