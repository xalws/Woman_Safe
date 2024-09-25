<?php

include('C:\wamp64\www\Woman_Safe\db\conection.php');

$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

echo "
        <script>
            setTimeout(function() {
                window.location.href = '../../src/secciones/acoso.php';
});
        </script>
    ";
exit;
