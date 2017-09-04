<?php

include_once('../base.php');
include_once 'fpdf/fpdf.php';
include_once 'utiles/pdf_helper.php';
include_once 'utiles/code128.php';
include_once 'utiles/ayudante.php';
class ficha_familiar extends PDFReport
{

    public function render_datos_generales($datos_tarjeta_familiar)
    {
        //var_dump($datos_tarjeta_familiar);
        $this->Image("fondoblanco.png", 0, 0, 216);
        $this->SetFont('Arial', '', 6);
        $this->Cell(8, 5, "Fecha:", 0, 0, 'L');
        $this->Cell(142, 5, "{$datos_tarjeta_familiar['fecha_apertura']}", 0, 0, 'L');
        $this->Cell(20, 5, "Tarjeta familiar N", 0, 0, 'L');
        $this->Cell(20, 5, "{$datos_tarjeta_familiar['id_tarjeta_familiar']}", 0, 0, 'L'); //primer cero indica que no lleve borde*/
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->EscC('');
        $this->EscC('');
        $this->Ln();
        $this->EscC('');
        $this->Cell(23, 5, "{$datos_tarjeta_familiar['fecha_registro']}", 0, 0, 'L');
        $this->Cell(26, 5, "{$datos_tarjeta_familiar['responsable']}", 0, 0, 'L');
        $this->Cell(24, 5, "{$datos_tarjeta_familiar['fecha_proxima_visita']}", 0, 0, 'L');
        $this->Cell(13, 5, "{$datos_tarjeta_familiar['id_zona']}", 0, 0, 'L');
        $this->Cell(28, 5, "{$datos_tarjeta_familiar['departamento']}", 0, 0, 'L');
        $this->Cell(31, 5, "{$datos_tarjeta_familiar['municipio']}", 0, 0, 'L');
        $this->Cell(28, 5, "{$datos_tarjeta_familiar['corregimiento']}", 0, 0, 'L');
        $this->Cell(25, 5, "{$datos_tarjeta_familiar['vereda']}", 0, 0, 'L');
        $this->Ln();
        $this->Ln();
        $this->EscC('');
        $this->EscC('');
        $this->Cell(24, 5, "{$datos_tarjeta_familiar['ficha_sisben']}", 0, 0, 'L');
        $this->Cell(19, 5, "{$datos_tarjeta_familiar['nivel']}", 0, 0, 'L');
        $this->Cell(23, 5, "{$datos_tarjeta_familiar['puntaje']}", 0, 0, 'L');
        $this->Cell(27, 5, "{$datos_tarjeta_familiar['telefono']}", 0, 0, 'L');
        $this->Cell(46, 5, "{$datos_tarjeta_familiar['direccion']}", 0, 0, 'L');
        $this->Cell(30, 5, "{$datos_tarjeta_familiar['potabilidad']}", 0, 0, 'L');
        $this->Cell(29, 5, "{$datos_tarjeta_familiar['domicilio']}", 0, 0, 'L');
    }

