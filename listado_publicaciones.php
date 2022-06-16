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


//Consulta para traer datos propiedades
$consulta = "SELECT * FROM Propiedades";
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
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
    <title>Resultado de busqueda</title>
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


        <!-- PROPIEDADES -->
        <div class="container-fluid propiedades_busqueda">
            <h3 class="titulo_resultado_busqueda">Resultado Busqueda:</h3>

            <div class="lista_propiedad_info">
                <table class="display" id="mi_tabla">
                    <thead>
                        <th>Orden publicacion</th>
                    </thead>

                    <tbody>
                        <?php while ($row = $guardar->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td>
                                    <div class="fila_publicacion">
                                        <div class="row">
                                            <div class="col-3 imagen_prop">
                                                <p>imagen</p>
                                            </div>

                                            <div class="col info_prop_1">
                                                <div class="lista_prop_ubicacion">
                                                    <h2>$<?php echo $row['precio'] ?></h2>
                                                    <p>Ubicacion: <?php echo $row['ubicacion'] ?></p>
                                                    <p>Tamaño: <?php echo $row['tamanio'] ?></p>
                                                    <p>Baños: <?php echo $row['antiguedad'] ?></p>
                                                </div>
                                            </div>

                                            <div class="col info_prop_2">
                                                <div class="lista_prop_ubicacion">
                                                    <p>Ubicacion: <?php echo $row['habitaciones'] ?></p>
                                                    <p>Tamaño: <?php echo $row['comedor'] ?></p>
                                                    <p>Baños: <?php echo $row['cochera'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <p><a href="propiedad.php?id= <?php echo $row['id']; ?>" style="text-decoration: none; color: white; background-color: blue; margin-left: 235px; padding: 15px 10px 15px 10px;">VER PROPIEDAD</a></p>
                                    </div>
                                <?php } ?>
                                </td>
                            </tr>
                    </tbody>
                </table>
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


        <!-- PROPIEDADES -->
        <div class="container-fluid propiedades_busqueda">
            <h3 class="titulo_resultado_busqueda">Resultado Busqueda:</h3>

            <div class="lista_propiedad_info">
                <table class="display" id="mi_tabla">
                    <thead>
                        <th></th>
                    </thead>

                    <tbody>
                        <?php while ($row = $guardar->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td>
                                    <div class="fila_publicacion">
                                        <div class="row">
                                            <div class="col-3 imagen_prop">
                                                <p>imagen</p>
                                            </div>

                                            <div class="col info_prop_1">
                                                <div class="lista_prop_ubicacion">
                                                    <h2>$<?php echo $row['precio'] ?></h2>
                                                    <p>Ubicacion: <?php echo $row['ubicacion'] ?></p>
                                                    <p>Tamaño: <?php echo $row['tamanio'] ?></p>
                                                    <p>Baños: <?php echo $row['antiguedad'] ?></p>
                                                </div>
                                            </div>

                                            <div class="col info_prop_2">
                                                <div class="lista_prop_ubicacion">
                                                    <p>Ubicacion: <?php echo $row['habitaciones'] ?></p>
                                                    <p>Tamaño: <?php echo $row['comedor'] ?></p>
                                                    <p>Baños: <?php echo $row['cochera'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <p><a href="propiedad.php?id= <?php echo $row['id']; ?>" style="text-decoration: none; color: white; background-color: blue; margin-left: 235px; padding: 15px 10px 15px 10px;">VER PROPIEDAD</a></p>
                                    </div>
                                <?php } ?>
                                </td>
                            </tr>
                    </tbody>
                </table>
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

<!-- Script de tabla de listado de publicaciones-->
<script>
    var mi_tabla = document.querySelector("#mi_tabla");
    var dataTable = new DataTable(mi_tabla, {
        perPage: 5,
        labels: {
            perPage: " ",
        },
    });
</script>