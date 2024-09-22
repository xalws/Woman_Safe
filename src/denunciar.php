<?php
include("../db/conection.php");
// Obtener las denuncias del ultimo mes
$query_denuncias = "SELECT * FROM denuncias WHERE fecha_denuncia >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$result = mysqli_query($conn, $query_denuncias);

// Total de denuncias
$query_total = 'SELECT COUNT(*) FROM denuncias';
$result_total = $conn->query($query_total);

// Recuperar el total 
$cantidad = $result_total->fetch_row()[0];

// Fecha
date_default_timezone_set('America/Chihuahua');
$fecha = date('Y-m-d');

?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Denunciar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/estilo.css">
    <!-- Required meta tags  -->
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="../img/logo.svg" type="image/x-icon">
</head>

<body class="body">
    <header>
        <!-- Nabvar -->
        <nav class="navbar navbar-expand-lg bg-white sticky-top">
            <div class="container">
                <a class="navbar-brand" href="../index.php">MujerSegura</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="./mapa/mapas_denuncias.php">Mapa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../ayuda.php">Ayuda</a>

                        </li>
                    </ul>
                    <a href="#" class="btn btn-brand ms-lg-3">denunciar</a>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

        <!-- Content -->
        <div class="container mt-4">
            <div class="row">
                <!-- Agregar historia -->
                <div class="col-lg-8">
                    <form action="../db/insertar.php" method="post">
                        <div class="feed-header">
                            <div class="">
                                <p class="labels">Descripción</p>
                                <textarea type="text" for="historia" id="historia" name="historia" class="form-control" placeholder="Cuentanos tu historia"></textarea>
                                <hr>
                                <p class="labels">Dirección</p>
                                <input class="form-control" type="text" placeholder="Colonia / Calle" name="direccion">
                                <hr>
                                <p class="labels">Fecha</p>
                                <input type="date" name="fecha" id="fecha" class="form-control" max="<?php echo $fecha ?>" min="2010-01-01">
                                <hr>
                                <p class="labels">Categoría</p>
                                <select class="form-select" id="exampleSelect" name="categoria">
                                    <option value="Acoso u hostigamiento">Acoso u hostigamiento</option>
                                    <option value="Violencia psicológica">Violencia psicológica</option>
                                    <option value="Amenaza">Amenaza</option>
                                    <option value="Violencia física">Violencia física</option>
                                    <option value="Violencia doméstica">Violencia doméstica</option>
                                    <option value="Violencia sexual">Violencia sexual</option>
                                    <option value="Violencia laboral">Violencia laboral</option>
                                    <option value="Violencia obstétrica">Violencia obstétrica</option>
                                    <option value="Violencia familiar">Violencia familiar</option>
                                    <option value="Otra">Otra</option>
                                </select>
                                <br>
                                <button type="submit" class="btn btn-custom btn-add">Agregar</button>
                            </div>
                        </div>
                    </form>
                    <br>

                    <?php
                    // Mostrar denuncias
                    $a = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
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

        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</body>

</html>