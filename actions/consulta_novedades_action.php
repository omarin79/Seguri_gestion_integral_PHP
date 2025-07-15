<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once dirname(__DIR__) . '/includes/db.php';
require_once dirname(__DIR__) . '/includes/functions.php';

// Solo respondemos si el usuario ha iniciado sesión
if (!is_logged_in()) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No autorizado']);
    exit();
}

// Solo respondemos a solicitudes GET para esta consulta
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Método no permitido.']);
    exit();
}

try {
    // Preparamos la consulta SQL para obtener las últimas 50 novedades
    // Unimos múltiples tablas para obtener nombres en lugar de solo IDs
    $stmt = $pdo->prepare("
        SELECT
            n.ID_Novedad,
            tn.NombreNovedad,
            n.Descripcion,
            n.FechaHoraRegistro,
            u_reporta.Nombre AS NombreReporta,
            u_reporta.Apellido AS ApellidoReporta,
            u_afectado.Nombre AS NombreAfectado,
            u_afectado.Apellido AS ApellidoAfectado,
            n.EstadoNovedad
        FROM Novedades n
        JOIN TiposNovedad tn ON n.ID_TipoNovedad = tn.ID_TipoNovedad
        JOIN Usuarios u_reporta ON n.ID_Usuario_Reporta = u_reporta.ID_Usuario
        LEFT JOIN Usuarios u_afectado ON n.ID_Usuario_Afectado = u_afectado.ID_Usuario
        ORDER BY n.FechaHoraRegistro DESC
        LIMIT 50
    ");
    $stmt->execute();
    $novedades = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolvemos los resultados en formato JSON
    header('Content-Type: application/json');
    echo json_encode($novedades);

} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Error en la consulta a la base de datos: ' . $e->getMessage()]);
}
?>