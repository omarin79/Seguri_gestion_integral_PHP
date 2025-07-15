<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__DIR__) . '/includes/db.php';

// Obtenemos el ID del checklist que se envió desde JavaScript
$checklistId = $_GET['id'] ?? 0;

if (!$checklistId) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No se especificó un ID de checklist.']);
    exit();
}

try {
    // Preparamos la consulta para obtener las preguntas del checklist seleccionado
    $stmt = $pdo->prepare("SELECT ID_Item, Seccion, Pregunta FROM ItemsChecklist WHERE ID_Checklist = ? ORDER BY Orden, ID_Item");
    $stmt->execute([$checklistId]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolvemos los resultados en formato JSON para que JavaScript los pueda usar
    header('Content-Type: application/json');
    echo json_encode($items);

} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Error al consultar la base de datos: ' . $e->getMessage()]);
}
?>