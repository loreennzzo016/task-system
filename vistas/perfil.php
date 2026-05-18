<?php
    include '../inc/header.php';
    include '../inc/conexion.php';

    $usuario_id = $_SESSION['usuario']['id'];
    $mensaje = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        
        $sql = "UPDATE usuarios SET nombre = '$nombre', email = '$email' WHERE id = $usuario_id";
        if ($conexion->query($sql)) {
            $_SESSION['usuario']['nombre'] = $nombre;
            $_SESSION['usuario']['email'] = $email;
            $mensaje = "Perfil actualizado correctamente";
        }
    }

    $usuario = $_SESSION['usuario'];
?>

<div class="columns is-centered">
    <div class="column is-5">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="fas fa-user-circle"></i></span>
                    <span>Mi Perfil</span>
                </p>
            </header>
            <div class="card-content">
                <?php if ($mensaje) { ?>
                    <div class="notification is-success is-light">
                        <button class="delete"></button>
                        <?php echo $mensaje; ?>
                    </div>
                <?php } ?>
                
                <form method="POST">
                    <div class="field">
                        <label class="label">Nombre</label>
                        <div class="control has-icons-left">
                            <input class="input" type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control has-icons-left">
                            <input class="input" type="email" name="email" value="<?php echo $usuario['email']; ?>" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Fecha de registro</label>
                        <div class="control">
                            <input class="input" type="text" value="<?php echo date('d/m/Y H:i', strtotime($usuario['fecha_registro'])); ?>" readonly disabled>
                        </div>
                    </div>
                    
                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-primary is-fullwidth">
                                <span class="icon"><i class="fas fa-save"></i></span>
                                <span>Actualizar Perfil</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../inc/footer.php'; ?>