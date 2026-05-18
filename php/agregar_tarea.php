<?php
    session_start();
    include '../inc/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $proyecto_id = $_POST['proyecto_id'];
        $prioridad = $_POST['prioridad'];
        $fecha_vencimiento = $_POST['fecha_vencimiento'] ?: null;
        $usuario_id = $_SESSION['usuario']['id'];
        $estado = 'pendiente';
        
        if ($fecha_vencimiento) {
            $sql = "INSERT INTO tareas (titulo, descripcion, proyecto_id, prioridad, fecha_vencimiento, usuario_id, estado) 
                    VALUES ('$titulo', '$descripcion', '$proyecto_id', '$prioridad', '$fecha_vencimiento', '$usuario_id', '$estado')";
        } else {
            $sql = "INSERT INTO tareas (titulo, descripcion, proyecto_id, prioridad, usuario_id, estado) 
                    VALUES ('$titulo', '$descripcion', '$proyecto_id', '$prioridad', '$usuario_id', '$estado')";
        }
        
        if ($conexion->query($sql)) {
            $_SESSION['mensaje'] = "Tarea creada correctamente";
        } else {
            $_SESSION['error'] = "Error al crear tarea";
        }
        
        header("Location: ../vistas/tareas.php");
        exit;
    }
?>