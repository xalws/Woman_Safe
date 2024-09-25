<!doctype html>
<html lang="en">

<head>
    <title>Admin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="../assets/logo_admin.svg" type="image/x-icon">
    <link rel="stylesheet" href="./css/estilo.css">
</head>

<body>

    <div class="container">
        <form action="./php/iniciar.php" class="form singup" method="post">
            <h2>Login</h2>
            <div class="input-container">
                <input type="text" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario" class="signup-username" required>
            </div>
            <div class="input-container">
                <input type="password" class="form-control" name="contraseña" id="contraseña" aria-describedby="helpId" placeholder="contraseña" class="signup-username" required>
            </div>
            <div class="input-container">
                <input type="submit" value="Iniciar">
            </div>
            <p>¿No tienes una cuenta?<a href="./php/rg.php" class="login"> Crear una cuenta</a></p>
        </form>
    </div>

</body>

</html>