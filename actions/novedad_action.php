<?php
// C:\xampp\htdocs\securigestion\actions\novedad_action.php

session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

// 1. Verificar que el usuario haya iniciado sesión
if (!is_logged_in()) {
    header('Location: ../index.php');
    exit();
}

// 2. Asegurarse de que los datos se envíen por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 3. Recoger datos comunes a todos los formularios
    $id_usuario_reporta = $_SESSION['user_id'];
    $tipo_novedad_slug = $_POST['tipo_novedad'] ?? ''; // ej: 'incapacidad'
    $cedula_afectado = $_POST['cedula'] ?? $_POST['cedula_reportante'] ?? null;
    $observaciones = $_POST['observaciones'] ?? $_POST['circunstancias'] ?? $_POST['diagnostico'] ?? $_POST['motivo_permiso'] ?? $_POST['descripcion'] ?? '';
    
    // 4. Buscar el ID del tipo de novedad en la base de datos
    $id_tipo_novedad = null;
    try {
        $stmt_tipo = $pdo->prepare("SELECT ID_TipoNovedad FROM TiposNovedad WHERE NombreNovedad LIKE ?");
        // Convertimos el slug (ej: 'unidad-evadida') a un nombre legible ('Unidad Evadida')
        $nombre_busqueda = ucwords(str_replace('-', ' ', str_replace('_', ' ', $tipo_novedad_slug)));
        $stmt_tipo->execute([$nombre_busqueda]);
        $tipo_novedad_row = $stmt_tipo->fetch(PDO::FETCH_ASSOC);
        if ($tipo_novedad_row) {
            $id_tipo_novedad = $tipo_novedad_row['ID_TipoNovedad'];
        }
    } catch (PDOException $e) {
        // Manejar error si la tabla TiposNovedad no existe
    }

    if (!$id_tipo_novedad) {
        header('Location: ../index.php?page=registro-novedades-general&error=' . urlencode('Error: Tipo de novedad no configurado en la base de datos.'));
        exit();
    }
    
    // (Lógica futura para manejar archivos subidos...)

    // 5. Guardar la novedad en la base de datos
    try {
        $sql = "INSERT INTO Novedades (ID_TipoNovedad, ID_Usuario_Reporta, Descripcion, EstadoNovedad, FechaHoraOcurrencia) 
                VALUES (?, ?, ?, 'Abierta', NOW())";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $id_tipo_novedad,
            $id_usuario_reporta,
            $observaciones
        ]);
        
        $success_message = "Novedad registrada exitosamente.";
        header('Location: ../index.php?page=registro-novedades-general&success=' . urlencode($success_message));
        exit();

    } catch (PDOException $e) {
        header('Location: ../index.php?page=registro-novedades-general&error=' . urlencode('Error al guardar en la base de datos: ' . $e->getMessage()));
        exit();
    }
} else {
    // Si no es POST, redirigir
    header('Location: ../index.php');
    exit();
}
?>