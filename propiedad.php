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

/*
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
*/

//Consulta
$consulta = "SELECT * FROM Propiedades";
$guardar = $conn->query($consulta);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="estilos.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.5.3/dist/js/swiffy-slider.min.js" crossorigin="anonymous" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.5.3/dist/css/swiffy-slider.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Propiedad</title>
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

                    <!-- Barra de navegacion -->
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


        <!-- PROPIEDAD -->
        <?php $row = $guardar->fetch(PDO::FETCH_ASSOC); ?>

        <div class="container-fluid">

            <div class="titulo_prop">
                <h1 class="titulo_propiedad"><?php echo $row['ubicacion'] ?></h1>
                <p class="info_propiedad"><?php echo $row['operacion'] ?> | <?php echo $row['tipo'] ?> | <?php echo $row['tamanio'] ?> </p>
            </div>

            <div class="descripcion_prop">
                <div class="row">
                    <h3 class="precio_prop">Precio:</h3>
                    <h1>$<?php echo $row['precio'] ?></h1>

                    <h3 class="caracteristicas_prop">Características:</h3>
                    <div class="col info_1_prop">
                        <p>BAÑOS: <?php echo $row['banios'] ?></p>
                        <p>HABITACIONES: <?php echo $row['habitaciones'] ?></p>
                        <p>COCHERA: <?php echo $row['cochera'] ?></p>
                        <p>COMEDOR: <?php echo $row['comedor'] ?></p>
                        <p>PATIO: <?php echo $row['patio'] ?></p>
                    </div>

                    <div class="col info_2_prop">
                        <p>ANTIGÜEDAD: <?php echo $row['antiguedad'] ?></p>
                        <p>ESTADO: <?php echo $row['estado'] ?></p>
                        <p>ORIENTACION: <?php echo $row['orientacion'] ?></p>
                        <p>DISPOSICIÓN: <?php echo $row['disposicion'] ?></p>
                    </div>


                    <h3 class="contacto_prop">Contacto:</h3>
                    <p>Nombre y Apellido: <input type="text" name="nombre_usuario"></p>
                    <p>Email: <input type="email" name="mail_usuario"></p>
                    <p>Teléfono: <input type="number" name="telefono_usuario"></p>
                    <p>Red Social (No Obligatorio): <input type="text" name="social_usuario"></p>
                    <button class="boton_contacto" type="submit">ENVIAR</button>

                    <h3 class="ubicacion_prop">Ubicación:</h3>
                    <!-- Mapa -->
                    <div class="col mapa_buscador">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26804.48763908889!2d-68.87602867742991!3d-32.88333398014807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x967e093ec45179bf%3A0x205a78f6d20efa3a!2sMendoza%2C%20Capital%2C%20Mendoza!5e0!3m2!1ses-419!2sar!4v1652129560746!5m2!1ses-419!2sar" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
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


        <!-- PROPIEDAD -->
        <div class="container-fluid">

            <div class="titulo_prop">
                <h1 class="titulo_propiedad"><?= $prop['ubicacion'] ?></h1>
                <p class="info_propiedad"><?= $prop['operacion'] ?> | <?= $prop['tipo'] ?> | <?= $prop['tamanio'] ?> </p>
            </div>

            <div class="descripcion_prop">
                <div class="row">
                    <h3 class="precio_prop">Precio:</h3>
                    <h1>$<?= $prop['precio'] ?></h1>

                    <h3 class="caracteristicas_prop">Características:</h3>
                    <div class="col info_1_prop">
                        <p>BAÑOS: <?= $prop['banios'] ?></p>
                        <p>HABITACIONES: <?= $prop['habitaciones'] ?></p>
                        <p>COCHERA: <?= $prop['cochera'] ?></p>
                        <p>COMEDOR: <?= $prop['comedor'] ?></p>
                        <p>PATIO: <?= $prop['patio'] ?></p>
                    </div>

                    <div class="col info_2_prop">
                        <p>ANTIGÜEDAD: <?= $prop['antiguedad'] ?></p>
                        <p>ESTADO: <?= $prop['estado'] ?></p>
                        <p>ORIENTACION: <?= $prop['orientacion'] ?></p>
                        <p>DISPOSICIÓN: <?= $prop['disposicion'] ?></p>
                    </div>


                    <h3 class="contacto_prop">Contacto:</h3>
                    <p>Nombre y Apellido: <input type="text" name="nombre_usuario"></p>
                    <p>Email: <input type="email" name="mail_usuario"></p>
                    <p>Teléfono: <input type="number" name="telefono_usuario"></p>
                    <p>Red Social (No Obligatorio): <input type="text" name="social_usuario"></p>
                    <button class="boton_contacto" type="submit">ENVIAR</button>

                    <h3 class="ubicacion_prop">Ubicación:</h3>
                    <!-- Mapa -->
                    <div class="col mapa_buscador">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26804.48763908889!2d-68.87602867742991!3d-32.88333398014807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x967e093ec45179bf%3A0x205a78f6d20efa3a!2sMendoza%2C%20Capital%2C%20Mendoza!5e0!3m2!1ses-419!2sar!4v1652129560746!5m2!1ses-419!2sar" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
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