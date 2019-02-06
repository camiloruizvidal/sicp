<?php
ini_set('memory_limit', '-1');
include_once dirname(__FILE__) . '/../base.php';
include_once Config::$model . 'modelcategorias.php';
include_once Config::$model . 'modelexport.php';
include_once Config::$model . 'modelficha.php';
include_once Config::$Controller . 'programacion.php';
include_once Config::$Controller . 'other.php';
include_once Config::$Controller . 'pdf.php';
require Config::$Controller . 'PHPExcel.php';
PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

class export
{
    private $edit;
    private $cabecera1;
    private $cabecera2;
    private $variables;
    
    function __construct() {
        $this->edit='w+';
    }
    public function generarexcel($data, $cabecera = '', $nombreArchivo = 'ficha_familiar.xlsx', $img = '')
    {
        $objPHPExcel = new PHPExcel();
        if ($cabecera != '')
        {
            array_unshift($data, $cabecera);
        }
        $objPHPExcel->getActiveSheet()->fromArray($data, null, 'A1');
        $objPHPExcel->getActiveSheet()->setTitle('informacion');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        if ($img != '')
        {
            $objPHPExcel->createSheet($positionInExcel); //Loque mencionaste
            $objPHPExcel->setActiveSheetIndex(1); //Seleccionar la pestaña deseada
            $objPHPExcel->getActiveSheet()->setTitle('Imagenes');
            $img        = imagecreatefrompng($img);
            imagepng($img, "img.png");
            $img        = "img.png";
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('test_img');
            $objDrawing->setDescription('test_img');
            $objDrawing->setPath($img);
            $objDrawing->setCoordinates('A1');
            $objDrawing->setOffsetX(5);
            $objDrawing->setOffsetY(5);
            $objDrawing->setWidth(500);
            $objDrawing->setHeight(400);
            $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        }

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
        return '..'.$ds.'..'.$ds.'..'.$ds.'controller'.$ds.$nombreArchivo;
    }
    private function VerVariable($id)
    {
        $res = array_search($id, array_column($this->variables, 'id_car_variables'));
        return $res['descripcion'];
    }
    private function showregistroxpersona($id_tarjeta)
    {
        $cat  = new modelcategorias();
        $data = $cat->VerRegistro($id_tarjeta);
        $data = other::echo_json_decode($data);
        $Res  = array();
        foreach ($data as $key => $temp)
        {
            $temp2 = array('value' => $temp['value'], 'name' => $this->VerVariable($temp['id']));
            $Res[] = $temp2;
        }
    }

    private function variablesAll()
    {
        $model = new modelexport();
        $data = $model->variableAll();
        $res=[];
        foreach($data as $key=>$temp)
        {
            $res[$temp['id_car_variables']]=$temp;
        }
        return $res;
    }
    private function agregardatosvariable(&$data)
    {
        
        $variables = $this->variablesAll();
        $primeravez = TRUE;
        $data_final=array();
        foreach ($data as $key => $tempdata)
        {
            $this->newestado('Order format data: '.number_format(($key+1),0,'.',',').' de '.number_format((count($data)),0,'.',','));
            $datos_variables_tarjeta_familiar = $this->datos_variables_tarjeta_familiar($tempdata[30]);
            $datos_persona                    = $this->datos_caracteristicas_persona($tempdata[0]);
            $id                               = array_search($tempdata[3], array_column($datos_persona, 'documento'));
            foreach ($datos_persona[$id]["caracteristicas_ficha"] as $temp)
            {
                $valuedata = (is_null($temp["valor"]) || trim($temp['valor']) == '')? 'NN':$temp['valor'];
                if ($primeravez)
                {
                    $this->cabecera2[] = $variables[$temp['id']];
                }
                $data_final[$key]=$data[$key];
                $data_final[$key][]=$valuedata;
            }
            unset($data_final[$key][30]);
            unset($data_final[$key][1]);
            $primeravez = FALSE;
        }
        return ($data);
    }
    
