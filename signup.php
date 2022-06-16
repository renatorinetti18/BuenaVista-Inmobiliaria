<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <title>Registro</title>
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
        </nav>
    </div>

    <!-- REGISTRO DE USUARIO -->
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

    <div class="imagen_inicio_sesion_registro" style="background-image: url(Imagenes/fondo_inicio_sesion_1.jpg);">
        <div class="container-fluid registro_usuario" style="text-align: center;">

            <h3>Registrate</h3>

            <form action="signup.php" method="POST" enctype="multipart/form-data" id="formulario">

                <?php if (!empty($message)) : ?>
                    <p><?= $message ?></p>
                <?php endif; ?>

                <!-- Nombre -->
                <div class="ingresar_nombre">
                    <input class="barra_registro_usuario" type="text" name="nombre" id="nombre" placeholder="Nombre">
                </div>

                <!-- Apellido -->
                <div class="ingresar_apellido">
                    <input class="barra_registro_usuario" type="text" name="apellido" id="apellido" placeholder="Apellido">
                </div>

                <!-- Mail -->
                <div class="ingresar_mail">
                    <input class="barra_registro_usuario" type="text" name="email" id="email" placeholder="Mail">
                </div>

                <!-- Contraseña -->
                <div class="ingresar_contraseña">
                    <input class="barra_registro_usuario" type="password" name="password" id="password" placeholder="Contraseña">
                </div>

                <!-- Foto de registro -->
                <div class="foto_perfil_registro">
                    <p>FOTO DE PERFIL: <input type="file" name="foto"></p>
                </div>

                <div class="dropdown-divider"></div>

                <!-- Mayor a 18 -->
                <div class="ingresar_contraseña">
                    <p style="color: white;"><input type="checkbox" name="mayorEdad" id="mayorEdad" value="Confirmado" required>Confirmo ser mayor de edad</p>
                </div>

                <!-- Aceptar terminos y condiciones -->
                <div class="ingresar_contraseña">
                    <p style="color: white;"><input type="checkbox" name="aceptarCondiciones" id="aceptarCondiciones" value="Confirmado" required> Acepto terminos y condiciones del sitio.</p>
                </div>

                <!-- Boton de registro -->
                <div>
                    <input class="boton_registrarse" type="submit" name="guardar" value="REGISTRATE">
                </div>

                <div style="color: white;">
                    <p>Si ya tienes cuenta, <a class="boton_opcion_secundaria" href="login.php"> Inicia Sesión</a>
                    </p>
                </div>

            </form>
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


<!-- VALIDACION DE REGISTRO DE USUARIO - CAMPOS VALIDOS-->
<!--
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("formulario").addEventListener('submit', validarFormulario);
    });

    function validarFormulario(evento) {
        evento.preventDefault();

        var nombre = document.getElementById('nombre').value;
        if (nombre.length == 0) {
            alert('El campo nombre se encuentra vacio');
            return;
        }

        var apellido = document.getElementById('apellido').value;
        if (apellido.length == 0) {
            alert('El campo apellido se encuentra vacio');
            return;
        }

        var email = document.getElementById('email').value;
        if (email.length == 0) {
            alert('El campo email se encuentra vacio');
            return;
        }

        var password = document.getElementById('password').value;
        if (password.length < 5) {
            alert('Clave no valida. Debe contener al menos 5 caracteres')
            return;
        }

        this.submit();

    }
</script>
-->