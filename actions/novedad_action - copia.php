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

    // 3. Recoger datos del formulario
    $id_usuario_reporta = $_SESSION['user_id'];
    $tipo_novedad_slug = $_POST['tipo_novedad'] ?? '';
    $descripcion_novedad = $_POST['observaciones'] ?? $_POST['diagnostico'] ?? $_POST['motivo_permiso'] ?? $_POST['circunstancias'] ?? $_POST['descripcion'] ?? 'Sin descripción.';

    // 4. Buscar el ID del tipo de novedad en la base de datos
    $id_tipo_novedad = null;
    try {
        $nombre_busqueda = ucwords(str_replace('_', ' ', $tipo_novedad_slug));
        $stmt_tipo = $pdo->prepare("SELECT ID_TipoNovedad FROM TiposNovedad WHERE NombreNovedad LIKE ?");
        $stmt_tipo->execute([$nombre_busqueda]);
        $tipo_novedad_row = $stmt_tipo->fetch(PDO::FETCH_ASSOC);
        if ($tipo_novedad_row) {
            $id_tipo_novedad = $tipo_novedad_row['ID_TipoNovedad'];
        }
    } catch (PDOException $e) {
        // Manejar error si la consulta falla
    }

    if (!$id_tipo_novedad) {
        header('Location: ../index.php?page=registro-novedades-general&error=' . urlencode('Error: Tipo de novedad no configurado en la BD.'));
        exit();
    }
    
    // (Lógica futura para archivos...)

    // 5. Guardar la novedad en la base de datos
    try {
        $sql = "INSERT INTO Novedades (ID_TipoNovedad, ID_Usuario_Reporta, Descripcion, EstadoNovedad) 
                VALUES (?, ?, ?, 'Abierta')";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $id_tipo_novedad,
            $id_usuario_reporta,
            $descripcion_novedad
        ]);
        
        $success_message = "Novedad de '" . htmlspecialchars($nombre_busqueda) . "' registrada exitosamente.";
        header('Location: ../index.php?page=registro-novedades-general&success=' . urlencode($success_message));
        exit();

    } catch (PDOException $e) {
        header('Location: ../index.php?page=registro-novedades-general&error=' . urlencode('Error al guardar en la base de datos.'));
        exit();
    }
} else {
    // Si no es POST, redirigir
    header('Location: ../index.php');
    exit();
}
?>