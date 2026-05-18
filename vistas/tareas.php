<?php
    include '../inc/header.php';
    include '../inc/conexion.php';
    include '../inc/funciones.php';

    $usuario_id = $_SESSION['usuario']['id'];
    $proyecto_filtro = isset($_GET['proyecto']) ? (int)$_GET['proyecto'] : 0;
    $estado_filtro = isset($_GET['estado']) ? $_GET['estado'] : '';

    if (isset($_SESSION['mensaje'])) {
        echo '<div class="notification is-success is-light">' . $_SESSION['mensaje'] . '</div>';
        unset($_SESSION['mensaje']);
    }
    if (isset($_SESSION['error'])) {
        echo '<div class="notification is-danger is-light">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }

    // Obtener proyectos para filtros
    $proyectos = $conexion->query("SELECT * FROM proyectos WHERE usuario_id = $usuario_id ORDER BY nombre");
?>

<div class="columns">
    <div class="column is-12">
        <h1 class="title">Tareas</h1>
    </div>
</div>

<!-- Filtros -->
<div class="card mb-4">
    <header class="card-header">
        <p class="card-header-title">
            <span class="icon"><i class="fas fa-filter"></i></span>
            <span>Filtros</span>
        </p>
    </header>
    <div class="card-content">
        <form method="GET" class="columns is-multiline">
            <div class="column is-4">
                <div class="field">
                    <label class="label">Proyecto</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="proyecto">
                                <option value="0">Todos los proyectos</option>
                                <?php
                                $proyectos_filtro = $conexion->query("SELECT * FROM proyectos WHERE usuario_id = $usuario_id ORDER BY nombre");
                                while ($p = $proyectos_filtro->fetch_assoc()) {
                                    $selected = ($p['id'] == $proyecto_filtro) ? 'selected' : '';
                                    echo "<option value='{$p['id']}' $selected>{$p['nombre']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-4">
                <div class="field">
                    <label class="label">Estado</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="estado">
                                <option value="">Todos los estados</option>
                                <option value="pendiente" <?php echo $estado_filtro == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                <option value="en_progreso" <?php echo $estado_filtro == 'en_progreso' ? 'selected' : ''; ?>>En Progreso</option>
                                <option value="completada" <?php echo $estado_filtro == 'completada' ? 'selected' : ''; ?>>Completada</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-4 is-flex is-align-items-flex-end">
                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-primary">
                            <span class="icon"><i class="fas fa-search"></i></span>
                            <span>Filtrar</span>
                        </button>
                    </div>
                    <div class="control">
                        <a href="tareas.php" class="button is-light">Limpiar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="columns">
    <!-- Formulario nueva tarea -->
    <div class="column is-4">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="fas fa-plus-circle"></i></span>
                    <span>Nueva Tarea</span>
                </p>
            </header>
            <div class="card-content">
                <form action="../php/agregar_tarea.php" method="POST">
                    <div class="field">
                        <label class="label">Título</label>
                        <div class="control">
                            <input class="input" type="text" name="titulo" required>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Descripción</label>
                        <div class="control">
                            <textarea class="textarea" name="descripcion" rows="2"></textarea>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Proyecto</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="proyecto_id" required>
                                    <option value="">Seleccionar proyecto</option>
                                    <?php
                                    $proyectos_select = $conexion->query("SELECT * FROM proyectos WHERE usuario_id = $usuario_id ORDER BY nombre");
                                    while ($p = $proyectos_select->fetch_assoc()) {
                                        $selected = ($p['id'] == $proyecto_filtro) ? 'selected' : '';
                                        echo "<option value='{$p['id']}' $selected>{$p['nombre']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Prioridad</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="prioridad">
                                    <option value="baja">Baja</option>
                                    <option value="media" selected>Media</option>
                                    <option value="alta">Alta</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Fecha de vencimiento</label>
                        <div class="control">
                            <input class="input" type="date" name="fecha_vencimiento">
                        </div>
                    </div>
                    
                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-primary is-fullwidth">
                                <span class="icon"><i class="fas fa-save"></i></span>
                                <span>Guardar Tarea</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Listado de tareas -->
    <div class="column is-8">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="fas fa-list"></i></span>
                    <span>Mis Tareas</span>
                </p>
            </header>
            <div class="card-content">
                <table class="table is-fullwidth is-striped is-hoverable">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Proyecto</th>
                            <th>Prioridad</th>
                            <th>Estado</th>
                            <th>Vence</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tareas = obtenerTareas($conexion, $usuario_id, $proyecto_filtro, $estado_filtro);
                        
                        if ($tareas->num_rows > 0) {
                            while ($tarea = $tareas->fetch_assoc()) {
                                $prioridad_class = $tarea['prioridad'] == 'alta' ? 'is-danger' : ($tarea['prioridad'] == 'media' ? 'is-warning' : 'is-success');
                                $estado_class = $tarea['estado'] == 'pendiente' ? 'is-warning' : ($tarea['estado'] == 'en_progreso' ? 'is-info' : 'is-success');
                                ?>
                                <tr>
                                    <td>
                                        <strong><?php echo $tarea['titulo']; ?></strong><br>
                                        <small class="has-text-grey"><?php echo substr($tarea['descripcion'] ?: '', 0, 50); ?></small>
                                    </td>
                                    <td><?php echo $tarea['proyecto_nombre']; ?></td>
                                    <td><span class="tag <?php echo $prioridad_class; ?>"><?php echo ucfirst($tarea['prioridad']); ?></span></td>
                                    <td><span class="tag <?php echo $estado_class; ?>"><?php echo ucfirst($tarea['estado']); ?></span></td>
                                    <td><?php echo $tarea['fecha_vencimiento'] ? date('d/m/Y', strtotime($tarea['fecha_vencimiento'])) : '-'; ?></td>
                                    <td>
                                        <div class="buttons are-small">
                                            <a href="editar_tarea.php?id=<?php echo $tarea['id']; ?>" class="button is-info" title="Editar">
                                                <span class="icon"><i class="fas fa-edit"></i></span>
                                            </a>
                                            <?php if ($tarea['estado'] != 'completada') { ?>
                                                <a href="../php/cambiar_estado_tarea.php?id=<?php echo $tarea['id']; ?>&estado=completada" class="button is-success" title="Completar">
                                                    <span class="icon"><i class="fas fa-check"></i></span>
                                                </a>
                                            <?php } ?>
                                            <a href="../php/eliminar_tarea.php?id=<?php echo $tarea['id']; ?>" 
                                                class="button is-danger" 
                                                onclick="return confirm('¿Eliminar tarea?')"
                                                title="Eliminar">
                                                <span class="icon"><i class="fas fa-trash"></i></span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<tr><td colspan="6" class="has-text-centered">No hay tareas</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../inc/footer.php'; ?>