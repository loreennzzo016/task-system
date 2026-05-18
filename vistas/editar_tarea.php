<?php
    include '../inc/header.php';
    include '../inc/conexion.php';

    $id = (int)$_GET['id'];
    $usuario_id = $_SESSION['usuario']['id'];

    // Obtener tarea verificando que pertenece al usuario
    $sql = "SELECT t.* FROM tareas t 
            JOIN proyectos p ON t.proyecto_id = p.id 
            WHERE t.id = $id AND p.usuario_id = $usuario_id";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 0) {
        header("Location: tareas.php");
        exit;
    }

    $tarea = $resultado->fetch_assoc();
    $proyectos = $conexion->query("SELECT * FROM proyectos WHERE usuario_id = $usuario_id ORDER BY nombre");
?>

<div class="columns is-centered">
    <div class="column is-6">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="fas fa-edit"></i></span>
                    <span>Editar Tarea</span>
                </p>
            </header>
            <div class="card-content">
                <form action="../php/editar_tarea.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $tarea['id']; ?>">
                    
                    <div class="field">
                        <label class="label">Título</label>
                        <div class="control">
                            <input class="input" type="text" name="titulo" value="<?php echo $tarea['titulo']; ?>" required>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Descripción</label>
                        <div class="control">
                            <textarea class="textarea" name="descripcion" rows="3"><?php echo $tarea['descripcion']; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Proyecto</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="proyecto_id" required>
                                    <?php while ($p = $proyectos->fetch_assoc()) { ?>
                                        <option value="<?php echo $p['id']; ?>" <?php echo ($p['id'] == $tarea['proyecto_id']) ? 'selected' : ''; ?>>
                                            <?php echo $p['nombre']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Prioridad</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="prioridad">
                                    <option value="baja" <?php echo ($tarea['prioridad'] == 'baja') ? 'selected' : ''; ?>>Baja</option>
                                    <option value="media" <?php echo ($tarea['prioridad'] == 'media') ? 'selected' : ''; ?>>Media</option>
                                    <option value="alta" <?php echo ($tarea['prioridad'] == 'alta') ? 'selected' : ''; ?>>Alta</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Estado</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="estado">
                                    <option value="pendiente" <?php echo ($tarea['estado'] == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                                    <option value="en_progreso" <?php echo ($tarea['estado'] == 'en_progreso') ? 'selected' : ''; ?>>En Progreso</option>
                                    <option value="completada" <?php echo ($tarea['estado'] == 'completada') ? 'selected' : ''; ?>>Completada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Fecha de vencimiento</label>
                        <div class="control">
                            <input class="input" type="date" name="fecha_vencimiento" value="<?php echo $tarea['fecha_vencimiento']; ?>">
                        </div>
                    </div>
                    
                    <div class="field is-grouped">
                        <div class="control">
                            <button type="submit" class="button is-primary">
                                <span class="icon"><i class="fas fa-save"></i></span>
                                <span>Actualizar</span>
                            </button>
                        </div>
                        <div class="control">
                            <a href="tareas.php" class="button is-light">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../inc/footer.php'; ?>