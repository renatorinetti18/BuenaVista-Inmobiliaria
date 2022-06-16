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

$id = $_GET['id'];
$modificar = "SELECT * FROM Usuarios WHERE id = '$id'";
$modificar = $conn->query($modificar);
$dato = $modificar->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['modificar'])) {
    //Recupera los datos ingresados en la modificacion
    $id = $_POST['id'];
    $nombre = $_POST['m_nombre'];
    $apellido = $_POST['m_apellido'];
    $email = $_POST['m_email'];

    //Consulta para la modificacion de datos 
    $mod = "UPDATE Usuarios SET nombre = '$nombre', apellido = '$apellido', email = '$email' WHERE id = '$id'";
    $actualizar = $conn->query($mod);
    header('Location: pagina_admin.php');
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
    <title>Modificacion de Registro - Usuario</title>
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

                <!-- GESTION DEL USUARIO -->
                <!-- Menu de acceso a perfil del usuario, publicaciones, soporte y logout del usuario -->
                <div class="dropdown">
                    <button class="dropbtn"><?= $user['nombre']; ?></button>
                    <div class="dropdown-content">
                        <a href="logout.php">Salir</a>
                    </div>
                </div>

            </div>
        </nav>
    </div>

    <!--MODIFICACION DE DATOS DE REGISTROS DE USUARIO -->
    <h1 class="titulo_modificacion_datos">Modificacion de datos</h1>

    <div class="modificacion_datos_registro">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input class="input_mod_datos" type="hidden" name="id" value="<?php echo $dato['id'] ?>">
            <input class="input_mod_datos" type="text" name="m_nombre" value="<?php echo $dato['nombre'] ?>" placeholder="Nombre..." required>
            <input class="input_mod_datos" type="text" name="m_apellido" value="<?php echo $dato['apellido'] ?>" placeholder="Apellido..." required>
            <input class="input_mod_datos" type="text" name="m_email" value="<?php echo $dato['email'] ?>" placeholder="Email..." required>
            <input class="boton_mod_datos" type="submit" name="modificar" value="MODIFICAR">
        </form>
    </div>

</body>

</html>