    private function agregardatosficha(&$data)
    {
        $primeravez = TRUE;
        foreach ($data as $key => $tempdata)
        {
            $this->newestado('format data: '.(number_format(($key+1),0,'.',',')).' datos de '.(number_format(count($data),0,'.',',')).' datos');
            $datos_variables_tarjeta_familiar = $this->datos_variables_tarjeta_familiar($tempdata[30]);
            foreach ($datos_variables_tarjeta_familiar as $temp)
            {
                $data[$key][] =  (is_null($temp["valor"])||trim($temp['valor']) == '')?'NN':$temp["valor"];
                if ($primeravez)
                {
                    $this->cabecera1[] =(isset($temp['descripcion']))? $temp['descripcion']:'NN';
                }
            }
            $primeravez = FALSE;
        }
        return ($data);
    }

    private function cabecera($cab1, $cab2, $cab3)
    {
        $res = array();
        foreach ($cab1 as $temp)
        {
            $res[] = $temp;
        }
        foreach ($cab2 as $temp)
        {
            if(!is_array($temp))
            {
                if (is_null($temp))
                {
                    $temp = '?';
                }
                else if (trim($temp) == '')
                {
                    $temp = '?';
                }
            }
            $res[] = $temp;
        }
        foreach ($cab3 as $temp)
        {
            $res[] = $temp;
        }
        return $res;
    }
    private function validateDatas($data,$variables,$dataall)
    {
        $res='';
        $validate=(!($dataall->id_tipo_data==4 || $dataall->id_tipo_data==9));
        json_decode($data);
        if((json_last_error() == JSON_ERROR_NONE))
        {
            if(is_numeric($data))
            {
                $res=$data;
            }
            else{
                $validate=false;
                //$list=json_decode($variables[$dataall->id]['list_values']);
            }
        }
        else{
            $res=$data;
        }
        return (object)['validate'=>$validate,'data'=>$res];
    }
    private function NewData($GET)
    {
        try
        {
            $variables=$this->variablesAll();
            $model           = new modelexport();
            $data            = $model->exportarDataBug($_GET['fecha_ini'], $_GET['fecha_fin'], $_GET['edad_min'], $_GET['edad_max']);
            $cabecera        = false;
            $res=[];
            if(isset($data[0]))
            {
                $cabecera = $this->generarCabecera($data[0]);
            }
            $this->newestado('Formateando data. '. number_format((count($data)),0,'.',',') .' registros en total');
            foreach($data as $key=>$temp)
            {
                $this->newestado('Formateando '.($key+1).' de '. number_format((count($data)),0,'.',',').' registros');
                $restemp=$temp;
                unset($restemp['data_persona']);
                unset($restemp['data_tarjeta_familiar']);
                $data2=json_decode($temp['data_persona']);
                foreach($data2 as $temp2)
                {
                    $restemp[]=($temp2->value=='')?'-':$temp2->value;
                }
                $data2=json_decode($temp['data_tarjeta_familiar']);
                foreach($data2 as $temp2)
                {
                    $valueres=$this->validateDatas($temp2->value,$variables,$temp2);
                    //var_dump($valueres->validate,$temp2->value,$variables,$temp2);
                    if($valueres->validate)
                    {
                        $restemp[]=$valueres->data;
                    }
                }
                $res[]=$restemp;
                unset($restemp);
            }
            unset($data);
            $this->newestado('Generando excel');
            $url = $this->GeneraCSV($res,$cabecera);
            echo json_encode(['validate'=>true,'url'=>$url,'msj'=>null]);
        }
        catch(Exception $e)
        {
            echo json_encode(['validate'=>false,'url'=>null,'msj'=>$e->getMessage()]);
        }
    }
    private function generarCabecera($reg)
    {
        $this->newestado('Generando encabezado');
        $variables=$this->variablesAll();
        $cabecera = array('CODIGO', 'PERSONA', 'DOCUMENTO', 'EDAD', 'GENERO', 'FECHA NACIMIENTO', 'RANGO', 'CABEZA FAMILIA', 'ESTADO CIVIL', 'NIVEL EDUCATIVO', 'FECHA APERTURA', 'SISBEN FICHA', 'SISBEN PUNTAJE', 'SISBEN NIVEL', 'DIRECCION', 'TELEFONO', 'PORTABILIDAD', 'CAMBIO DOMICILIO', 'PROXIMA VISITA', 'DOCUMENTO ENCARGADO', 'ENCARGADO', 'ZONA', 'VEREDA', 'CORREGIMIENTO', 'MUNICIPIO', 'DEPARTAMENTO', 'FAMILIARIDAD', 'ASEGURADOR', 'REGIMEN');
        $data=json_decode($reg['data_persona']);
        foreach($data as $temp)
        {
            if($variables[$temp->id]['id_car_tipo_dato']!='4' && $variables[$temp->id]['id_car_tipo_dato']!='9')
            {
                if($variables[$temp->id]['descripcion']=='Tiene animales')
                {
                    var_dump($variables[$temp->id]);
                }
                $cabecera[]= $variables[$temp->id]['descripcion'];
            }
        }
        $data=json_decode($reg['data_tarjeta_familiar']);
        foreach($data as $temp)
        {
            if($variables[$temp->id]['id_car_tipo_dato']!=4 && $variables[$temp->id]['id_car_tipo_dato']!='9')
            {
                if($variables[$temp->id]['descripcion']=='Tiene animales')
                {var_dump($variables[$temp->id]);}
                $cabecera[]= $variables[$temp->id]['descripcion'];
            }
        }
        return $cabecera;
    }
    public function Getxls()
    {
        $inicio=date('H:i:s');
        $this->newestado('Inicio:['.$inicio.']');
        $this->newestado('Exportando data');
        $this->NewData($_GET);
    }
    private function newestado($value,$name='')
    {
        $nombre_archivo = "estado.json"; 
        if($archivo = fopen($nombre_archivo, $this->edit))
        {
            $json=json_decode(file_get_contents($nombre_archivo));
            $json=(is_null($json))?[]:$json;
            $json[]=$value;
            $archivo = fopen($nombre_archivo, 'w+');
            fwrite($archivo,json_encode($json,128));
        }
        $ds=DIRECTORY_SEPARATOR;
        $this->edit='a';
        return '..'.$ds.'..'.$ds.'..'.$ds.'controller'.$ds.$nombre_archivo;        
    }
    private function GeneraCSV($data, $cabecera=false)
    {
        $this->newestado('inicio csv');
        $nombre_archivo = "informe.csv"; 
        if($archivo = fopen($nombre_archivo, "w+"))
        {
            if($cabecera)
            {fwrite($archivo,implode(';',$cabecera). "\n");}
            $this->newestado('Creando CSV');
            $total=count($data);
            foreach($data as $key => $temp)
            {
                fwrite($archivo,implode(';',$temp).  "\n");
            }
            fclose($archivo);
        }
        $this->newestado('Creando exportacion');
        $ds=DIRECTORY_SEPARATOR;
        return '..'.$ds.'..'.$ds.'..'.$ds.'controller'.$ds.$nombre_archivo;
    }
    //=DEBUG=
    private $variable;
    private function OrganizarDatoDebug($Dato, $variable)
    {
        $value = null;
        switch ($Dato['id_tipo_data'])
        {
            case '1':$value = array('descripcion' => $variable, 'valor' => $Dato["value"]);
                break;
            case '4':$value = array(
                'descripcion' => $variable, 
                'valor' => $this->tipe_4(
                    $Dato, 
                    $variable["list_values"]
                ));
                break;
            case '9':
                $Res   = $this->tipe_9($Dato, $variable["list_values"]);
                foreach ($Res as $temp)
                {
                    if (trim($temp["valor"]) !== '')
                        $value[] = $temp;
                }
                break;
            default : $value = array('descripcion' => $variable, 'valor' => $Dato);
                break;
        }
        return $value;
    }
    private function variable($id)
    {
        return $this->variable[$id];
    }
    private function variables()
    {
        $sql       = 'SELECT 
		  `tbl_car_variables`.`id_car_variables`,
		  `tbl_car_variables`.`descripcion`,
		  `tbl_car_variables`.`id_car_tipo_dato`,
		  `tbl_car_variables`.`list_values`
		FROM
          `tbl_car_variables`';
        //Only return multiple files
        if ($sql === '' || is_null($sql))
        {
            throw new Exception('La sentencia esta vacia');
        }
        $rs   = Config::$con->Execute($sql, []);
        $data = array();
        
        while (!$rs->EOF)
        {
            $data_reg = $rs->fields;
            $data[$data_reg['id_car_variables']] = [
                'id_car_variables'=>$data_reg['id_car_variables'],
                'descripcion'=>$data_reg['descripcion'],
                'id_car_tipo_dato'=>$data_reg['id_car_tipo_dato'],
                'list_values'=>$data_reg['list_values']
                ];
            $rs->MoveNext();
        }
        $this->variable = $data;

    }
    private function agregardatosfichadebug(&$data)
    {
        $primeravez = TRUE;
        foreach ($data as $key => $tempdata)
        {
            $datos_variables_tarjeta_familiar = $this->datos_variables_tarjeta_familiar($tempdata[30]);
            $Res                              = array();
            foreach ($datos_variables_tarjeta_familiar as $temp)
            {
                if (is_null($temp["valor"]))
                {
                    $temp["valor"] = 'NN';
                }
                else if ($temp['valor'] == '')
                {
                    $temp["valor"] = 'NN';
                }
                $Res[] = $temp["valor"];
                if ($primeravez)
                {
                    if (isset($temp['descripcion']))
                    {
                        $this->cabecera1[] = $temp['descripcion'];
                    }
                    else
                    {
                        $this->cabecera1[] = 'NN';
                    }
                }
            }
            foreach ($Res as $tempres)
            {
                $data[$key][] = $tempres;
            }
            $primeravez = FALSE;
        }
        return ($data);
    }
    private function agregardatosvariableDebug(&$data)
    {
        $primeravez = TRUE;
        foreach ($data as $key => $tempdata)
        {
            $datos_variables_tarjeta_familiar = $this->datos_variables_tarjeta_familiar($tempdata[30]);
            $datos_persona                    = $this->datos_caracteristicas_persona($tempdata[0]);
            $id                               = array_search($tempdata[2], array_column($datos_persona, 'documento'));
            $Res                              = array();
            foreach ($datos_persona[$id]["caracteristicas_ficha"] as $temp)
            {
                if (is_null($temp["valor"]))
                {
                    $temp["valor"] = 'NN';
                }
                else if ($temp['valor'] == '')
                {
                    $temp["valor"] = 'NN';
                }
                $Res[] = $temp["valor"];
                if ($primeravez)
                {
                    $this->cabecera2[] = $temp['descripcion'];
                }
            }
            foreach ($Res as $tempres)
            {
                $data[$key][] = $tempres;
            }
            $primeravez = FALSE;
        }
        return ($data);
    }
    public function Getxlsdebug()
    {
        $this->variables();
        $inicio=date('H:i:s');
        $model           = new modelexport();
        $data            = $model->exportarDataBug($_GET['fecha_ini'], $_GET['fecha_fin'], $_GET['edad_min'], $_GET['edad_max']);
        $cabecera        = array('CODIGO', 'PERSONA', 'DOCUMENTO', 'EDAD', 'GENERO', 'FECHA NACIMIENTO', 'RANGO', 'CABEZA FAMILIA', 'ESTADO CIVIL', 'NIVEL EDUCATIVO', 'FECHA APERTURA', 'SISBEN FICHA', 'SISBEN PUNTAJE', 'SISBEN NIVEL', 'DIRECCION', 'TELEFONO', 'PORTABILIDAD', 'CAMBIO DOMICILIO', 'PROXIMA VISITA', 'DOCUMENTO ENCARGADO', 'ENCARGADO', 'ZONA', 'VEREDA', 'CORREGIMIENTO', 'MUNICIPIO', 'DEPARTAMENTO', 'FAMILIARIDAD', 'ASEGURADOR', 'REGIMEN');
        $this->cabecera1 = array();
        $this->cabecera2 = array();
        $this->agregardatosfichadebug($data);
        //$this->agregardatosvariableDebug($data);
            echo json_encode(
            //[
            //'tiempo'=>['inicio'=>$inicio,'fin'=> date('H:i:s')],
            //'registros'=>count($data),
            //'data'=>
            $data
            //]
            );
        //$cabecera        = $this->cabecera($cabecera, $this->cabecera1, $this->cabecera2);
        //$this->generarexcel($data);
    }
    //=DEBUG=

