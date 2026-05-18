<?php
    session_start();
    include '../inc/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = $conexion->query($sql);
        
        if ($resultado->num_rows == 1) {
            $usuario = $resultado->fetch_assoc();
            if (password_verify($password, $usuario['password'])) {
                $_SESSION['usuario'] = $usuario;
                header("Location: ../vistas/inicio.php");
                exit;
            }
        }
        
        header("Location: ../vistas/login.php?error=1");
        exit;
    }
?>