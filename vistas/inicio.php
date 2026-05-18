<?php
    include '../inc/header.php';
    include '../inc/conexion.php';
    include '../inc/funciones.php';

    $usuario_id = $_SESSION['usuario']['id'];

    $pendientes = contarTareasPorEstado($conexion, $usuario_id, 'pendiente');
    $progreso = contarTareasPorEstado($conexion, $usuario_id, 'en_progreso');
    $completadas = contarTareasPorEstado($conexion, $usuario_id, 'completada');
    $total_proyectos = $conexion->query("SELECT COUNT(*) as total FROM proyectos WHERE usuario_id = $usuario_id")->fetch_assoc()['total'] ?: 0;
?>

<div class="columns">
    <div class="column is-12">
        <h1 class="title">Bienvenido, <?php echo $_SESSION['usuario']['nombre']; ?></h1>
    </div>
</div>

<div class="columns">
    <div class="column is-3">
        <div class="box">
            <p class="heading has-text-danger">Pendientes</p>
            <p class="title has-text-danger"><?php echo $pendientes; ?></p>
        </div>
    </div>
    <div class="column is-3">
        <div class="box">
            <p class="heading has-text-info">En Progreso</p>
            <p class="title has-text-info"><?php echo $progreso; ?></p>
        </div>
    </div>
    <div class="column is-3">
        <div class="box">
            <p class="heading has-text-success">Completadas</p>
            <p class="title has-text-success"><?php echo $completadas; ?></p>
        </div>
    </div>
    <div class="column is-3">
        <div class="box">
            <p class="heading has-text-warning">Proyectos</p>
            <p class="title has-text-warning"><?php echo $total_proyectos; ?></p>
        </div>
    </div>
</div>

<div class="columns">
    <div class="column is-6">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="fas fa-project-diagram"></i></span>
                    <span>Proyectos Recientes</span>
                </p>
            </header>
            <div class="card-content">
                <?php
                $proyectos = obtenerProyectos($conexion, $usuario_id);
                if ($proyectos->num_rows > 0) {
                    echo '<table class="table is-fullwidth is-striped">';
                    while ($proyecto = $proyectos->fetch_assoc()) {
                        $num_tareas = contarTareasPorProyecto($conexion, $proyecto['id']);
                        echo '<tr>';
                        echo '<td><a href="tareas.php?proyecto=' . $proyecto['id'] . '">' . $proyecto['nombre'] . '</a></td>';
                        echo '<td><span class="tag is-info is-light">' . $num_tareas . ' tareas</span></td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p>No hay proyectos. <a href="proyectos.php">Crea uno</a></p>';
                }
                ?>
            </div>
        </div>
    </div>
    
    <div class="column is-6">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="fas fa-clock"></i></span>
                    <span>Tareas Próximas a Vencer</span>
                </p>
            </header>
            <div class="card-content">
                <?php
                $sql = "SELECT t.*, p.nombre as proyecto_nombre 
                        FROM tareas t 
                        JOIN proyectos p ON t.proyecto_id = p.id 
                        WHERE t.usuario_id = $usuario_id 
                        AND t.estado != 'completada'
                        AND t.fecha_vencimiento <= DATE_ADD(CURDATE(), INTERVAL 3 DAY)
                        ORDER BY t.fecha_vencimiento ASC
                        LIMIT 5";
                $tareas_proximas = $conexion->query($sql);
                
                if ($tareas_proximas->num_rows > 0) {
                    echo '<table class="table is-fullwidth is-striped">';
                    echo '<thead><tr><th>Tarea</th><th>Proyecto</th><th>Vence</th></tr></thead>';
                    echo '<tbody>';
                    while ($tarea = $tareas_proximas->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $tarea['titulo'] . '</td>';
                        echo '<td>' . $tarea['proyecto_nombre'] . '</td>';
                        echo '<td><span class="tag is-danger is-light">' . date('d/m/Y', strtotime($tarea['fecha_vencimiento'])) . '</span></td>';
                        echo '</tr>';
                    }
                    echo '</tbody></table>';
                } else {
                    echo '<p>No hay tareas próximas a vencer</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include '../inc/footer.php'; ?>