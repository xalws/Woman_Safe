<?php

include('C:\wamp64\www\Woman_Safe\db\conection.php');

$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

$insert = "INSERT INTO usuario(usuario, correo, contraseña)
            VALUES('$usuario', '$correo', '$contraseña')";

$ejecutar = mysqli_query($conn, $insert);
echo "
        <script>
            setTimeout(function() {
                window.location.href = '../../src/secciones/acoso.php';
});
        </script>
    ";
exit;
