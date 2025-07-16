<?php
// C:\xampp\htdocs\securigestion\actions\nomina_action.php

// --- ▼▼ SECCIÓN DE DEPURACIÓN DE ERRORES ▼▼ ---
// Estas líneas son cruciales para ver qué está fallando.
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inicia el buffer de salida para capturar cualquier salida inesperada.
ob_start();

session_start();

// --- ▼▼ RUTAS DE ARCHIVOS CORREGIDAS ▼▼ ---
require_once dirname(__DIR__) . '/includes/db.php';
require_once dirname(__DIR__) . '/includes/functions.php';
// Asegúrate de que apuntas al archivo correcto en la carpeta /libs
require_once dirname(__DIR__) . '/libs/GeneradorDesprendible.php';
require_once dirname(__DIR__) . '/libs/GeneradorCertificado.php';

if (!is_logged_in()) {
    header('Location: ../index.php?page=login');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // --- LÓGICA PARA GENERAR DESPRENDIBLE ---
    if (isset($_POST['ano_desprendible'])) {
        $cedula = $_POST['cedula_empleado'] ?? '';
        
        if (empty($cedula)) {
            die("Error: La cédula no puede estar vacía.");
        }

        try {
            $stmt = $pdo->prepare("SELECT u.Nombre, u.Apellido, u.DocumentoIdentidad, r.NombreRol 
                                   FROM Usuarios u
                                   JOIN Roles r ON u.ID_Rol = r.ID_Rol
                                   WHERE u.DocumentoIdentidad = ?");
            $stmt->execute([$cedula]);
            $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$empleado) {
                die("Error: Empleado con cédula $cedula no encontrado.");
            }
            
            // Simulación de datos de pago
            $datosEmpleado = [
                'nombre' => $empleado['Nombre'] . ' ' . $empleado['Apellido'],
                'documento' => $empleado['DocumentoIdentidad'],
                'cargo' => $empleado['NombreRol'],
            ];
            $datosPago = [
                'periodo' => '01/05/2025 - 15/05/2025',
                'devengados' => [
                    ['concepto' => 'Salario Básico', 'valor' => 650000],
                    ['concepto' => 'Horas Extras', 'valor' => 85000],
                ],
                'deducidos' => [
                    ['concepto' => 'Aporte Salud (4%)', 'valor' => 29400],
                    ['concepto' => 'Aporte Pensión (4%)', 'valor' => 29400],
                    ['concepto' => 'Préstamo Interno', 'valor' => 50000],
                ],
                'total_devengado' => 735000,
                'total_deducido' => 108800,
                'neto_a_pagar' => 626200,
            ];

            // --- ▼▼ GENERACIÓN DEL PDF ▼▼ ---
            $pdf = new GeneradorDesprendible();
            $pdf->crearDesprendible($datosEmpleado, $datosPago);

            // Limpia cualquier salida accidental que se haya acumulado en el buffer
            ob_end_clean();

            // Descargar el PDF
            $nombre_archivo = 'Desprendible_de_Pago_' . $cedula . '.pdf';
            $pdf->Output('D', $nombre_archivo);
            exit();

        } catch (Exception $e) {
            // Si hay un error, lo mostramos claramente
            die("Error al generar el desprendible: " . $e->getMessage());
        }
    }
    
    // --- (La lógica para el certificado de ingresos se mantiene igual) ---
    if (isset($_POST['ano_certificado'])) {
        // ... tu código existente para el certificado ...
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>