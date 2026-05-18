<?php
    include '../inc/header.php';
    include '../inc/conexion.php';
    include '../inc/funciones.php';

    $usuario_id = $_SESSION['usuario']['id'];

    if (isset($_SESSION['mensaje'])) {
        echo '<div class="notification is-success is-light">' . $_SESSION['mensaje'] . '</div>';
        unset($_SESSION['mensaje']);
    }
    if (isset($_SESSION['error'])) {
        echo '<div class="notification is-danger is-light">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
?>

<div class="columns">
    <div class="column is-12">
        <h1 class="title">Proyectos</h1>
    </div>
</div>

<div class="columns">
    <!-- Formulario nuevo proyecto -->
    <div class="column is-4">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="fas fa-plus-circle"></i></span>
                    <span>Nuevo Proyecto</span>
                </p>
            </header>
            <div class="card-content">
                <form action="../php/agregar_proyecto.php" method="POST">
                    <div class="field">
                        <label class="label">Nombre del proyecto</label>
                        <div class="control">
                            <input class="input" type="text" name="nombre" required>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label">Descripción</label>
                        <div class="control">
                            <textarea class="textarea" name="descripcion" rows="3"></textarea>
                        </div>
                    </div>
                    
                    <div class="field is-grouped">
                        <div class="control">
                            <button type="submit" class="button is-primary">
                                <span class="icon"><i class="fas fa-save"></i></span>
                                <span>Guardar</span>
                            </button>
                        </div>
                        <div class="control">
                            <button type="reset" class="button is-light">Limpiar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Listado de proyectos -->
    <div class="column is-8">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="fas fa-list"></i></span>
                    <span>Mis Proyectos</span>
                </p>
            </header>
            <div class="card-content">
                <table class="table is-fullwidth is-striped is-hoverable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Tareas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $proyectos = obtenerProyectos($conexion, $usuario_id);
                        
                        if ($proyectos->num_rows > 0) {
                            while ($proyecto = $proyectos->fetch_assoc()) {
                                $num_tareas = contarTareasPorProyecto($conexion, $proyecto['id']);
                                ?>
                                <tr>
                                    <td><strong><?php echo $proyecto['nombre']; ?></strong></td>
                                    <td><?php echo $proyecto['descripcion'] ?: '<span class="has-text-grey-light">Sin descripción</span>'; ?></td>
                                    <td><span class="tag is-info"><?php echo $num_tareas; ?> tareas</span></td>
                                    <td>
                                        <div class="buttons are-small">
                                            <a href="tareas.php?proyecto=<?php echo $proyecto['id']; ?>" class="button is-info" title="Ver tareas">
                                                <span class="icon"><i class="fas fa-eye"></i></span>
                                            </a>
                                            <a href="../php/eliminar_proyecto.php?id=<?php echo $proyecto['id']; ?>" 
                                                class="button is-danger" 
                                                onclick="return confirm('¿Eliminar proyecto? Se eliminarán todas sus tareas')"
                                                title="Eliminar">
                                                <span class="icon"><i class="fas fa-trash"></i></span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<tr><td colspan="4" class="has-text-centered">No hay proyectos. Crea uno.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../inc/footer.php'; ?>