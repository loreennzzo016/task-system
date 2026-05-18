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
    <title>Login - Sistema de Tareas</title>
    <link rel="stylesheet" href="../css/bulma.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-4">
                        <div class="box">
                            <h1 class="title has-text-centered">
                                <i class="fas fa-tasks mr-2"></i>Sistema de Tareas
                            </h1>
                            
                            <?php if (isset($_GET['error'])) { ?>
                                <div class="notification is-danger is-light">
                                    <button class="delete"></button>
                                    Credenciales incorrectas
                                </div>
                            <?php } ?>
                            
                            <?php if (isset($_GET['registro'])) { ?>
                                <div class="notification is-success is-light">
                                    <button class="delete"></button>
                                    Registro exitoso. Inicia sesión
                                </div>
                            <?php } ?>
                            
                            <form action="../php/login.php" method="POST">
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
                                    <div class="control">
                                        <button type="submit" class="button is-primary is-fullwidth">
                                            Ingresar
                                        </button>
                                    </div>
                                </div>
                            </form>
                            
                            <div class="has-text-centered mt-4">
                                <a href="registro.php">¿No tienes cuenta? Regístrate</a>
                            </div>
                            
                            <div class="has-text-centered mt-3 is-size-7 has-text-grey">
                                <p>Usuario demo: demo@email.com / 123456</p>
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