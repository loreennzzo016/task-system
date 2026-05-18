<?php
    session_start();
    include '../inc/conexion.php';

    $id = $_GET['id'];
    $usuario_id = $_SESSION['usuario']['id'];

    $sql = "DELETE FROM proyectos WHERE id = $id AND usuario_id = $usuario_id";

    if ($conexion->query($sql)) {
        $_SESSION['mensaje'] = "Proyecto eliminado";
    } else {
        $_SESSION['error'] = "Error al eliminar";
    }

    header("Location: ../vistas/proyectos.php");
    exit;
?>