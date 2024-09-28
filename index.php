<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MujerSegura</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/estilo.css">
    <link rel="shortcut icon" href="/assets/img/woman.svg" type="image/x-icon">
</head>

<body>

    <!--Navbar-->

    <nav class="navbar bg-light fixed-top">
        <div class="container">
        <a class="navbar-brand" href="#">MujerSegura</a>
            <div class="d-flex align-items-center ms-auto">
                <!-- Agregamos un contenedor flexible -->
                <a href="./src/denunciar.php" class="btn btn-brand ms-4">Denunciar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./src/mapas_denuncias.php">Mapa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ayuda</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!--HERO-->
    <section id="hero" class="min-vh-100 d-flex flex-column justify-content-center align-items-center text-center">
        <div class="row">
            <div class="col-12">
                <h1 class="text-uppercase text-white fw-semibold display-1">MujerSegura</h1>
                <h5 class="text-white mt-3 mb-4">Esta plataforma está hecha para ayudar a las mujeres</h5>
                <div>
                    <a href="#" class="btn alert me-2">Alertar</a>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>