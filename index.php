<?php
    session_start();
    if (isset($_SESSION['usuario'])) {
        header("Location: vistas/inicio.php");
    } else {
        header("Location: vistas/login.php");
    }
    exit;
?>