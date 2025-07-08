<?php
// C:\xampp\htdocs\securigestion\actions\preoperacional_action.php

session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!is_logged_in()) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_vehiculo = $_POST['tipo_vehiculo'] ?? 'No especificado';
    $observaciones = $_POST['observaciones'] ?? '';
    
    // Recoge los ítems del checklist según el tipo de vehículo
    $items_chequeados = [];
    if ($tipo_vehiculo === 'carro' && isset($_POST['items_carro'])) {
        $items_chequeados = $_POST['items_carro'];
    } elseif ($tipo_vehiculo === 'moto' && isset($_POST['items_moto'])) {
        $items_chequeados = $_POST['items_moto'];
    }

    // --- Lógica de Backend ---
    // Aquí guardarías en la base de datos:
    // 1. Quién hizo el registro ($_SESSION['user_id'])
    // 2. La fecha y hora.
    // 3. El tipo de vehículo.
    // 4. Las observaciones.
    // 5. Los ítems que fueron marcados.

    // Por ahora, solo simulamos el éxito.
    $success_message = "Registro pre-operacional para " . htmlspecialchars($tipo_vehiculo) . " guardado exitosamente.";
    header('Location: ../index.php?page=plataforma-operativa&success=' . urlencode($success_message));
    exit();
}
?>