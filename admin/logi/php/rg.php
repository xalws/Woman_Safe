<!doctype html>
<html lang="en">

<head>
    <title>Admin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="../assets/logo_admin.svg" type="image/x-icon">
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>

    <div class="container">
        <form action="dt_rg.php" class="form singup" method="POST">
            <h2>Crear cuenta</h2>
            <div class="input-container">
                <input type="text" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario" class="signup-username" required>
            </div>
            <div class="input-container">
                <input type="email" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo" class="signup-username" required>
            </div>
            <div class="input-container">
                <input type="password" class="form-control" name="contraseña" id="contraseña" aria-describedby="helpId" placeholder="contraseña" class="signup-username">
            </div>
            <div class="input-container">
                <input type="submit" value="Guardar"required>
            </div>
            <p>¿Ya tienes cuenta?<a href="../login.php" class="login"> Iniciar sesion</a></p>
        </form>
    </div>

</body>

</html>