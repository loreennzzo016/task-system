<?php
    session_start();
    include '../inc/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $usuario_id = $_SESSION['usuario']['id'];
        
        $sql = "INSERT INTO proyectos (nombre, descripcion, usuario_id) VALUES ('$nombre', '$descripcion', '$usuario_id')";
        
        if ($conexion->query($sql)) {
            $_SESSION['mensaje'] = "Proyecto creado correctamente";
        } else {
            $_SESSION['error'] = "Error al crear proyecto";
        }
        
        header("Location: ../vistas/proyectos.php");
        exit;
    }
?>