    public function Getpdf()
    {
        $this->Iniciar($_GET['c']);
    }

#PDF INICIO

    private function tipe_4($Dato, $list_values)
    {
        if(!is_null($list_values))
        {
            $list_values = json_decode($list_values, true);
            $found_key   = array_search
            (
                $Dato['value'], 
                array_column($list_values, 'id')
            );
            return $list_values[$found_key]['value'];
        }
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
        if(!is_null($list_values['data']))
        {
            foreach ($list_values['data'] as $key1 => $temp1)
            {
                $Res_temp = array();
                foreach ($list_values['option'] as $key2 => $temp2)
                {
                    $name_data = 'data ' . $temp1['id'];
                    $name_opti = 'option ' . $temp2['id'];
                    if (isset($Dato[$name_data][$name_opti]))
                    {
                        $Res_temp['descripcion'] = $temp1['name'] . ', ' . $temp2['name'];
                        $Res_temp['valor']       = $Dato[$name_data][$name_opti];
                        $Resultado_List[]        = $Res_temp;
                    }
                }
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

    private function datos_variables_tarjeta_familiar($Resultado)
    {
        $data      = array();
        $Resultado = json_decode($Resultado, true);
        foreach ($Resultado as $temp)
        {
            $temp1   = $this->variable($temp['id']);
            $tempres = $this->OrganizarDatoDebug($temp, $temp1);
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

    private function data_caracteristica_persona($id_persona)
    {
        $model = new modelexport();
        $value = array();
        $valor = $model->caracteristica_persona($id_persona);
        $valor = json_decode($valor, true);
		if(is_array ($valor))
		{
			foreach ($valor as $temp)
			{
				$descripcion = $this->variable($temp['id']);
				$descripcion = $descripcion['descripcion'];
				$value[]     = array('id' => $temp['id'], 'descripcion' => $descripcion, 'valor' => $temp['value']);
			}
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

    private function Iniciar($id_tarjeta_familiar)//Id tarjeta familiar no es Codigo
    {
        $this->variables                  = modelcategorias::verVariables();
        $model                            = new modelexport();
        $datos_tarjeta_familiar           = $model->datos_tarjeta_familiar($id_tarjeta_familiar);
        $datos_variables_tarjeta_familiar = $this->datos_variables_tarjeta_familiar($id_tarjeta_familiar);
        if (!is_null($datos_variables_tarjeta_familiar))
        {
            $datos_persona   = $this->datos_caracteristicas_persona($id_tarjeta_familiar);
            $pdf             = new ficha_familiar('P', 'mm', 'Letter');
            $pdf->fallecidos = modelpersona::Morbilidad($id_tarjeta_familiar);
            $pdf->render_datos_generales($datos_tarjeta_familiar);
            $pdf->render_datos_variables($datos_variables_tarjeta_familiar);
            $pdf->render_miembros_asociados($datos_persona); //ahora se le debe pasar un segundo parametro, el cual es $data_programas
            //$pdf->Output();
            $pdf->Output('Ficha Familiar.pdf', 'D');
        }
    }

#PDF FIN 
}
