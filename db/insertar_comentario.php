<?php
include("conection.php");

// Extraer datos del formulario
$comentario = $_POST["comentario"];
$id_historia = $_POST['id_historia'];


if (empty($comentario)){
    echo "
        <script>
            alert('No se puede agregar un comentario vacio');
            setTimeout(function() {
                window.location.href = '../src/blog.php';
            });
        </script>
    ";
    exit;

}else{
    // Insertar los datos 
    $query = "INSERT INTO comentarios 
    (comentario, id_historia) 
    VALUES ('$comentario', '$id_historia')";

    mysqli_query($conn, $query);

    // Redireccionar
    header('Location: ../src/blog.php');
    exit;
}

?>