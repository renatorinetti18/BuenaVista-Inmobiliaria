<?php

session_start();

require 'database.php';

if (isset($_SESSION['usuario_id'])) {
    $records = $conn->prepare('SELECT id, email, nombre, password, apellido FROM Usuarios WHERE id=:id');
    $records->bindParam(':id', $_SESSION['usuario_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
}

//Consulta de datos de usuarios
$consulta = "SELECT * FROM Usuarios";
$guardar = $conn->query($consulta);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <title>Mi Perfil</title>
</head>

<body>

    <!-- CABECERA -->
    <div class="cabecera">
        <nav class="navbar navbar-expand">
            <div class="container-fluid">
                <div class="row">
                    <!-- Logo -->
                    <div class="col logo_cabecera">
                        <a class="navbar-brand" href="index.php"><img src="Imagenes/logo_1.png" alt="" width="300" /></a>
                    </div>

                    <!-- Nombre de la pagina -->
                    <div class="col">
                        <div class="primer_nombre">
                            <h1>Buena Vista</h1>
                        </div>

                        <div class="segundo_nombre">
                            <h3>Inmobiliaria</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown">
                <button class="dropbtn"><?= $user['nombre']; ?></button>
                <div class="dropdown-content">
                    <a href="perfil.php">Mi Perfil</a>
                    <a href="mis_publicaciones.php">Mis Publicaciones</a>
                    <a href="soporte.html">Soporte</a>
                    <a href="logout.php">Salir</a>
                </div>
            </div>

        </nav>
    </div>


    <!-- PERFIL DEL USUARIO-->
    <div class="imagen_perfil" style="background-image:url(Imagenes/fondo_perfil_1.jpg);">
        <div class="container-fluid datos_usuario">
            <h1>Mis Datos</h1>

            <div class="datos">
                <p>Nombre: <?= $user['nombre']; ?></p>
                <div class="dropdown-divider"></div>
                <p>Apellido: <?= $user['apellido']; ?></p>
                <div class="dropdown-divider"></div>
                <p>Email: <?= $user['email']; ?></p>
                <div class="dropdown-divider"></div>
                <p><a href="modificar_perfil.php?id= <?php echo $user['id']; ?>" style="text-decoration: none; color: white; margin-left: 280px;">EDITAR</a></p>
            </div>

        </div>
    </div>


    <!-- PIE DE PAGINA -->
    <div class="container-fluid footer">
        <div class="row">
            <!-- Logo -->
            <div class="col-1 logo_footer">
                <a class="navbar-brand" href="index.php"><img src="Imagenes/logo_1.png" alt="" width="150"></a>
            </div>

            <!-- Accesos directos -->
            <div class="col">
                <ul class="accesos_footer" style="list-style: none;">
                    <li class="acceso_directo"><a href="index.php">Busca tu propiedad acá</a></li>
                    <li class="acceso_directo"><a href="index.php">Publicaciones recientes</a></li>
                </ul>
            </div>

            <!-- Acerca de -->
            <div class="col">
                <ul class="acerca_footer" style="list-style: none;">
                    <li class="acerca_de"><a href="soporte.html">Acerca de Buena Vista</a></li>
                    <li class="acerca_de"><a href="soporte.html">Términos y Condiciones</a></li>
                    <li class="acerca_de"><a href="soporte.html">Política de Privacidad</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- COPYRIGHT -->
    <div class="container-fluid copyright">
        <p class="contenido_copyright"><a href="#">Copyright 2022 / Buena Vista - Inmobiliaria</a></p>
        <p class="contenido_copyright"><a href="soporte.html">Términos y Condiciones de Uso - Política de privacidad</a></p>
    </div>

</body>

</html>