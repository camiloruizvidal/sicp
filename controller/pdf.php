<?php

include_once('../base.php');
include_once 'fpdf/fpdf.php';
include_once 'utiles/pdf_helper.php';
include_once 'utiles/code128.php';
include_once 'utiles/ayudante.php';

////inicio armado pdf ///////////////
class ficha_familiar extends PDFReport
{

    public $fallecidos;

    public function render_datos_generales($datos_tarjeta_familiar)
    {
        $id = str_pad($datos_tarjeta_familiar['codigo'], 7, "0", STR_PAD_LEFT);
        $this->Image("fondoblanco.png", 0, 0, 216);
        $this->SetFont('Arial', '', 6);
        $this->Cell(8, 5, "Fecha:".date('Y-m-d h:i:s A',strtotime($datos_tarjeta_familiar['fecha_apertura'])), 0, 0, 'L');
        //$this->Cell(142, 5, "{}", 0, 0, 'L');
        $this->Cell(20, 5, "Tarjeta familiar N {$id}", 0, 0, 'L');
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

        $this->Cell(23, 5, date('Y-m-d', strtotime($datos_tarjeta_familiar['fecha_registro'])), 0, 0, 'L');
        $this->Cell(26, 5, "{$datos_tarjeta_familiar['responsable']}", 0, 0, 'L');
        $this->Cell(24, 5, "{$datos_tarjeta_familiar['fecha_proxima_visita']}", 0, 0, 'L');
        $this->Cell(13, 5, "{$datos_tarjeta_familiar['id_zona']}", 0, 0, 'L');
        $this->Cell(28, 5, "{$datos_tarjeta_familiar['departamento']}", 0, 0, 'L');
        $this->Cell(31, 5, "{$datos_tarjeta_familiar['municipio']}", 0, 0, 'L');
        $this->Cell(28, 5, "{$datos_tarjeta_familiar['corregimiento']}", 0, 0, 'L');
        $this->Cell(25, 5, "{$datos_tarjeta_familiar['vereda']}", 0, 0, 'L');

        //nuevos datos
        $this->Ln();
        $this->Ln();
        $this->EscC('');
        $this->EscC('');

        $this->Cell(25, 5, "{$datos_tarjeta_familiar['ficha_sisben']}", 0, 0, 'L');
        $this->Cell(19, 5, "{$datos_tarjeta_familiar['nivel']}", 0, 0, 'L');
        $this->Cell(23, 5, number_format($datos_tarjeta_familiar['puntaje'],0), 0, 0, 'L');
        $this->Cell(27, 5, "{$datos_tarjeta_familiar['telefono']}", 0, 0, 'L');
        $this->Cell(46, 5, "{$datos_tarjeta_familiar['direccion']}", 0, 0, 'L');
        $this->Cell(30, 5, "{$datos_tarjeta_familiar['potabilidad']}", 0, 0, 'L');
        $this->Cell(29, 5, "{$datos_tarjeta_familiar['domicilio']}", 0, 0, 'L');
        //fin nuevos datos

        /* Si depronto los datos se salen de la columna, entonces emplear esta linea
          $this->CellFitSpace(23,5,"{$datos_tarjeta_familiar['fecha_registro']}",0,0,'L');$this->CellFitSpace(26,5,"{$datos_tarjeta_familiar['responsable']}",0,0,'L');$this->CellFitSpace(24,5,"{$datos_tarjeta_familiar['fecha_proxima_visita']}",0,0,'L');$this->CellFitSpace(13,5,"{$datos_tarjeta_familiar['id_zona']}",0,0,'L');$this->CellFitSpace(28,5,"{$datos_tarjeta_familiar['departamento']}",0,0,'L'); $this->CellFitSpace(31,5,"{$datos_tarjeta_familiar['municipio']}",0,0,'L');$this->CellFitSpace(28,5,"{$datos_tarjeta_familiar['corregimiento']}",0,0,'L');$this->CellFitSpace(25,5,"{$datos_tarjeta_familiar['vereda']}",0,0,'L');
          $this->Ln();
          $this->Ln();
          $this->EscC('');
          $this->EscC('');
          //nuevos datos
          $this->CellFitSpace(24,5,"{$datos_tarjeta_familiar['ficha_sisben']}",0,0,'L');$this->CellFitSpace(19,5,"{$datos_tarjeta_familiar['nivel']}",0,0,'L');$this->CellFitSpace(23,5,"{$datos_tarjeta_familiar['puntaje']}",0,0,'L');$this->CellFitSpace(27,5,"{$datos_tarjeta_familiar['telefono']}",0,0,'L');$this->CellFitSpace(46,5,"{$datos_tarjeta_familiar['direccion']}",0,0,'L');$this->CellFitSpace(30,5,"{$datos_tarjeta_familiar['potabilidad']}",0,0,'L');$this->CellFitSpace(29,5,"{$datos_tarjeta_familiar['domicilio']}",0,0,'L');
         */

        // fin mostrar datos en la tabla
    }

