<?php
// C:\xampp\htdocs\securigestion\libs\GeneradorDesprendible.php

require_once('fpdf.php');

class GeneradorDesprendible extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo de la empresa
        $this->Image('../images/logo_segurigestion.png', 10, 8, 33);
        // Fuente Arial Bold 15
        $this->SetFont('Arial', 'B', 15);
        // Título del documento
        $this->Cell(0, 10, utf8_decode('DESPRENDIBLE DE PAGO'), 0, 1, 'C');
        // Salto de línea
        $this->Ln(15);
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Fuente Arial Italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    // Método principal para crear el desprendible
    function crearDesprendible($datosEmpleado, $datosPago)
    {
        $this->AddPage();
        $this->SetFont('Arial', '', 10);

        // --- SECCIÓN DE INFORMACIÓN DEL EMPLEADO ---
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Información del Empleado'), 1, 1, 'C');
        $this->SetFont('Arial', '');
        $this->Cell(40, 7, 'Nombre:', 1);
        $this->Cell(0, 7, utf8_decode($datosEmpleado['nombre']), 1, 1);
        $this->Cell(40, 7, utf8_decode('Cédula:'), 1);
        $this->Cell(0, 7, utf8_decode($datosEmpleado['documento']), 1, 1);
        $this->Cell(40, 7, 'Cargo:', 1);
        $this->Cell(0, 7, utf8_decode($datosEmpleado['cargo']), 1, 1);
        $this->Cell(40, 7, 'Periodo de Pago:', 1);
        $this->Cell(0, 7, utf8_decode($datosPago['periodo']), 1, 1);
        $this->Ln(10);

        // --- SECCIÓN DE DETALLES DEL PAGO ---
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Detalle del Pago', 1, 1, 'C');
        
        // Cabeceras para devengados y deducidos
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(95, 7, 'DEVENGADOS', 1, 0, 'C');
        $this->Cell(95, 7, 'DEDUCIDOS', 1, 1, 'C');

        // Contenido de las columnas
        $this->SetFont('Arial', '');

        // Preparamos los datos
        $devengados = $datosPago['devengados'];
        $deducidos = $datosPago['deducidos'];
        $maxRows = max(count($devengados), count($deducidos));

        for ($i = 0; $i < $maxRows; $i++) {
            // Columna de Devengados
            $conceptoDev = isset($devengados[$i]) ? $devengados[$i]['concepto'] : '';
            $valorDev = isset($devengados[$i]) ? '$ ' . number_format($devengados[$i]['valor'], 0, ',', '.') : '';
            $this->Cell(70, 7, utf8_decode($conceptoDev), 1);
            $this->Cell(25, 7, $valorDev, 1, 0, 'R');

            // Columna de Deducidos
            $conceptoDed = isset($deducidos[$i]) ? $deducidos[$i]['concepto'] : '';
            $valorDed = isset($deducidos[$i]) ? '$ ' . number_format($deducidos[$i]['valor'], 0, ',', '.') : '';
            $this->Cell(70, 7, utf8_decode($conceptoDed), 1);
            $this->Cell(25, 7, $valorDed, 1, 1, 'R');
        }

        // --- SECCIÓN DE TOTALES ---
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(70, 7, 'TOTAL DEVENGADO', 1);
        $this->Cell(25, 7, '$ ' . number_format($datosPago['total_devengado'], 0, ',', '.'), 1, 0, 'R');
        $this->Cell(70, 7, 'TOTAL DEDUCIDO', 1);
        $this->Cell(25, 7, '$ ' . number_format($datosPago['total_deducido'], 0, ',', '.'), 1, 1, 'R');
        
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(165, 10, 'NETO A PAGAR', 1);
        $this->Cell(25, 10, '$ ' . number_format($datosPago['neto_a_pagar'], 0, ',', '.'), 1, 1, 'R');
    }
}
?>