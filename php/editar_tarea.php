<?php
    session_start();
    include '../inc/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $proyecto_id = $_POST['proyecto_id'];
        $prioridad = $_POST['prioridad'];
        $estado = $_POST['estado'];
        $fecha_vencimiento = $_POST['fecha_vencimiento'] ?: null;
        $usuario_id = $_SESSION['usuario']['id'];
        
        if ($fecha_vencimiento) {
            $sql = "UPDATE tareas t 
                    JOIN proyectos p ON t.proyecto_id = p.id 
                    SET t.titulo = '$titulo', 
                        t.descripcion = '$descripcion', 
                        t.proyecto_id = '$proyecto_id',
                        t.prioridad = '$prioridad', 
                        t.estado = '$estado', 
                        t.fecha_vencimiento = '$fecha_vencimiento'
                    WHERE t.id = $id AND p.usuario_id = $usuario_id";
        } else {
            $sql = "UPDATE tareas t 
                    JOIN proyectos p ON t.proyecto_id = p.id 
                    SET t.titulo = '$titulo', 
                        t.descripcion = '$descripcion', 
                        t.proyecto_id = '$proyecto_id',
                        t.prioridad = '$prioridad', 
                        t.estado = '$estado', 
                        t.fecha_vencimiento = NULL
                    WHERE t.id = $id AND p.usuario_id = $usuario_id";
        }
        
        if ($conexion->query($sql)) {
            $_SESSION['mensaje'] = "Tarea actualizada correctamente";
        } else {
            $_SESSION['error'] = "Error al actualizar tarea";
        }
        
        header("Location: ../vistas/tareas.php");
        exit;
    }
?>