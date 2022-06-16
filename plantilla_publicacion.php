<?php
require 'database.php';

$message = '';

if (
    !empty($_POST['ubicacion']) && !empty($_POST['operacion']) && !empty($_POST['tipo']) && !empty($_POST['tamanio']) && !empty($_POST['precio']) && !empty($_POST['banios'])
    && !empty($_POST['habitaciones']) && !empty($_POST['cochera']) && !empty($_POST['comedor']) && !empty($_POST['patio']) && !empty($_POST['antiguedad'])
    && !empty($_POST['estado']) && !empty($_POST['orientacion']) && !empty($_POST['disposicion'])
) {
    $sql = "INSERT INTO Propiedades (ubicacion, operacion, tipo, tamanio, precio, banios, habitaciones, cochera, comedor, patio, antiguedad, estado, orientacion, disposicion) VALUES (:ubicacion, :operacion, :tipo, :tamanio, :precio, :banios, :habitaciones, :cochera, :comedor, :patio, :antiguedad, :estado, :orientacion, :disposicion)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ubicacion', $_POST['ubicacion']);
    $stmt->bindParam(':operacion', $_POST['operacion']);
    $stmt->bindParam(':tipo', $_POST['tipo']);
    $stmt->bindParam(':tamanio', $_POST['tamanio']);
    $stmt->bindParam(':precio', $_POST['precio']);
    $stmt->bindParam(':banios', $_POST['banios']);
    $stmt->bindParam(':habitaciones', $_POST['habitaciones']);
    $stmt->bindParam(':cochera', $_POST['cochera']);
    $stmt->bindParam(':comedor', $_POST['comedor']);
    $stmt->bindParam(':patio', $_POST['patio']);
    $stmt->bindParam(':antiguedad', $_POST['antiguedad']);
    $stmt->bindParam(':estado', $_POST['estado']);
    $stmt->bindParam(':orientacion', $_POST['orientacion']);
    $stmt->bindParam(':disposicion', $_POST['disposicion']);

    if ($stmt->execute()) {
        $message = 'Se ha creado su publicacion de manera exitosa!';
    } else {
        $message = 'Ha ocurrido un problema al crear su publicacion...';
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

    <!-- PLANTILLA DE PUBLICACION -->
    <div class="container-fluid">
        <form action="plantilla_publicacion.php" method="POST" id="formulario">

            <!-- Ubicacion -->
            <div class="titulo_prop">
                <h1 class="titulo_prop_registro">
                    <input type="text" name="ubicacion" id="ubicacion">
                </h1>
                <p class="info_propiedad_registro">
                    <input type="text" name="operacion" id="operacion"> |
                    <input type="text" name="tipo" id="tipo"> |
                    <input type="text" name="tamanio" id="tamanio">
                </p>
            </div>

            <!-- Descripcion Columna 1 -->
            <div class="descripcion_prop_registro">
                <div class="row">
                    <h3 class="precio_prop">Precio:</h3>
                    <h1><input type="text" name="precio" id="precio"></h1>

                    <h3 class="caracteristicas_prop">Características:</h3>
                    <div class="col info_1_prop">
                        <p>BAÑOS: <input type="text" name="banios" id="banios"></p>
                        <p>HABITACIONES: <input type="text" name="habitaciones" id="habitaciones"></p>
                        <p>COCHERA: <input type="text" name="cochera" id="cochera"></p>
                        <p>COMEDOR: <input type="text" name="comedor" id="comedor"></p>
                        <p>PATIO: <input type="text" name="patio" id="patio"></p>
                    </div>

                    <!-- Descripcion Columna 2 -->
                    <div class="col info_2_prop">
                        <p>ANTIGÜEDAD: <input type="text" name="antiguedad" id="antiguedad"></p>
                        <p>ESTADO: <input type="text" name="estado" id="estado"></p>
                        <p>ORIENTACION: <input type="text" name="orientacion" id="orientacion"></p>
                        <p>DISPOSICIÓN: <input type="text" name="disposicion" id="disposicion"></p>
                    </div>

                    <!-- Mapa -->
                    <h3 class="ubicacion_prop">Ubicación:</h3>
                    <div class="col mapa_buscador">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26804.48763908889!2d-68.87602867742991!3d-32.88333398014807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x967e093ec45179bf%3A0x205a78f6d20efa3a!2sMendoza%2C%20Capital%2C%20Mendoza!5e0!3m2!1ses-419!2sar!4v1652129560746!5m2!1ses-419!2sar" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                </div>
            </div>

            <!-- Mensaje PHP creacion correcta de publicacion -->
            <div class="mensaje_creacion_publicacion">
                <?php if (!empty($message)) : ?>
                    <p><?= $message ?></p>
                <?php endif; ?>
            </div>

            <!-- Boton de registro -->
            <div>
                <input class="boton_crear_publicacion" type="submit" value="PUBLICAR">
            </div>

        </form>
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

<!-- VALIDACION DE REGISTRO DE PROPIEDAD - CAMPOS VALIDOS-->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("formulario").addEventListener('submit', validarFormulario);
    });

    function validarFormulario(evento) {
        evento.preventDefault();

        var ubicacion = document.getElementById('ubicacion').value;
        if (ubicacion.length == 0) {
            alert('El campo ubicacion se encuentra vacio');
            return;
        }

        var operacion = document.getElementById('operacion').value;
        if (operacion.length == 0) {
            alert('El campo operacion se encuentra vacio');
            return;
        }

        var tipo = document.getElementById('tipo').value;
        if (tipo.length == 0) {
            alert('El campo tipo se encuentra vacio');
            return;
        }

        var tamanio = document.getElementById('tamanio').value;
        if (tamanio.length == 0) {
            alert('El campo tamanio se encuentra vacio');
            return;
        }

        var precio = document.getElementById('precio').value;
        if (precio.length == 0) {
            alert('El campo precio se encuentra vacio');
            return;
        }

        var banios = document.getElementById('banios').value;
        if (banios.length == 0) {
            alert('El campo baños se encuentra vacio');
            return;
        }

        var habitaciones = document.getElementById('habitaciones').value;
        if (habitaciones.length == 0) {
            alert('El campo habitaciones se encuentra vacio');
            return;
        }

        var cochera = document.getElementById('cochera').value;
        if (cochera.length == 0) {
            alert('El campo cochera se encuentra vacio');
            return;
        }

        var comedor = document.getElementById('comedor').value;
        if (comedor.length == 0) {
            alert('El campo comedor se encuentra vacio');
            return;
        }

        var patio = document.getElementById('patio').value;
        if (patio.length == 0) {
            alert('El campo patio se encuentra vacio');
            return;
        }

        var antiguedad = document.getElementById('antiguedad').value;
        if (antiguedad.length == 0) {
            alert('El campo antiguedad se encuentra vacio');
            return;
        }

        var estado = document.getElementById('estado').value;
        if (estado.length == 0) {
            alert('El campo estado se encuentra vacio');
            return;
        }

        var orientacion = document.getElementById('orientacion').value;
        if (orientacion.length == 0) {
            alert('El campo orientacion se encuentra vacio');
            return;
        }

        var disposicion = document.getElementById('disposicion').value;
        if (disposicion.length == 0) {
            alert('El campo disposicion se encuentra vacio');
            return;
        }

        this.submit();

    }
</script>