    public function render_datos_variables($datos_variables_tarjeta_familiar)
    {   //var_dump($datos_variables_tarjeta_familiar);
        $ayudante = new ayudante();
        $z        = 0;
        $this->SetFont('Arial', '', '10');
        $limiteI  = $ayudante->identificar_limite_i($datos_variables_tarjeta_familiar);
        $limiteII = $ayudante->identificar_limite_ii($datos_variables_tarjeta_familiar);
        //var_dump($limiteII);
        $this->Ln();
        $this->Ln();
        $this->Ln();
        for ($i = 0; $i <= $limiteI; $i++)
        {
            $descripcion = utf8_decode($datos_variables_tarjeta_familiar[$i]['descripcion']);
            $this->Cell(53, 4, "{$descripcion}", 0, 0, 'L');
            $this->Cell(10, 4, "{$datos_variables_tarjeta_familiar[$i]['valor']}", 0, 0, 'L');
            $this->Ln();
        } //fin for ParteI



        $this->Ln();
        $this->SetFont('Arial', 'B', '10');
        $this->Cell(53, 5, "Observar si hay:", 0, 0, 'L');
        $this->Ln();
        $this->Ln();
        $this->SetFont('Arial', '', '10');

        for ($j = ($limiteI + 1); $j <= $limiteII['valor']; $j++)
        {
            $descripcion = utf8_decode($datos_variables_tarjeta_familiar[$j]['descripcion']);
            $this->Cell(18, 5, " ", 0, 0, 'L');
            $this->Cell(76, 5, "{$descripcion}", 1, 0, 'C');
            $this->Cell(90, 5, "{$datos_variables_tarjeta_familiar[$j]['valor']}", 1, 0, 'C');
            $this->Ln();
        } //fin for ParteII

        if ($limiteII['exite'])
        {
            $this->Ln();
            $this->SetFont('Arial', 'B', '10');
            $this->Cell(53, 5, "Riesgos del medio ambiente:", 0, 0, 'L');
            $this->Ln();
            $this->Ln();
            $this->SetFont('Arial', '', '10');

            for ($j = ($limiteII['valor'] + 1); $j < count($datos_variables_tarjeta_familiar); $j++)
            {
                $descripcion = utf8_decode($datos_variables_tarjeta_familiar[$j]['descripcion']);
                $z++; //
                if (($z % 2) == 0)
                {
                    $this->CellFitSpace(73, 5, "{$descripcion}", 1, 0, 'L');
                    $this->Cell(10, 5, "{$datos_variables_tarjeta_familiar[$j]['valor']}", 1, 0, 'C');
                    $this->Ln();
                }
                else
                {
                    $this->Cell(18, 5, " ", 0, 0, 'L');
                    $this->CellFitSpace(73, 5, "{$descripcion}", 1, 0, 'L');
                    $this->Cell(10, 5, "{$datos_variables_tarjeta_familiar[$j]['valor']}", 1, 0, 'C');
                }
            } //fin for ParteIII
        }
    }

    public function render_miembros_asociados($datos_persona, $table = '')
    {
        $this->Ln();
        $this->Ln();
        $this->SetFont('Arial', 'B', '12');
        $this->Cell(70, 5, "", 0, 0, 'L');
        $this->Cell(53, 5, "Miembros Asociados", 0, 0, 'C');
        $this->Ln();
        $this->Ln();


        for ($i = 0; $i < count($datos_persona); $i++)
        {
            $mi = $i + 1;
            $this->SetFont('Arial', 'B', '12');
            $this->Cell(53, 5, "Miembro #{$mi}", 0, 0, 'L');
            $this->Ln();
            $this->SetFont('Arial', '', '10');
            $this->Ln();

            $this->Cell(53, 4, "{$datos_persona[$i]['descripcion']}", 0, 0, 'L');
            $this->Ln();
            $nombres = $datos_persona[$i]['nombre1'] . " " . $datos_persona[$i]['nombre2'];
            $this->Cell(40, 4, "Nombres y Apellidos:", 0, 0, 'L');
            $this->Cell(40, 4, "{$nombres}", 0, 0, 'L');
            $this->Ln();
            $this->Cell(40, 4, "Numero documento:", 0, 0, 'L');
            $this->Cell(40, 4, "{$datos_persona[$i]['documento']}", 0, 0, 'L');
            $this->Ln();
            $this->Cell(40, 4, "Sexo:", 0, 0, 'L');
            $this->Cell(40, 4, "{$datos_persona[$i]['sexo']}", 0, 0, 'L');
            $this->Ln();
            $this->Cell(40, 4, "Fecha nacimiento:", 0, 0, 'L');
            $this->Cell(40, 4, "{$datos_persona[$i]['fecha_nacimiento']}", 0, 0, 'L');
            $this->Ln();
            $this->Ln();
            for ($j = 0; $j < count($datos_persona[$i]['caracteristicas_ficha']); $j++)
            {
                $descripcion = utf8_decode($datos_persona[$i]['caracteristicas_ficha'][$j]['descripcion']);
                $this->CellFitSpace(90, 5, "{$descripcion}", 0, 0, 'L');
                $this->Cell(10, 5, "{$datos_persona[$i]['caracteristicas_ficha'][$j]['valor']}", 0, 0, 'L');
                $this->Ln();
            }//fin for j
            $this->Ln();
            $this->Ln();
            /* $this->SetFont('Arial','B','12');
              $this->Cell(53,5,"Miembros # {$i}",0,0,'L');
              $this->Ln();
              $this->SetFont('Arial','','10'); */
        }//fin for i
//			$this->CellFitSpace(73,5,"{$descripcion}",1,0,'L');
    }

}

?>