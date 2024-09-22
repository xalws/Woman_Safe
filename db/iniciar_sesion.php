<?php
include('conection.php');

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

if (empty($usuario)||empty($contrasena)){
    echo"
    <script>
        alert('No se ingresaron todos los datos correctamente');
    </script>
    ";
}else{
    $query = "SELECT usuario, contrasena FROM usuarios";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)){
        $usuario_d = $row['usuario'];
        $contrasena_d = $row['contrasena'];

        if ($usuario_d == $usuario and $contrasena_d == $contrasena){
            // Redireccionar
            header('Location: ../src/denunciar.php');
            exit;
        }else{
            echo"
                <script>
                    alert('Los datos no son correctos, vuelve a intentarlo');
                </script>
            ";
        }
    }
}

?>