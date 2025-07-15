<?php
// C:\xampp\htdocs\securigestion\actions\talento_humano_action.php

session_start();
require_once dirname(__DIR__) . '/includes/db.php';
require_once dirname(__DIR__) . '/includes/functions.php';
require_once dirname(__DIR__) . '/libs/GeneradorCarta.php'; // Incluimos la nueva librería

if (!is_logged_in()) {
    header('Location: ../index.php?page=login');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Verificamos si la acción es para solicitar una carta laboral
    if (isset($_POST['tipo_carta']) && isset($_POST['cedula_empleado_carta'])) {
        
        $cedula = $_POST['cedula_empleado_carta'];
        $tipo_carta = $_POST['tipo_carta'];

        try {
            // Buscamos los datos del empleado
            $stmt = $pdo->prepare("SELECT u.Nombre, u.Apellido, u.DocumentoIdentidad, u.FechaContratacion, r.NombreRol 
                                   FROM Usuarios u
                                   JOIN Roles r ON u.ID_Rol = r.ID_Rol
                                   WHERE u.DocumentoIdentidad = ?");
            $stmt->execute([$cedula]);
            $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($empleado) {
                // Datos para la carta (salario simulado)
                $salario_simulado = 1800000;
                $fecha_contratacion_simulada = $empleado['FechaContratacion'] ?? '2023-01-15';

                // Creamos el PDF
                $pdf = new GeneradorCarta();
                $pdf->crearCarta(
                    $empleado['Nombre'] . ' ' . $empleado['Apellido'],
                    $empleado['DocumentoIdentidad'],
                    $empleado['NombreRol'],
                    $fecha_contratacion_simulada,
                    $salario_simulado,
                    $tipo_carta
                );

                // Forzamos la descarga del PDF
                $nombre_archivo = 'Carta_Laboral_' . str_replace(' ', '_', $empleado['Nombre']) . '.pdf';
                $pdf->Output('D', $nombre_archivo);
                exit();

            } else {
                header('Location: ../index.php?page=talento_humano&error=' . urlencode('Empleado no encontrado.'));
                exit();
            }
        } catch (Exception $e) {
            die("Error al generar el PDF: " . $e->getMessage());
        }
    }
    
    // Aquí puedes añadir la lógica para "Consultar Documentos"
}
?>