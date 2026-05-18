<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../vistas/login.php");
        exit;
    }
    $pagina_actual = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Tareas</title>
    <link rel="stylesheet" href="../css/bulma.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav class="navbar is-primary" role="navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="inicio.php">
                <strong>Sistema de Tareas</strong>
            </a>
            
            <a role="button" class="navbar-burger" id="burger" data-target="navbarMenu">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
        
        <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item <?php echo ($pagina_actual == 'inicio.php') ? 'is-active' : ''; ?>" href="inicio.php"> Inicio </a>
                <a class="navbar-item <?php echo ($pagina_actual == 'proyectos.php') ? 'is-active' : ''; ?>" href="proyectos.php"> Proyectos </a>
                <a class="navbar-item <?php echo ($pagina_actual == 'tareas.php') ? 'is-active' : ''; ?>" href="tareas.php"> Tarea </a>
                <a class="navbar-item <?php echo ($pagina_actual == 'perfil.php') ? 'is-active' : ''; ?>" href="perfil.php"> Perfil </a>
            </div>
            
            <div class="navbar-end">
                <div class="navbar-item">
                    <span class="mr-3">
                        <i class="fas fa-user-circle mr-1"></i><?php echo $_SESSION['usuario']['nombre']; ?>
                    </span>
                    <a href="../php/cerrar_sesion.php" class="button is-small is-light">
                        Salir
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <main class="container mt-5">