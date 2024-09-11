<?php
try{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "woman_safe";

    $conn = mysqli_connect($host, $user, $pass, $db);

    // echo '
    //     <script>
    //         alert ("Coneccion realizada");
    //     </script>
    //     ';
} catch (Exception $e){
    echo'
        <script>
            alert("Error en la coneccion")
        </script>
        ';

}
?>