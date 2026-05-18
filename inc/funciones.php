<?php
    function contarTareasPorEstado($conexion, $usuario_id, $estado) {
        $sql = "SELECT COUNT(*) as total FROM tareas WHERE usuario_id = $usuario_id AND estado = '$estado'";
        $resultado = $conexion->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    }

    function contarTareasPorProyecto($conexion, $proyecto_id) {
        $sql = "SELECT COUNT(*) as total FROM tareas WHERE proyecto_id = $proyecto_id";
        $resultado = $conexion->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    }

    function obtenerProyectos($conexion, $usuario_id) {
        $sql = "SELECT * FROM proyectos WHERE usuario_id = $usuario_id ORDER BY fecha_creacion DESC";
        return $conexion->query($sql);
    }

    function obtenerTareas($conexion, $usuario_id, $proyecto_id = null, $estado = null) {
        $sql = "SELECT t.*, p.nombre as proyecto_nombre 
                FROM tareas t 
                JOIN proyectos p ON t.proyecto_id = p.id 
                WHERE t.usuario_id = $usuario_id";
        
        if ($proyecto_id) {
            $sql .= " AND t.proyecto_id = $proyecto_id";
        }
        if ($estado) {
            $sql .= " AND t.estado = '$estado'";
        }
        $sql .= " ORDER BY 
                CASE t.prioridad 
                    WHEN 'alta' THEN 1 
                    WHEN 'media' THEN 2 
                    WHEN 'baja' THEN 3 
                END, t.fecha_vencimiento ASC";
        
        return $conexion->query($sql);
    }
?>