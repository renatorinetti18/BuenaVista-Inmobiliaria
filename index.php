<?php

session_start();

require 'database.php';

if (isset($_SESSION['usuario_id'])) {
    $records = $conn->prepare('SELECT id, email, nombre, password FROM Usuarios WHERE id=:id');
    $records->bindParam(':id', $_SESSION['usuario_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
}

if (isset($_SESSION['usuario_id'])) {
    $records = $conn->prepare('SELECT * FROM Propiedades WHERE id=:id');
    $records->bindParam(':id', $_SESSION['usuario_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $prop = null;

    if (count($results) > 0) {
        $prop = $results;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <title>Inicio</title>
</head>

<body>

    <!-- EJECUTA SI EL USUARIO ESTA LOGEADO-->
    <?php if (!empty($user)) : ?>

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

                    <!-- GESTION DEL USUARIO -->
                    <!-- Menu de acceso a perfil del usuario, publicaciones, soporte y logout del usuario -->
                    <div class="dropdown">
                        <button class="dropbtn"><?= $user['nombre']; ?></button>
                        <div class="dropdown-content">
                            <a href="perfil.php">Mi Perfil</a>
                            <a href="mis_publicaciones.php">Mis Publicaciones</a>
                            <a href="soporte.html">Soporte</a>
                            <a href="logout.php">Salir</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>


        <!-- BUSCADOR -->
        <div class="container-fluid" style="text-align: center;">
            <div class="imagen_buscador" style="background-image: url(Imagenes/fondo_buscador_1.jpg);">
                <button class="boton_busqueda" type="submit"><a href="listado_publicaciones.php" style="text-decoration: none; color: white;">BUSCAR PROPIEDADES</a></button>
            </div>
        </div>


        <!-- MAPA -->
        <div class="container-fluid">
            <div class="row ubicacion">
                <!-- Titulo y texto de buscador -->
                <div class="col contenido_buscador">
                    <h2 class="titulo_buscador">Busca tu lugar de una forma mas rápida</h2>
                    <p class="parrafor_buscador">Usando nuestra herramienta tu búsqueda es mucho mas rápida y sencilla.
                        Tan solo pulsa el boton de busqueda, y ya estaras navegando por nuestro sitio
                    </p>

                    <div class="buscar_ubicacion">
                        <button class="boton_busqueda_mapa" type="submit"><a href="listado_publicaciones.php" style="text-decoration: none; color: white;">BUSCAR PROPIEDADES</a></button>
                    </div>
                </div>

                <!-- Mapa -->
                <div class="col mapa_buscador">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26804.48763908889!2d-68.87602867742991!3d-32.88333398014807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x967e093ec45179bf%3A0x205a78f6d20efa3a!2sMendoza%2C%20Capital%2C%20Mendoza!5e0!3m2!1ses-419!2sar!4v1652129560746!5m2!1ses-419!2sar" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>


        <!-- PUBLICACIONES RECIENTES -->
        <div class="container-fluid publicaciones_recientes">
            <h1 class="titulo_recientes">Publicaciones Recientes </h1>

            <div class="row propiedades">
                <div class="col propiedad_1">
                    <p style="text-align: center; padding-top: 100px; padding-bottom: 190px;">Imagen</p>
                    <div class="info_propiedad">
                        <h2>$<?= $prop['precio']; ?></h2>
                        <p><?= $prop['habitaciones']; ?> | <?= $prop['banios']; ?></p>
                        <p><?= $prop['ubicacion']; ?></p>
                    </div>

                    <button class="boton_propiedad" type="submit"><a href="propiedad.php" style="text-decoration: none; color: white;"> VER PROPIEDAD</a></button>
                </div>

                <div class="col propiedad_2">
                    <p style="text-align: center; padding-top: 100px; padding-bottom: 190px;">Imagen</p>
                    <div class="info_propiedad">
                        <h2>$<?= $prop['precio']; ?></h2>
                        <p><?= $prop['habitaciones']; ?> | <?= $prop['banios']; ?></p>
                        <p><?= $prop['ubicacion']; ?></p>
                    </div>

                    <button class="boton_propiedad" type="submit"><a href="propiedad.php" style="text-decoration: none; color: white;"> VER PROPIEDAD</a></button>
                </div>

                <div class="col propiedad_3">
                    <p style="text-align: center; padding-top: 100px; padding-bottom: 190px;">Imagen</p>
                    <div class="info_propiedad">
                        <h2>$<?= $prop['precio']; ?></h2>
                        <p><?= $prop['habitaciones']; ?> | <?= $prop['banios']; ?></p>
                        <p><?= $prop['ubicacion']; ?></p>
                    </div>

                    <button class="boton_propiedad" type="submit"><a href="propiedad.php" style="text-decoration: none; color: white;"> VER PROPIEDAD</a></button>
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


        <!-- EJECUTA SI EL USUARIO TODAVIA NO SE HA LOGEADO O INGRESA EN LA PAGINA POR PRIMERA VEZ -->
    <?php else : ?>

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

                    <!-- Barra de navegacion -->
                    <div>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link text-black" href="login.php">Ingresar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black" href="signup.php">Creá tu cuenta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black" href="soporte.html">Soporte</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>


        <!-- BUSCADOR -->
        <div class="container-fluid" style="text-align: center;">
            <div class="imagen_buscador" style="background-image: url(Imagenes/fondo_buscador_1.jpg);">

                <button class="boton_busqueda" type="submit"><a href="listado_publicaciones.php" style="text-decoration: none; color: white;">BUSCAR PROPIEDADES</a></button>

            </div>
        </div>


        <!-- MAPA -->
        <div class="container-fluid">
            <div class="row ubicacion">
                <!-- Titulo y texto de buscador -->
                <div class="col contenido_buscador">
                    <h2 class="titulo_buscador">Busca tu lugar de una forma mas rápida</h2>
                    <p class="parrafor_buscador">Usando nuestra herramienta tu búsqueda es mucho mas rápida y sencilla.
                        Tan solo pulsa el boton de busqueda, y ya estaras navegando por nuestro sitio
                    </p>

                    <div class="buscar_ubicacion">
                        <button class="boton_busqueda_mapa" type="submit"><a href="listado_publicaciones.php" style="text-decoration: none; color: white;">BUSCAR PROPIEDADES</a></button>
                    </div>
                </div>

                <!-- Mapa -->
                <div class="col mapa_buscador">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26804.48763908889!2d-68.87602867742991!3d-32.88333398014807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x967e093ec45179bf%3A0x205a78f6d20efa3a!2sMendoza%2C%20Capital%2C%20Mendoza!5e0!3m2!1ses-419!2sar!4v1652129560746!5m2!1ses-419!2sar" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        <!-- PUBLICACIONES RECIENTES -->
        <div class="container-fluid publicaciones_recientes">
            <h1 class="titulo_recientes">Publicaciones Recientes </h1>

            <div class="row propiedades">
                <div class="col propiedad_1">
                    <p style="text-align: center; padding-top: 100px; padding-bottom: 190px;">Imagen</p>
                    <div class="info_propiedad">
                        <h2>$<?= $prop['precio']; ?></h2>
                        <p><?= $prop['habitaciones']; ?> | <?= $prop['banios']; ?></p>
                        <p><?= $prop['ubicacion']; ?></p>
                    </div>

                    <button class="boton_propiedad" type="submit"><a href="propiedad.php" style="text-decoration: none; color: white;"> VER PROPIEDAD</a></button>
                </div>

                <div class="col propiedad_2">
                    <p style="text-align: center; padding-top: 100px; padding-bottom: 190px;">Imagen</p>
                    <div class="info_propiedad">
                        <h2>$<?= $prop['precio']; ?></h2>
                        <p><?= $prop['habitaciones']; ?> | <?= $prop['banios']; ?></p>
                        <p><?= $prop['ubicacion']; ?></p>
                    </div>

                    <button class="boton_propiedad" type="submit"><a href="propiedad.php" style="text-decoration: none; color: white;"> VER PROPIEDAD</a></button>
                </div>

                <div class="col propiedad_3">
                    <p style="text-align: center; padding-top: 100px; padding-bottom: 190px;">Imagen</p>
                    <div class="info_propiedad">
                        <h2>$<?= $prop['precio']; ?></h2>
                        <p><?= $prop['habitaciones']; ?> | <?= $prop['banios']; ?></p>
                        <p><?= $prop['ubicacion']; ?></p>
                    </div>

                    <button class="boton_propiedad" type="submit"><a href="propiedad.php" style="text-decoration: none; color: white;"> VER PROPIEDAD</a></button>
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

        <!-- FIN DE IF PHP -->
    <?php endif; ?>


</body>

</html>