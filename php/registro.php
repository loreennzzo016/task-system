<?php
    session_start();
    include '../inc/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        // Verificar si el email ya existe
        $check = $conexion->query("SELECT id FROM usuarios WHERE email = '$email'");
        if ($check->num_rows > 0) {
            header("Location: ../vistas/registro.php?error=1");
            exit;
        }
        
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";
        
        if ($conexion->query($sql)) {
            header("Location: ../vistas/login.php?registro=1");
        } else {
            header("Location: ../vistas/registro.php?error=1");
        }
        exit;
    }
?>