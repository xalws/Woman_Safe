<?php
include("../db/conection.php");
#  include("../src/cercania.php");
// Obtener las historias del ultimo mes
$query = "SELECT * FROM historias WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$result = mysqli_query($conn, $query);

?>

<!doctype html>
<html lang="es">

<head>
    <title>Blog</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="../style/blog.css">
    <link rel="shortcut icon" href="../img/perfil.jpg" type="image/x-icon">

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
</head>

<body class="body">
    <header>
        <!-- Nabvar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="../index.html">Mujer Segura</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Denuncias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="instituciones.php">Instituciones</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="container mt-4">
            <div class="row">
                <!-- Agregar historia -->
                <div class="col-lg-8">
                    <form action="../db/insertar.php" method="post">
                        <div class="feed-header">
                            <div class="d-flex">
                                <textarea type="text" for="historia" id="historia" name="historia" class="form-control" placeholder="Cuentanos tu historia..."></textarea>
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="longitude" id="longitude">
                                <button type="submit" class="btn btn-custom">Agregar</button>
                            </div>
                        </div>
                    </form>

                    <?php
                    // Mostrar historias
                    $a = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class=\"post\">
                        <div class=\"post-header d-flex align-items-center\">
                            <!--<img class=\"custom-img-perfil\" src=\"../img/perfil.jpg\" alt=\"User profile\">-->
                            <div class=\"ms-3\">
                                <h5 class=\"m-0\">" . $row["fecha"] . "</h5>
                                <small>ayer · Mujer Segura</small>
                            </div>
                        </div>";
                        echo "<p class=\"mt-3\">" . $row["historia"] . "</p>";
                        echo "<div class=\"d-flex justify-content-between\">
                            <div>
                                <button class=\"btn btn-dark btn-sm\">0 👍</button>
                                <button class=\"btn btn-dark btn-sm\">+ 😄</button>
                            </div>
                            <small>0 comentarios</small>
                        </div>
                        <input type=\"text\" class=\"form-control mt-3\" placeholder=\"Escribir un comentario...\">
                    </div>
                    
                    <br>";
                        $a = $a + 1;
                    }
                    ?>
                </div>

                <!-- Estadisticas -->
                <div class="col-lg-4">
                    <div class="stats-section">
                        <h5>Estadísticas</h5>
                        <p>Denuncias recibidas este mes: <?php echo $a; ?></p>
                        <p>Denuncias en seguimiento: 80</p>
                    </div>


                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // El navegador puede extraer la ubicacion
                if (navigator.geolocation) {
                    // Coordenadas
                    navigator.geolocation.getCurrentPosition(function(position) {
                        // latitud y longitud
                        var lat = position.coords.latitude;
                        var longitude = position.coords.longitude;

                        console.log("Latitud:", lat, "Longitud:", longitude);


                        // Insertar en los inputs hidden
                        document.getElementById('lat').value = lat;
                        document.getElementById('longitude').value = longitude;

                        console.log("Enviando coordenadas: ", lat, longitude);

                        // Enviar las coordenadas al servidor usando fetch()
                        fetch("cercania.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded"
                                },
                                body: "lat=" + lat + "&longitude=" + longitude

                            })
                            .then(response => response.text())
                            .then(data => {
                                console.log(data);
                            })
                            .catch(error => {
                                console.error("Error:", error);
                            });

                    }, function(error) {
                        alert('Error al obtener la ubicacion' + error);
                    });
                } else {
                    alert('El navegador no es compatible para obtener la ubicacion');
                }
            });

        </script>

        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</body>

</html>