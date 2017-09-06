<?php

include_once('../base.php');
include_once 'fpdf/fpdf.php';
include_once 'utiles/pdf_helper.php';
include_once 'utiles/code128.php';
include_once 'utiles/ayudante.php';

////inicio armado pdf ///////////////
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

        /// inicio mostrar datos en la tabla//
        //asi es como se le envie, en donde las datos vienen en la variable $datos_tarjeta_familiar y se obtienen por la clave como aqui:$datos_tarjeta_familiar['id_zona']
        //$this->Cell(23,5,"",0,0,'L');$this->Cell(26,5,"",0,0,'L');$this->Cell(24,5,"",0,0,'L');$this->Cell(13,5,"{$datos_tarjeta_familiar['id_zona']}",0,0,'L');
        //suponiendo que ya esten los datos quedaria asi:
        $this->Cell(23, 5, "{$datos_tarjeta_familiar['fecha_registro']}", 0, 0, 'L');
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

        $this->Cell(24, 5, "{$datos_tarjeta_familiar['ficha_sisben']}", 0, 0, 'L');
        $this->Cell(19, 5, "{$datos_tarjeta_familiar['nivel']}", 0, 0, 'L');
        $this->Cell(23, 5, "{$datos_tarjeta_familiar['puntaje']}", 0, 0, 'L');
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

//nuevos datos
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

    public function render_miembros_asociados($datos_persona, $data_programas)//ahora recibe dos parametros
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

            /* $this->SetFont('Arial','B','12');
              $this->Cell(53,5,"Miembros # {$i}",0,0,'L');
              $this->Ln();
              $this->SetFont('Arial','','10'); */

//inicio programas por miembro
            $this->Ln();
            $this->Ln();
            $this->SetFont('Arial', 'B', '12');
            $this->Cell(50, 4, "Programa", 1, 0, 'L');
            $this->Cell(147, 4, "Descripcion", 1, 0, 'L');


            foreach ($data_programas as $temp)
            {
                $this->Ln();
                $this->SetFont('Arial', '', '12');
                $name = utf8_decode($temp['name']);
                $this->Cell(50, 8, "{$name}", 1, 0, 'L');
                $this->SetFont('Arial', 'B', '12');
                $this->Cell(92, 4, "Actividad", 1, 0, 'L');
                $this->Cell(23, 4, "Edad", 1, 0, 'L');
                $this->Cell(13, 4, "Dosis", 1, 0, 'L');
                $this->Cell(19, 4, "Intervalo", 1, 0, 'L');




                foreach ($temp['value'] as $temp2)
                {

                    $this->Ln();
                    $this->SetFont('Arial', '', '10');
                    $rango_tipo     = utf8_decode($temp2['rango_tipo']);
                    $intervalo_tipo = utf8_decode($temp2['intervalo_tipo']);
                    if ($temp2['rango_inicio'] == $temp2['rango_fin'])
                    {
                        $rango = $temp2['rango_inicio'] . $rango_tipo;
                    }
                    else
                    {
                        $rango = $temp2['rango_inicio'] . ' a ' . $temp2['rango_fin'] . $rango_tipo;
                    }
                    $intervalo = $temp2['intervalo'] . ' al ' . $intervalo_tipo;
//$this->Cell(50,8," ",0,0,'L');$this->CellFitSpace(92,4,"{$temp2['descripcion']}",1,0,'L');$this->CellFitSpace(23,4,"{$rango}",1,0,'L');$this->CellFitSpace(13,4,"{$temp2['dosis']}",1,0,'L');$this->CellFitSpace(19,4,"{$intervalo}",1,0,'L');   
                    $this->Cell(50, 8, " ", 0, 0, 'L');
                    $this->CellFitSpace(92, 4, "{$temp2['descripcion']}", 1, 0, 'L');
                    $this->CellFitSpace(23, 4, "{$rango}", 1, 0, 'L');
                    $this->Cell(13, 4, "{$temp2['dosis']}", 1, 0, 'L');
                    $this->Cell(19, 4, "{$intervalo}", 1, 0, 'L');
                }
            }

            $this->Ln();
            $this->Ln();
//fin programas por miembro
        }//fin for i
    }

//fin render miembros
}

///
#INICIO SQL
function caracteristica_persona($id_persona)
{
    $sql       = 'SELECT 
		  `tbl_car_registro`.`value`
		FROM
		  `tbl_car_registro`
		WHERE
		  `tbl_car_registro`.`id_persona` = ?';
    $Resultado = model::Record($sql, array($id_persona));
    return $Resultado['value'];
}

