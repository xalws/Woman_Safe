<?php
include("../db/conection.php");
?>

<!doctype html>
<html lang="es">
    <head>
        <title>Blog</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <link rel="stylesheet" href="../style/blog.css">

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>
    <body class="body">
        <header>
            <nav
                class="navbar navbar-expand-lg navbar-light bg-dark fixed-top bg-custom"
            >
                <div class="container">
                    <a class="navbar-brand text-light fs-5" href="../index.html">Mujer Segura</a>
                    <button
                        class="navbar-toggler hidden-lg-up"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapsibleNavId"
                        aria-controls="collapsibleNavId"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    ></button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active text-light" href="#" aria-current="page"
                                    >Blog
                                    <span class="visually-hidden">(current)</span></a
                                >
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="instituciones.html">Instituciones</a>
                            </li>
                        </ul>
                        <form class="d-flex my-2 my-lg-0">
                            <input
                                class="form-control me-sm-2 bg-secondary"
                                type="text"
                                placeholder="Search"
                            />
                            <button
                                class="btn btn-outline-light my-2 my-sm-0 text-light"
                                type="submit"
                            >
                                Search
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>
        <main>

<section class="blog-principal">
    <div class="card mb-3 custom-blog bg-black text-white border-white" style="max-width: 540px;" >
        <div class="row g-0">
            <div class="col-md-4">
                <img
                    src="Image Source"
                    class="img-fluid rounded-start"
                    alt="Card title"
                />
            </div>
            <div class="col-md-8">
                <div class="card-body">
<div class="form-floating mb-3">
    <input
        type="text"
        class="form-control"
        name="formId1"
        id="formId1"
        placeholder=""
    />
    <label class="text-dark" for="formId1">Name</label>
</div>

                    
                    </p>
                </div>
            </div>
        </div>
    </div>
    

</section>            

        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
