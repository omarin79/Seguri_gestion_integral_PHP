<?php
// C:\xampp\htdocs\securigestion\actions\nomina_action.php

session_start();
require_once dirname(__DIR__) . '/includes/db.php';
require_once dirname(__DIR__) . '/includes/functions.php';
require_once dirname(__DIR__) . '/libs/GeneradorDesprendible.php';
require_once dirname(__DIR__) . '/libs/GeneradorCertificado.php'; // <-- INCLUIMOS LA NUEVA LIBRERÍA

if (!is_logged_in()) {
    header('Location: ../index.php?page=login');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- LÓGICA PARA GENERAR DESPRENDIBLE DE PAGO ---
    if (isset($_POST['ano_desprendible']) && isset($_POST['cedula_empleado'])) {
        // ... (Este bloque de código se mantiene igual que antes)
        // ...
    }

    // --- LÓGICA PARA GENERAR CERTIFICADO DE INGRESOS ---
    if (isset($_POST['ano_certificado']) && isset($_POST['cedula_empleado'])) {
        
        $cedula = $_POST['cedula_empleado'];
        $ano_gravable = $_POST['ano_certificado'];

        try {
            // Buscamos los datos del empleado
            $stmt = $pdo->prepare("SELECT Nombre, Apellido, DocumentoIdentidad FROM Usuarios WHERE DocumentoIdentidad = ?");
            $stmt->execute([$cedula]);
            $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$empleado) {
                header('Location: ../index.php?page=nomina&error=' . urlencode('Empleado no encontrado.'));
                exit();
            }

            // Datos del agente retenedor (la empresa)
            $datosRetenedor = [
                'nit' => '900.123.456-7',
                'razon_social' => 'SECURIGESTIÓN INTEGRAL S.A.S.'
            ];

            // Datos del empleado
            $datosEmpleado = [
                'nombre_completo' => $empleado['Apellido'] . ' ' . $empleado['Nombre'],
                'documento' => $empleado['DocumentoIdentidad']
            ];

            // SIMULACIÓN DE DATOS FINANCIEROS DEL AÑO
            // En un sistema real, estos datos se calcularían sumando todos los pagos
            // y deducciones del empleado durante el año gravable desde la base de datos.
            $salario_anual = 1300000 * 12;
            $datosPagos = [
                'salarios' => $salario_anual,
                'honorarios' => 0,
                'servicios' => 0,
                'comisiones' => rand(0, 5) * 100000,
                'prestaciones' => $salario_anual * 0.10, // Simulación
                'cesantias' => $salario_anual,
                'aportes_salud' => ($salario_anual * 0.04) * 12,
                'aportes_pension' => ($salario_anual * 0.04) * 12,
                'retencion' => rand(0, 1) ? rand(50000, 250000) : 0 // Retención simulada
            ];

            // Generar el PDF
            $pdf = new GeneradorCertificado();
            $pdf->crearCertificado($datosRetenedor, $datosEmpleado, $datosPagos);

            // Descargar el PDF
            $nombre_archivo = 'Certificado_Ingresos_' . $cedula . '_' . $ano_gravable . '.pdf';
            $pdf->Output('D', $nombre_archivo);
            exit();

        } catch (Exception $e) {
            die("Error al generar el certificado: " . $e->getMessage());
        }
    }

} else {
    header('Location: ../index.php');
    exit();
}
?>