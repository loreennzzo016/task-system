<?php
    session_start();
    if (isset($_SESSION['usuario'])) {
        header("Location: inicio.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Sistema de Tareas</title>
    <link rel="stylesheet" href="../css/bulma.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-5">
                        <div class="box">
                            <h1 class="title has-text-centered">
                                <i class="fas fa-user-plus mr-2"></i>Registro de Usuario
                            </h1>
                            
                            <?php if (isset($_GET['error'])) { ?>
                                <div class="notification is-danger is-light">
                                    <button class="delete"></button>
                                    El email ya está registrado
                                </div>
                            <?php } ?>
                            
                            <form action="../php/registro.php" method="POST">
                                <div class="field">
                                    <label class="label">Nombre completo</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" name="nombre" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="field">
                                    <label class="label">Email</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="email" name="email" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="field">
                                    <label class="label">Password</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="password" name="password" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="field">
                                    <label class="label">Confirmar Password</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="password" name="confirm_password" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="field">
                                    <div class="control">
                                        <button type="submit" class="button is-primary is-fullwidth">
                                            Registrarse
                                        </button>
                                    </div>
                                </div>
                            </form>
                            
                            <div class="has-text-centered mt-4">
                                <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.notification .delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.parentElement.style.display = 'none';
                });
            });
        });
    </script>
</body>
</html>