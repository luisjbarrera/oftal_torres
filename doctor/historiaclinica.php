<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
    {
        // Cabecera de página
        function Header()
        {
            // Logo
            //$this->Image('../img/Centro_Oftalmologico_Torres_III.png',10,6,30);
            // Título
            $this->SetFont('Arial','B',15);
            $this->Cell(0,10,'Historia Clinica',0,1,'C');
            $this->Ln(10);
        }

        // Pie de página
        function Footer()
        {
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');
        }

        // Contenido
        function Content($appoid)
        {
            // Simular consulta MySQL
            $paciente = array(
                'nombre' => 'Juan Perez',
                'edad' => 30,
                'fecha' => '2022-10-15',
                'diagnostico' => $appoid,
                'tratamiento' => 'Descanso y medicación'
            );

            // Mostrar datos
            $this->SetFont('Arial','',12);
            $this->Cell(0,10,'Nombre: '.$paciente['nombre'],0,1);
            $this->Cell(0,10,'Edad: '.$paciente['edad'],0,1);
            $this->Cell(0,10,'Fecha de consulta: '.$paciente['fecha'],0,1);
            $this->Cell(0,10,'Diagnostico: '.$paciente['diagnostico'],0,1);
            $this->Cell(0,10,'Tratamiento: '.$paciente['tratamiento'],0,1);
        }
    }
    $appoid = $_GET['id'];
    var_dump($appoid);
    //$appoid=1001;
    if (isset($appoid)) {
        header('Content-Type: application/pdf');
        // Crear instancia de PDF
        $pdf = new PDF();
        $pdf->AddPage();
            //echo ", Página agregada al PDF"; // Mensaje de prueba
        // Generar contenido con el valor de appoid
        $pdf->Content($appoid);
        // Salida del PDF
        // Limpiar el búfer de salida
        ob_clean();
        $pdf->Output('D', 'historiaclinica.pdf');
        //echo 'Si recibi el POST: '.$appoid;
    } else {
        echo "Error: No se recibio la variable. ". $appoid;
    }
?>