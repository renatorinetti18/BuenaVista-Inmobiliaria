<?php

session_start();

require 'database.php';

if (isset($_SESSION['usuario_id'])) {
    $records = $conn->prepare('SELECT * FROM Usuarios WHERE id=:id');
    $records->bindParam(':id', $_SESSION['usuario_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
}

//Consulta de datos de usuario
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
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
    <title>Admin</title>
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


    <!-- Tabla de Administrador - Gestion de Usuarios - Modificacion y eliminacion-->
    <div class="table-responsive" style="width: 90%; margin-left: 100px; margin-top: 10px;">
        <table class="display" id="mi_tabla" style="text-align: center;">
            <thead class="text-muted">
                <th class="text-center">ID</th>
                <th class="text-center">NOMBRE</th>
                <th class="text-center">APELLIDO</th>
                <th class="text-center">EMAIL</th>
                <th class="text-center">CONTRASEÑA</th>
                <th class="text-center">IMAGEN</th>
                <th class="text-center">OPCIONES</th>
            </thead>

            <tbody>
                <?php while ($row = $guardar->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['nombre'] ?></td>
                        <td><?php echo $row['apellido'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['password'] ?></td>
                        <td><img width="100" src="data:<?php echo $row['tipoimg']; ?>; base64,<?php echo base64_encode($row['imagen']); ?>"></td>

                        <!-- Modificacion y Eliminacion de registros de usuarios de la bd -->
                        <td><a href="modificar_usuario.php?id= <?php echo $row['id']; ?>" style="text-decoration: none; color: black;">EDITAR</a> -
                            <a href="eliminar_usuario.php?id= <?php echo $row['id']; ?>" style="text-decoration: none; color: black;">BORRAR</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Gestion de Usuario - Agregar Registro-->
    <div class="dropdown-divider" style="margin-top: 30px;"></div>
    <button class="boton_agregar_usuario"><a href="agregar_usuario.php" style="text-decoration: none; color: white;">AGREGAR REGISTRO</a></button>

</body>

</html>

<!-- Script de tabla de listado de publicaciones-->
<script>
    var mi_tabla = document.querySelector("#mi_tabla");
    var dataTable = new DataTable(mi_tabla, {
        perPage: 10,
        labels: {
            perPage: " ",
        },
    });
</script>