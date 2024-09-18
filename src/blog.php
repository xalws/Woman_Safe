<?php
include("../db/conection.php");
// Obtener las historias del ultimo mes
$query_historias = "SELECT * FROM historias WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$result = mysqli_query($conn, $query_historias);

// Obtener los comentarios 
$query_historias = "SELECT * FROM comentarios INNER JOIN historias ON comentarios.id_historia = historias.id";
$result_comentarios = mysqli_query($conn, $query_historias);

// Total de denuncias
$query_total = 'SELECT COUNT(*) FROM historias';
$result_total = $conn->query($query_total);

// Recuperar el total 
$cantidad = $result_total->fetch_row()[0];
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
    <link rel="shortcut icon" href="../img/logo.svg" type="image/x-icon">

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
                                <input type="hidden" name="img" id="img">
                                <button type="submit" class="btn btn-custom">Agregar</button>
                            </div>
                        </div>
                    </form>

                    <?php
                    // Mostrar historias
                    $a = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Contar los comentarios por publicacion
                        $id_historia = $row['id'];

                        // Igualar el id del comentario con el de su publicacion
                        $query_comentarios = "SELECT COUNT(*) AS num_comentarios FROM comentarios WHERE id_historia = $id_historia";
                        $result_comentarios = mysqli_query($conn, $query_comentarios);
                        $row_comentarios_count = mysqli_fetch_assoc($result_comentarios);

                        // Numero de comentarios
                        $num_comentarios = $row_comentarios_count['num_comentarios'];

                        // Mostrar las historias
                        echo "<div class=\"post\">
                        <div class=\"post-header d-flex align-items-center\">
                            <img class=\"custom-img-perfil\" src=" . $row["img"] . " alt=\"Photo\">
                            <div class=\"ms-3\">
                                <h5 class=\"m-0\">" . $row["fecha"] . "</h5>
                                <small>Mujer Segura</small>
                            </div>
                        </div>";
                        echo "<p class=\"mt-3\">" . $row["historia"] . "</p>";
                        echo "<div class=\"d-flex justify-content-between\">
                        <div>
                            <!--<button class=\"btn btn-dark btn-sm\">0 👍</button>
                            <button class=\"btn btn-dark btn-sm\">+ 😄</button>-->
                        </div>
                        <small>$num_comentarios comentarios</small>
                        </div>";

                        // Mostrar comentarios
                        $query_comentarios_list = "SELECT comentario FROM comentarios WHERE id_historia = $id_historia";
                        $result_comentarios_list = mysqli_query($conn, $query_comentarios_list);
                        echo "<p>";
                        while ($row_comentarios = mysqli_fetch_assoc($result_comentarios_list)) {
                            echo $row_comentarios['comentario'] . "<br>";
                        }
                        echo "</p>";

                        // Formulario de comentario
                        echo "<form action=\"../db/insertar_comentario.php\" method=\"post\">

                        <!--Tomar el id de la publicacion-->
                            <input type=\"hidden\" id=\"id_historia\" name=\"id_historia\" value=\"" . $row['id'] . "\">
                            <input type=\"text\" for=\"comentario\" id=\"comentario\" name=\"comentario\" class=\"form-control mt-3\" placeholder=\"Escribir un comentario...\">
                            <button type=\"submit\" class=\"btn btn-secondary mt-2\">Comentar</button>
                        </form>
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
                        <p>Denuncias totales: <?php echo $cantidad ?></p>
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

                        // Elegir una imagen al azar
                        var numeroRandom = Math.floor(Math.random() * 6) + 1;
                        var image = '../img/users/foto' + numeroRandom + '.jpg';

                        // Insertar en los inputs hidden 
                        document.getElementById('img').value = image;

                        document.getElementById('lat').value = lat;
                        document.getElementById('longitude').value = longitude;

                        console.log("Enviando coordenadas: ", lat, longitude);

                        // Enviar las coordenadas al servidor usando fetch()
                        fetch("cercania.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded"
                                },
                                body: "lat=" + encodeURIComponent(lat) + "&longitude=" + encodeURIComponent(longitude)
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Error en la respuesta del servidor');
                                }
                                return response.json(); // Parsear la respuesta JSON
                            })
                            .then(data => {
                                console.log(data);
                                if (data.status === 'alert') {
                                    alert(data.message); // Mostrar la alerta con el mensaje del servidor
                                }
                            })
                            .catch(error => {
                                console.error('Error al enviar las coordenadas:', error);
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