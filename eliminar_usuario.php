<?php 
    require 'database.php';

    //Recupera la id de la tabla, es decir, la id del usuario a eliminar
    $id = $_GET['id'];
    $borrar_registro = "DELETE FROM Usuarios WHERE id = '$id'";
    $eliminar = $conn->query($borrar_registro);
    header('Location: pagina_admin.php');
