<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <title>Agregar Usuario</title>
</head>

<body>

    <!-- CABECERA -->
    <div class="cabecera">
        <nav class="navbar navbar-expand">
            <div class="container-fluid">
                <div class="row">
                    <!-- Logo -->
                    <div class="col logo_cabecera">
                        <a class="navbar-brand" href="pagina_admin.php"><img src="Imagenes/logo_1.png" alt="" width="300" /></a>
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
        </nav>
    </div>

    <!--AGREGAR REGISTROS DE USUARIO -->
    <?php

    require 'database.php';

    if (isset($_REQUEST['guardar'])) {
        if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            if (isset($_FILES['foto']['name'])) {
                $tipo_archivo = $_FILES['foto']['type'];
                $permitido = array("image/png", "image/jpeg", "image/jpg");

                if (in_array($tipo_archivo, $permitido) == false) {
                    die("Archivo no permitido");
                }

                $nombre_archivo = $_FILES['foto']['name'];
                $tamanio_archivo = $_FILES['foto']['size'];
                $imagen_subida = fopen($_FILES['foto']['tmp_name'], 'r');
                $binarios_img = fread($imagen_subida, $tamanio_archivo);

                include_once 'database.php';
                $conect = mysqli_connect($server, $username, $password, $database);

                $binarios_img = mysqli_escape_string($conect, $binarios_img);

                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $valor_check_1 = $_POST['mayorEdad'];
                $valor_check_2 = $_POST['aceptarCondiciones'];

                $query = "INSERT INTO Usuarios (nombre, apellido, email, password, nombreimg, imagen, tipoimg, mayorEdad, aceptarCondiciones) VALUES ('" . $nombre . "','" . $apellido . "','" . $email . "','" . $password . "','" . $nombre_archivo . "','" . $binarios_img . "','" . $tipo_archivo . "','" . $valor_check_1 . "','" . $valor_check_2 . "')";
                $result = mysqli_query($conect, $query);

                if ($result) { ?>
                    <p>Registro realizado exitosamente</p>
                <?php
                } else {
                ?>
                    Error <?php echo mysqli_error($conect); ?>
    <?php
                }
            }
        }
    }
    ?>

    <div class="container-fluid registro_usuario_admin" style="text-align: center;">

        <form action="agregar_usuario.php" method="POST" enctype="multipart/form-data">

            <!-- Nombre -->
            <div class="ingresar_nombre">
                <input class="barra_registro_usuario" type="text" name="nombre" placeholder="Nombre">
            </div>

            <!-- Apellido -->
            <div class="ingresar_apellido">
                <input class="barra_registro_usuario" type="text" name="apellido" placeholder="Apellido">
            </div>

            <!-- Mail -->
            <div class="ingresar_mail">
                <input class="barra_registro_usuario" type="text" name="email" placeholder="Mail">
            </div>

            <!-- Contraseña -->
            <div class="ingresar_contraseña">
                <input class="barra_registro_usuario" type="password" name="password" placeholder="Contraseña">
            </div>

            <!-- Mayor a 18 -->
            <div class="ingresar_contraseña">
                <p style="color: white;"><input type="checkbox" name="mayorEdad" value="Confirmado" required>Confirmo ser mayor de edad</p>
            </div>

            <!-- Aceptar terminos y condiciones -->
            <div class="ingresar_contraseña">
                <p style="color: white;"><input type="checkbox" name="aceptarCondiciones" value="Confirmado" required> Acepto terminos y condiciones del sitio.</p>
            </div>

            <!-- Foto de registro -->
            <input type="file" name="foto">

            <?php if (!empty($message)) : ?>
                <p><?= $message ?></p>
            <?php endif; ?>

            <!-- Boton de registro -->
            <div>
                <input class="boton_registrarse" type="submit" name="guardar" value="REGISTRAR">
            </div>
        </form>

    </div>

</body>

</html>