function variable($id_variable)
{
    $sql       = 'SELECT 
		  `tbl_car_variables`.`id_car_variables`,
		  `tbl_car_variables`.`descripcion`,
		  `tbl_car_variables`.`id_car_tipo_dato`,
		  `tbl_car_variables`.`list_values`
		FROM
		  `tbl_car_variables`
		  WHERE
		  `tbl_car_variables`.`id_car_variables`=?';
    $Resultado = model::Record($sql, array($id_variable));
    return $Resultado;
}

function datos_tarjeta_familiar($id_tarjeta_familiar)
{
    $sql       = 'SELECT 
			  `tbl_tarjeta_familiar`.`id_tarjeta_familiar`,
			  `tbl_tarjeta_familiar`.`fecha_apertura`,
			  `tbl_tarjeta_familiar`.`codigo`,
			  `tbl_tarjeta_familiar`.`sisben_ficha`,
			  `tbl_tarjeta_familiar`.`sisben_puntaje`,
			  `tbl_tarjeta_familiar`.`sisben_nivel`,
			  `tbl_tarjeta_familiar`.`direccion`,
			  `tbl_tarjeta_familiar`.`id_zona`,
			  `tbl_tarjeta_familiar`.`telefono`,
			  `tbl_tarjeta_familiar`.`id_municipio`

			FROM
			  `tbl_tarjeta_familiar`
			  
			WHERE
			  `tbl_tarjeta_familiar`.`id_tarjeta_familiar`=?';
    $Resultado = model::Record($sql, array($id_tarjeta_familiar));
    return $Resultado;
}

function registros($id_tarjeta_familiar)
{
    $sql       = 'SELECT 
			  `tbl_car_registro`.`value`
			FROM
			  `tbl_car_registro`
			WHERE
			  `tbl_car_registro`.`id_tarjeta_familiar`=?';
    $Resultado = model::Record($sql, array($id_tarjeta_familiar));
    return $Resultado;
}

function datos_persona($id_tarjeta_familiar)
{
    $sql       = 'SELECT 
  `tbl_persona`.`id_tarjeta_familiar`,
  `tbl_persona`.`documento`,
  `tbl_persona`.`nombre1`,
  `tbl_persona`.`nombre2`,
  `tbl_persona`.`apellido1`,
  `tbl_persona`.`apellido2`,
  `tbl_documento_tipo`.`descripcion`,
  `tbl_estado_civil`.`descripcion`,
  `tbl_asegurador`.`descripcion`,
  `tbl_persona`.`sexo`,
  `tbl_persona`.`fecha_nacimiento`,
  `tbl_persona_familiaridad`.`descripcion`,
  `tbl_car_registro`.`id_persona`
FROM
  `tbl_persona`
  INNER JOIN `tbl_documento_tipo` ON (`tbl_persona`.`id_documento_tipo` = `tbl_documento_tipo`.`id_documento_tipo`)
  INNER JOIN `tbl_estado_civil` ON (`tbl_persona`.`id_estado_civil` = `tbl_estado_civil`.`id_estado_civil`)
  INNER JOIN `tbl_asegurador` ON (`tbl_persona`.`id_asegurador` = `tbl_asegurador`.`id_asegurador`)
  INNER JOIN `tbl_nivel_educativo` ON (`tbl_persona`.`id_nivel_educativo` = `tbl_nivel_educativo`.`id_nivel_educativo`)
  INNER JOIN `tbl_persona_familiaridad` ON (`tbl_persona`.`id_persona_familiaridad` = `tbl_persona_familiaridad`.`id_persona_familiaridad`)
  INNER JOIN `tbl_car_registro` ON (`tbl_persona`.`id_persona` = `tbl_car_registro`.`id_persona`)
WHERE
  `tbl_persona`.`id_tarjeta_familiar` = ?';
    $Resultado = model::Records($sql, array($id_tarjeta_familiar));
//  var_dump($Resultado);
    return $Resultado;
}

#FIN SQL
#INICIO LOGICA

function tipe_4($Dato, $list_values)
{
    $list_values = json_decode($list_values, true);
    $found_key   = array_search($Dato['value'], array_column($list_values, 'id'));
    return $list_values[$found_key]['value'];
}

