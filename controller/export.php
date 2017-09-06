<?php

include_once dirname(__FILE__) . '/../base.php';
include_once Config::$model . 'modelcategorias.php';
include_once Config::$model . 'modelexport.php';
include_once Config::$Controller . 'programacion.php';
include_once Config::$Controller . 'other.php';
include_once Config::$Controller . 'pdf.php';
require Config::$Controller . 'PHPExcel.php';
PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

class export
{

    public function generarexcel($data, $cabecera = '', $nombreArchivo = 'ficha_familiar.xlsx')
    {
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Fill worksheet from values in array
        if ($cabecera != '')
        {
            array_unshift($data, $cabecera);
        }
        $objPHPExcel->getActiveSheet()->fromArray($data, null, 'A1');
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Members');
        // Set AutoSize for name and email fields
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        // Save Excel 2007 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($nombreArchivo);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($nombreArchivo));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($nombreArchivo));
        ob_clean();
        flush();
        readfile($nombreArchivo);
    }

    private function showregistroxpersona($id_tarjeta)
    {
        $cat  = new modelcategorias();
        $data = $cat->VerRegistro($id_tarjeta);
        $data = other::echo_json_decode($data);
        $Res  = array();
        foreach ($data as $key => $temp)
        {
            $temp2 = array('value' => $temp['value'], 'name' => modelcategorias::VerVariable($temp['id']));
            $Res[] = $temp2;
        }
    }

    public function Getxls()
    {
        $model    = new modelexport();
        $data     = $model->exportarData($_GET['fecha_ini'], $_GET['fecha_fin'], $_GET['edad_min'], $_GET['edad_max']);
        $cabecera = array('CODIGO', 'PERSONA', 'DOCUMENTO', 'EDAD', 'GENERO', 'FECHA NACIMIENTO', 'RANGO', 'CABEZA FAMILIA', 'ESTADO CIVIL', 'NIVEL EDUCATIVO', 'FECHA APERTURA', 'SISBEN FICHA', 'SISBEN PUNTAJE', 'SISBEN NIVEL', 'DIRECCION', 'TELEFONO', 'PORTABILIDAD', 'CAMBIO DOMICILIO', 'PROXIMA VISITA', 'DOCUMENTO ENCARGADO', 'ENCARGADO', 'ZONA', 'VEREDA', 'CORREGIMIENTO', 'MUNICIPIO', 'DEPARTAMENTO', 'FAMILIARIDAD', 'ASEGURADOR', 'REGIMEN');
        $this->generarexcel($data, $cabecera);
    }

    public function Getpdf()
    {
        $this->Iniciar($_GET['c']);
    }

    #PDF INICIO

    private function tipe_4($Dato, $list_values)
    {
        $list_values = json_decode($list_values, true);
        $found_key   = array_search($Dato['value'], array_column($list_values, 'id'));
        return $list_values[$found_key]['value'];
    }

    private function tipe_9($Dato, $list_values)
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

    private function OrganizarDato($Dato, $variable)
    {
        $value = null;
        switch ($Dato['id_tipo_data'])
        {
            case '1':$value = array('descripcion' => $variable['descripcion'], 'valor' => $Dato["value"]);
                break;
            case '4':$value = array('descripcion' => $variable['descripcion'], 'valor' => $this->tipe_4($Dato, $variable["list_values"]));
                break;
            case '9':
                $Res   = $this->tipe_9($Dato, $variable["list_values"]);
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

    private function datos_variables_tarjeta_familiar($id_tarjeta_familiar)
    {
        $model     = new modelexport();
        $Resultado = $model->registros($id_tarjeta_familiar);
        $data      = array();
        if (count($Resultado) > 0)
        {
            $Resultado = json_decode($Resultado['value'], true);
            foreach ($Resultado as $temp)
            {
                $temp1   = $model->variable($temp['id']);
                $tempres = $this->OrganizarDato($temp, $temp1);
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
    }

    private function data_caracteristica_persona($id_persona)
    {
        $model = new modelexport();
        $value = array();
        $valor = $model->caracteristica_persona($id_persona);
        $valor = json_decode($valor, true);
        foreach ($valor as $temp)
        {
            $descripcion = $model->variable($temp['id']);
            $descripcion = $descripcion['descripcion'];
            $value[]     = array('descripcion' => $descripcion, 'valor' => $temp['value']);
        }
        return $value;
    }

    private function datos_caracteristicas_persona($id_tarjeta_familiar)
    {
        $model         = new modelexport();
        $data_personas = $model->datos_persona1($id_tarjeta_familiar);
        foreach ($data_personas as $key => $temp)
        {
            $data_personas[$key]['caracteristicas_ficha'] = $this->data_caracteristica_persona($temp['id_persona']);
            $data_personas[$key]['programacion']          = programacion::programas($temp['id_persona']);
        }
        return $data_personas;
    }

    private function Iniciar($id_tarjeta_familiar)
    {
        $model                            = new modelexport();
        $datos_tarjeta_familiar           = $model->datos_tarjeta_familiar($id_tarjeta_familiar);
        $datos_variables_tarjeta_familiar = $this->datos_variables_tarjeta_familiar($id_tarjeta_familiar);
        if (!is_null($datos_variables_tarjeta_familiar))
        {
            $datos_persona = $this->datos_caracteristicas_persona($id_tarjeta_familiar);
            $pdf           = new ficha_familiar('P', 'mm', 'Letter');
            $pdf->fallecidos=  modelpersona::Morbilidad($id_tarjeta_familiar);
            $pdf->render_datos_generales($datos_tarjeta_familiar);
            $pdf->render_datos_variables($datos_variables_tarjeta_familiar);
            $pdf->render_miembros_asociados($datos_persona); //ahora se le debe pasar un segundo parametro, el cual es $data_programas
            $pdf->Output();
            //$pdf->Output('Ficha Familiar.pdf', 'D');
        }
    }

    #PDF FIN 
}
