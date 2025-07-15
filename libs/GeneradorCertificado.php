<?php
// C:\xampp\htdocs\securigestion\libs\GeneradorCertificado.php

require_once('fpdf.php');

class GeneradorCertificado extends FPDF
{
    // Encabezado del documento
    function Header()
    {
        $this->Image('../images/logo_segurigestion.png', 10, 8, 33);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 7, utf8_decode('CERTIFICADO DE INGRESOS Y RETENCIONES'), 0, 1, 'C');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 7, utf8_decode('AÑO GRAVABLE 2024'), 0, 1, 'C');
        $this->Ln(10);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Documento generado por SecuriGestión Integral'), 0, 0, 'C');
    }

    // Método para crear una celda de título de sección
    function TituloSeccion($label)
    {
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(230, 230, 230);
        $this->Cell(0, 7, utf8_decode($label), 1, 1, 'L', true);
        $this->SetFont('Arial', '');
    }

    // Método para crear una fila de datos
    function FilaDato($label, $valor)
    {
        $this->Cell(95, 7, utf8_decode($label), 1);
        $this->Cell(95, 7, utf8_decode($valor), 1, 1);
    }

    // Método principal para construir el certificado
    function crearCertificado($datosRetenedor, $datosEmpleado, $datosPagos)
    {
        $this->AddPage();
        $this->SetFont('Arial', '', 10);

        // Sección 1: Datos del Agente Retenedor
        $this->TituloSeccion('1. Datos del Agente Retenedor');
        $this->FilaDato('NIT:', $datosRetenedor['nit']);
        $this->FilaDato('Razón Social:', $datosRetenedor['razon_social']);
        $this->Ln(7);

        // Sección 2: Datos del Empleado
        $this->TituloSeccion('2. Datos del Empleado Asalariado');
        $this->FilaDato('Tipo y No. Documento:', 'C.C. ' . number_format($datosEmpleado['documento'], 0, ',', '.'));
        $this->FilaDato('Apellidos y Nombres:', $datosEmpleado['nombre_completo']);
        $this->Ln(7);

        // Sección 3: Datos de Pagos y Aportes
        $this->TituloSeccion('3. Concepto de los Ingresos');
        $this->FilaDato('Pagos por salarios, emolumentos eclesiásticos:', '$ ' . number_format($datosPagos['salarios'], 2, ',', '.'));
        $this->FilaDato('Pagos por honorarios:', '$ ' . number_format($datosPagos['honorarios'], 2, ',', '.'));
        $this->FilaDato('Pagos por servicios:', '$ ' . number_format($datosPagos['servicios'], 2, ',', '.'));
        $this->FilaDato('Pagos por comisiones:', '$ ' . number_format($datosPagos['comisiones'], 2, ',', '.'));
        $this->FilaDato('Pagos por prestaciones sociales:', '$ ' . number_format($datosPagos['prestaciones'], 2, ',', '.'));
        $this->FilaDato('Cesantías e intereses de cesantías:', '$ ' . number_format($datosPagos['cesantias'], 2, ',', '.'));
        $this->Ln(7);

        $this->TituloSeccion('4. Concepto de los Aportes');
        $this->FilaDato('Aportes obligatorios por salud:', '$ ' . number_format($datosPagos['aportes_salud'], 2, ',', '.'));
        $this->FilaDato('Aportes obligatorios a fondos de pensiones:', '$ ' . number_format($datosPagos['aportes_pension'], 2, ',', '.'));
        $this->Ln(7);

        $this->TituloSeccion('5. Retención en la Fuente');
        $this->FilaDato('Valor total de la retención en la fuente:', '$ ' . number_format($datosPagos['retencion'], 2, ',', '.'));
        $this->Ln(15);

        // Sección de la firma
        $this->Cell(0, 10, 'Atentamente,', 0, 1);
        $this->Ln(15);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 7, '_________________________', 0, 1);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 7, utf8_decode('Agente Retenedor'), 0, 1);
        $this->Cell(0, 7, utf8_decode($datosRetenedor['razon_social']), 0, 1);
    }
}
?>