<?php

session_start();

if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
}

require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM Usuarios WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['usuario_id'] = $results['id'];

        //Validacion de usuario Admin con redireccion dependiendo del tipo de usuario
        if ($_SESSION['usuario_id'] == '39') {
            header('Location: pagina_admin.php');
        } else {
            header('Location: index.php');
        }
    } else {
        $message = "Las credenciales no son validas";
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
    <title>Inicio Sesion </title>
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

    <!-- INGRESO DE USUARIO -->
    <div class="imagen_inicio_sesion_registro" style="background-image: url(Imagenes/fondo_inicio_sesion_1.jpg);">
        <div class="container-fluid ingreso_usuario" style="text-align: center;">
            <h3>Iniciar Sesión</h3>

            <form action="login.php" method="POST" id="formulario">
                <div class="ingresar_mail">
                    <input class="barra_ingreso_usuario" type="text" name="email" id="email" placeholder="Mail">
                </div>

                <div class="ingresar_contraseña">
                    <input class="barra_ingreso_usuario" type="password" name="password" id="password" placeholder="Contraseña">
                </div>

                <div>
                    <input class="boton_iniciar_sesion" type="submit" value="INICIAR SESIÓN">
                </div>
            </form>

            <div style="color: white;">
                <p>Si todavia no tiene cuenta, <a class="boton_opcion_secundaria" href="signup.php"> Registrese</a>
                </p>
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

<!-- VALIDACION DE INICIO DE SESION DE USUARIO - CAMPOS VALIDOS-->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("formulario").addEventListener('submit', validarFormulario);
    });

    function validarFormulario(evento) {
        evento.preventDefault();

        var email = document.getElementById('email').value;
        if (email.length == 0) {
            alert('El campo email se encuentra vacio');
            return;
        }

        var password = document.getElementById('password').value;
        if (password.length == 0) {
            alert('El campo contraseña se encuentra vacio')
            return;
        }

        this.submit();

    }
</script>