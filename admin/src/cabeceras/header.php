<?php
$url_base = "http://localhost/woman_safe/admin";
?>

<!doctype html>
<html lang="es">

<head>
    <title>Admin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="/assets/img/woman.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../style/estilo.css">

</head>

<body>
    <!--Navbar-->

    <nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Administrador</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url_base; ?>/src/secciones/acoso.php">Acoso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url_base; ?>/src/secciones/amenaza.php">Amenaza</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url_base; ?>/src/secciones/domestica.php">Domestica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url_base; ?>/src/secciones/familiar.php">Familiar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url_base; ?>/src/secciones/fisica.php">Fisica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url_base; ?>/src/secciones/laboral.php">Laboral</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $url_base; ?>/src/secciones/obstetrica.php" class="nav-link">Obstetrica</a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="<?php echo $url_base; ?>/src/secciones/psicologica.php" class="nav-link">Psicologica</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $url_base; ?>/src/secciones/sexual.php" class="nav-link">Sexual</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $url_base; ?>/src/secciones/otra.php" class="nav-link">Otra</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container">