    public function render_datos_variables($datos_variables_tarjeta_familiar)
    {
        $ayudante = new ayudante();
        $z        = 0;
        $this->SetFont('Arial', '', '10');
        $limiteI  = $ayudante->identificar_limite_i($datos_variables_tarjeta_familiar);
        $limiteII = $ayudante->identificar_limite_ii($datos_variables_tarjeta_familiar);
        $this->Ln();
        $this->Ln();
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
                } else
                {
                    $this->Cell(18, 5, " ", 0, 0, 'L');
                    $this->CellFitSpace(73, 5, "{$descripcion}", 1, 0, 'L');
                    $this->Cell(10, 5, "{$datos_variables_tarjeta_familiar[$j]['valor']}", 1, 0, 'C');
                }
            } //fin for ParteIII
        }
    }

    public function render_miembros_asociados($datos_persona)//ahora recibe dos parametros
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
            $mi      = $i + 1;
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
            }
            $data_programas = $datos_persona[$i]['programacion'];
            if (count($data_programas) > 0)
            {
                $this->Ln();
                $this->Ln();
                $this->SetFont('Arial', 'B', '12');
                $this->Cell(50, 4, "Programa", 1, 0, 'L');
                $this->Cell(147, 4, "Descripcion", 1, 0, 'L');
                foreach ($data_programas as $temp)
                {
                    $cantidadActividades = count($temp['value']);
                    $tamaño              = ($cantidadActividades * 4) + 4;
                    $this->Ln();
                    $this->SetFont('Arial', '', '8');
                    $name                = utf8_decode($temp['name']);
                    $this->Cell(50, $tamaño, "{$name}", 1, 0, 'L');
                    $this->SetFont('Arial', 'B', '12');
                    $this->Cell(92, 4, "Actividad", 1, 0, 'L');
                    $this->Cell(23, 4, "Edad", 1, 0, 'L');
                    $this->Cell(13, 4, "Dosis", 1, 0, 'L');
                    $this->Cell(19, 4, "Intervalo", 1, 0, 'L');


                    foreach ($temp['value'] as $temp2)
                    {
                        $temp2['descripcion'] = utf8_decode($temp2['descripcion']);
                        $this->Ln();
                        $this->SetFont('Arial', '', '10');
                        $rango_tipo           = utf8_decode($temp2['rango_tipo']);
                        $intervalo_tipo       = utf8_decode($temp2['intervalo_tipo']);
                        if ($temp2['rango_inicio'] == $temp2['rango_fin'])
                        {
                            $rango = $temp2['rango_inicio'] . $rango_tipo;
                        } else
                        {
                            $rango = $temp2['rango_inicio'] . ' a ' . $temp2['rango_fin'] . $rango_tipo;
                        }
                        $intervalo = $temp2['intervalo'] . ' al ' . $intervalo_tipo;
                        $this->Cell(50, 8, " ", 0, 0, 'L');
                        $this->CellFitSpace(92, 4, "{$temp2['descripcion']}", 1, 0, 'L');
                        $this->CellFitSpace(23, 4, "{$rango}", 1, 0, 'L');
                        $this->Cell(13, 4, "{$temp2['dosis']}", 1, 0, 'L');
                        $this->Cell(19, 4, "{$intervalo}", 1, 0, 'L');
                    }
                }
                $this->Ln();
                $this->Ln();
            }
        }
        $this->fallecidos();
        if (is_null($this->fallecidos))
        {
            
        }
    }

    public function fallecidos()
    {
        $this->Ln();
        $this->Ln();
        $this->SetFont('Arial', 'B', '12');
        $this->Cell(70, 5, "", 0, 0, 'L');
        $this->Cell(53, 5, "Miembros fallecidos", 0, 0, 'C');
        $edad = new other();
        $this->Ln();
        $this->Ln();
        $this->SetFont('Arial', 'B', '12');
        $this->Cell(40, 4, "Nombre", 1, 0, 'L');
        $this->Cell(30, 4, "Nacimiento", 1, 0, 'L');
        $this->Cell(30, 4, "Fallecimiento", 1, 0, 'L');
        $this->Cell(40, 4, "Edad", 1, 0, 'L');
        $this->Cell(45, 4, "Causa", 1, 0, 'L');
        $this->SetFont('Arial', '', '8');
        foreach ($this->fallecidos as $temp)
        {
            $edad_muerte = $edad->calcularEdad($temp['fecha_nacimientod'], $temp['fecha_fallecimiento']);
            $edad_muerte = utf8_decode($edad_muerte['year'] . ' años, ' . $edad_muerte['months'] . ' meses, ' . $edad_muerte['days'] . ' dias');

            $this->Ln();
            $this->Cell(40, 4, $temp['nombre'], 1, 0, 'L');
            $this->Cell(30, 4, $temp['fecha_nacimientod'], 1, 0, 'L');
            $this->Cell(30, 4, $temp['fecha_fallecimiento'], 1, 0, 'L');
            $this->Cell(40, 4, $edad_muerte, 1, 0, 'L');
            $this->Cell(45, 4, $temp['causa'], 1, 0, 'L');
        }
    }

}

?>