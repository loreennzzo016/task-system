<?php
    session_start();
    include '../inc/conexion.php';

    $id = $_GET['id'];
    $nuevo_estado = $_GET['estado'];
    $usuario_id = $_SESSION['usuario']['id'];

    $sql = "UPDATE tareas t 
            JOIN proyectos p ON t.proyecto_id = p.id 
            SET t.estado = '$nuevo_estado' 
            WHERE t.id = $id AND p.usuario_id = $usuario_id";

    if ($conexion->query($sql)) {
        $_SESSION['mensaje'] = "Estado actualizado";
    } else {
        $_SESSION['error'] = "Error al actualizar";
    }

    header("Location: ../vistas/tareas.php");
    exit;
?>