<?php
    session_start();
    include '../inc/conexion.php';

    $id = $_GET['id'];
    $usuario_id = $_SESSION['usuario']['id'];

    $sql = "DELETE t FROM tareas t 
            JOIN proyectos p ON t.proyecto_id = p.id 
            WHERE t.id = $id AND p.usuario_id = $usuario_id";

    if ($conexion->query($sql)) {
        $_SESSION['mensaje'] = "Tarea eliminada";
    } else {
        $_SESSION['error'] = "Error al eliminar";
    }

    header("Location: ../vistas/tareas.php");
    exit;
?>