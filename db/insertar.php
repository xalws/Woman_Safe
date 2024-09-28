<?php
include("conection.php");

$historia = $_POST["historia"];
$id_col = $_POST['id_col'];
$categoria = $_POST['categoria'];
$fecha = $_POST['fecha'];

date_default_timezone_set('America/Chihuahua');
$fecha_denuncia = date('Y-m-d');

if(empty($historia) || empty($id_col) || empty($fecha)){
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error',
                text: 'Se deben llenar todos los campos.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../src/denunciar.php';
                }
            });
        });
    </script>
    ";
    exit;
} else {
    $query = "INSERT INTO denuncias (historia, id_col, categoria, fecha, fecha_denuncia) 
    VALUES ('$historia', '$id_col', '$categoria', '$fecha', '$fecha_denuncia')";

    if (mysqli_query($conn, $query)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Enviado',
                    text: 'Se ha enviado tu denuncia. Recuerda que no estás sola.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../src/denunciar.php';
                    }
                });
            });
        </script>
        ";
    } else {
        $error = mysqli_error($conn);
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un error al enviar la denuncia: $error',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../src/denunciar.php';
                    }
                });
            });
        </script>
        ";
    }
    exit;
}
?>