function tipe_9($Dato, $list_values)
{
    $Resultado_List = array();
    $list_values    = json_decode($list_values, true);
    $Dato           = json_decode($Dato['value'], true);
    foreach ($Dato as $key => $temp)
    {
        $Dato[key($temp)] = $temp[key($temp)];
        unset($Dato[$key]);
    }
    foreach ($list_values['data'] as $key1 => $temp1)
    {
        $Res_temp = array();
        foreach ($list_values['option'] as $key2 => $temp2)
        {
            $name_data               = 'data ' . $temp1['id'];
            $name_opti               = 'option ' . $temp2['id'];
            $Res_temp['descripcion'] = $temp1['name'] . ', ' . $temp2['name'];
            $Res_temp['valor']       = $Dato[$name_data][$name_opti];
            $Resultado_List[]        = $Res_temp;
        }
    }
    return $Resultado_List;
}

function OrganizarDato($Dato, $variable)
{
    $value = null;
    switch ($Dato['id_tipo_data'])
    {
        case '1':$value = array('descripcion' => $variable['descripcion'], 'valor' => $Dato["value"]);
            break;
        case '4':$value = array('descripcion' => $variable['descripcion'], 'valor' => tipe_4($Dato, $variable["list_values"]));
            break;
        case '9':
            $Res   = tipe_9($Dato, $variable["list_values"]);
            foreach ($Res as $temp)
            {
                if (trim($temp["valor"]) !== '')
                    $value[] = $temp;
            }
            break;
        default : $value = array('descripcion' => $variable['descripcion'], 'valor' => $Dato);
            break;
    }
    return $value;
}

function datos_variables_tarjeta_familiar($id_tarjeta_familiar)
{
    $Resultado = registros($id_tarjeta_familiar);
    $data      = array();
    $Resultado = json_decode($Resultado['value'], true);
    foreach ($Resultado as $temp)
    {
        $temp1   = variable($temp['id']);
        $tempres = OrganizarDato($temp, $temp1);
        if (isset($tempres[0]))
        {
            foreach ($tempres as $temp2)
            {
                $data[] = $temp2;
            }
        }
        else
        {
            $data[] = $tempres;
        }
    }
    return $data;
}

function data_caracteristica_persona($id_persona)
{
    $value = array();
    $valor = caracteristica_persona($id_persona);
    $valor = json_decode($valor, true);
    foreach ($valor as $temp)
    {
        $descripcion = variable($temp['id']);
        $descripcion = $descripcion['descripcion'];
        $value[]     = array('descripcion' => $descripcion, 'valor' => $temp['value']);
    }
    return $value;
}

function datos_caracteristicas_persona($id_tarjeta_familiar)
{
    $data_personas = datos_persona($id_tarjeta_familiar);
    foreach ($data_personas as $key => $temp)
    {

        $data_personas[$key]['caracteristicas_ficha'] = data_caracteristica_persona($data_personas[$key]['id_persona']);
    }
    return $data_personas;
}

function Iniciar($id_tarjeta_familiar)
{
    $datos_tarjeta_familiar           = datos_tarjeta_familiar($id_tarjeta_familiar);
    $datos_variables_tarjeta_familiar = datos_variables_tarjeta_familiar($id_tarjeta_familiar);
    $datos_persona                    = datos_caracteristicas_persona($id_tarjeta_familiar);
    //var_dump($datos_tarjeta_familiar,$datos_variables_tarjeta_familiar,$datos_persona);
    //var_dump($datos_variables_tarjeta_familiar);
    //var_dump($datos_persona[0]['caracteristicas_ficha'][0]['descripcion']);
    //var_dump($datos_persona[0]);
    $pdf                              = new ficha_familiar('P', 'mm', 'Letter');
    $pdf->render_datos_generales($datos_tarjeta_familiar);
    $pdf->render_datos_variables($datos_variables_tarjeta_familiar);

//programas
    $data_programas[] = array("name"  => "HOla",
        "value" => array($data[] = array("descripcion" => "desc", "rango_inicio" => "2", "rango_fin" => "19", "rango_tipo" => "años", "dosis" => "1", "intervalo" => "2", "intervalo_tipo" => "años")));

    $pdf->render_miembros_asociados($datos_persona, $data_programas); //ahora se le debe pasar un segundo parametro, el cual es $data_programas
//fin programas

    $pdf->Output();
}

if (isset($_GET['id_tarjeta_familiar']))
{
    Iniciar($_GET['id_tarjeta_familiar']);
}
?>