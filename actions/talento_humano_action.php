<?php
// C:\xampp\htdocs\securigestion\actions\talento_humano_action.php (Versión Definitiva con Diagnóstico)

// --- HABILITAR REPORTE DE ERRORES PARA DIAGNÓSTICO ---
// Estas líneas son cruciales. Si hay un error, lo veremos en pantalla.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// --- USO DE __DIR__ PARA RUTAS A PRUEBA DE ERRORES ---
// Esto garantiza que PHP siempre encuentre los archivos, sin importar cómo se le llame.
require_once dirname(__DIR__) . '/includes/db.php';
require_once dirname(__DIR__) . '/includes/functions.php';
require_once dirname(__DIR__) . '/libs/GeneradorCarta.php';

// Verificar si el usuario ha iniciado sesión
if (!is_logged_in()) {
    header('Location: ../index.php?page=login');
    exit();
}

// Asegurarse de que el formulario enviado sea el correcto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'solicitar_carta') {
    
    // 1. Recoger datos del formulario
    $cedula = $_POST['cedula_empleado'];
    $tipo_carta = $_POST['tipo_carta'];

    try {
        // 2. Buscar los datos del empleado en la tabla de autocompletar
        $stmt = $pdo->prepare("SELECT * FROM personal_autocompletar WHERE documento = ?");
        $stmt->execute([$cedula]);
        $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($empleado) {
            // 3. Crear el PDF usando la librería GeneradorCarta
            $pdf = new GeneradorCarta();
            
            // SIMULACIÓN de datos que deberían venir de la tabla Usuarios o de otra consulta
            $fecha_contratacion = '2023-01-15'; 
            $salario = 1800000; 
            
            $pdf->crearCarta(
                $empleado['nombre_completo'],
                $empleado['documento'],
                $empleado['cargo'],
                $fecha_contratacion,
                $salario,
                $tipo_carta
            );

            // 4. Forzar la descarga del PDF con un nombre de archivo único
            $nombre_archivo = 'Carta_Laboral_' . str_replace(' ', '_', $empleado['nombre_completo']) . '.pdf';
            $pdf->Output('D', $nombre_archivo);
            exit();

        } else {
            // Si el empleado no se encuentra, redirige con un mensaje de error claro
            header('Location: ../index.php?page=talento-humano&error=' . urlencode('Empleado con cédula ' . $cedula . ' no encontrado.'));
            exit();
        }
    } catch (Exception $e) {
        // Si hay cualquier otro error (ej. FPDF no encuentra una fuente), lo mostrará en pantalla
        die("Error al generar el PDF: " . $e->getMessage());
    }
}
?>