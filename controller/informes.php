<?php

include_once dirname(__FILE__) . '/../base.php';
include_once Config::$model . 'modelinformes.php';
include_once Config::$Controller . 'visual.php';
include_once Config::$Controller . 'other.php';

class informes
{

    public static function registros($fecha_ini = '', $fecha_fin = '', $edad_min = '', $edad_max = '', $tarjeta_familiar = '')
    {
        $Reg   = new modelinformes();
        $Datos = $Reg->Registros($fecha_ini, $fecha_fin, $edad_min, $edad_max, $tarjeta_familiar);
        foreach ($Datos as $key => $temp)
        {
            $codigo             = ltrim($temp['codigo'], '0');
            $sql                = 'SELECT 
                `tbl_tarjeta_familiar`.`id_tarjeta_familiar`
              FROM
                `tbl_tarjeta_familiar`
              WHERE
                `tbl_tarjeta_familiar`.`codigo` = ?';
            $Res                = model::Record($sql, array($codigo));
            $id                 = ($Res["id_tarjeta_familiar"]);
            $txt                = other::calcularedad_fecha($temp['fecha_nacimiento']);
            //$temp['id_persona'] = '<div class="btn-group" role="group"><a target="_blank" href="../ajaxexport/pdf?c=' . $temp['id_persona'] . '" class="btn btn-danger" ><i class="fa fa-file-pdf-o"></i></a><a target="_blank" href="../ajaxexport/xls?c=' . $temp['id_persona'] . '" class="btn btn-success"><i class="fa fa-file-excel-o"></i></a></div>';
            $temp['id_persona'] = '<div class = "btn-group" role = "group">
            <button type = "button" class = "btn btn-default dropdown-toggle" data-toggle = "dropdown" aria-expanded = "false">
            <i class="fa fa-cloud-download"></i> Descargar<span class = "caret"></span>
            </button>
            <ul class = "dropdown-menu" role = "menu">
            <li><a href="../../../controller/anico_ajax.php?control=export&function=pdf&c=' . $id . '">Ficha familiar</a></li>            
            </ul>
            </div>';

            $temp['fecha_nacimiento'] = '' . $txt['year'] . ' Años, ' . $txt['months'] . ' Meses, ' . $txt['days'] . ' Dias';
            $Datos[$key]              = $temp;
        }
        $render = new visual();
        echo $render->Tabla($Datos, '', array('Fecha registro', 'Nombre', 'Documento', 'Codigo', 'Sexo', 'Edad', 'Edad', 'Municipio', 'Departamento', 'Descargar'), '', 'myTable');
    }

    public function Postregistros()
    {
        if (!isset($_POST['codigo']))
        {
            $_POST['codigo'] = '';
        }
        self::Registros($_POST['fecha_ini'], $_POST['fecha_fin'], $_POST['edad_min'], $_POST['edad_max'], $_POST['codigo']);
    }

    public function render_registro_grafico($data, $categorias,$variables='')
    {
        $registros = array();
        foreach ($data as $temp)
        {
            if(in_array($temp['id'], $variables))
            {
                $key                        = array_search($temp['id'], array_column($categorias, 'id'));
                if($key!==FALSE)
                {
                    $temp2                      = array();
                    $temp2['name']              = $categorias[$key]['value'];
                    $temp2['data']              = $temp['value'];   
                    $temp2['id_tipo_dato']      = $categorias[$key]['id_car_tipo_dato'];   
                    $temp2['id_tipo_dato']      = $categorias[$key]['id_car_tipo_dato'];   
                    $temp2['nombre_tipo_dato']  = $categorias[$key]['tipo_dato'];
                    if($temp2['data']!='')
                    {
                        $registros[]    = $temp2;
                        unset($temp2);
                    }
                }
            }
        }
        return $registros;
    }

    public function datacategorias($categorias,$genero='',$municipio='')
    {
        $reg  = new modelinformes();
        $data = $reg->datacategorias($categorias);
        return $data;
    }

    public function SumRegistros(&$data)
    {
        $Res = array();
        foreach ($data as $temp)
        {
            $key = array_search($temp['name'], array_column($Res, 'name'));
            if ($key === FALSE)
            {
                $Res[] = ['name' => $temp['name'], 'data' => 0];
            }
            $key                = array_search($temp['name'], array_column($Res, 'name'));
            switch ($temp['id_tipo_dato'])
            {
                case '1':
                    $Res[$key]['data'] = $Res[$key]['data'] + $temp['data'];

                break;
                case '5':
                    $Res[$key]['data'] = $Res[$key]['data'] + $temp['data'];
                break;

                default:
                    $Res[$key]['data'] = $Res[$key]['data'] + $temp['data'];
                break;
            }
        }
        $resfinish=[];
        foreach($Res as $key => $temp)
        {
            $resfinish[]=
            [
                /*
                $temp['name'],
                $temp['data'],*/
                'y'=>$temp['data'],
                'name'=>$temp['name']
            ];
        }
        $data = $resfinish;
    }

    public function Postgraficos()
    {
        extract($_POST);
        $res        = array();
        $categorias = $this->datacategorias($_POST['categoria']);
        $reg        = new modelinformes();
        $municipio=(isset($_POST['municipio']))?$municipio:'';
        $data       = $reg->data($edad_minima, $edad_maxima, $sexo, $departamento, $municipio);
        foreach ($data as $temp)
        {
            $temp2 = $this->render_registro_grafico(json_decode($temp['value'], TRUE), $categorias,$variables);
            foreach ($temp2 as $temp3)
            {
                array_push($res, $temp3);
            }
        }

        $this->SumRegistros($res);
        $resultado=['registros'=>$res];
        echo json_encode($resultado,128);
    }
    public function Postdata()
    {
        $categorias = $this->datacategorias($_POST['categoria']);
        foreach($categorias as $temp)
        {
            echo '<label  onclick="buscar()"><input name="variables[]" type="checkbox" value="'.$temp['id'].'" checked>'.$temp['value'].'</label><br/>'."\n";
        }
    }
    public function Postvercategorias()
    {
        $data =modelinformes::VerCategorias();
        echo '<option name="variables[]" value="">Seleccione</option>'."\n";
        foreach($data as $temp)
        {
            echo '<option value="'.$temp['id_car_categoria'].'">'.$temp['categoria'].'</option>'."\n";
        }
    }
    private function regimen_afiliacion($edad_minima='',$edad_maxima='',$sexo='',$departamento='',$municipio='')
    {
        $wheres=[];
        $parameters=[];
        if($edad_minima!='')
        {  
            $wheres[]=' TIMESTAMPDIFF(YEAR,`tbl_persona`.`fecha_nacimiento`,NOW())>=? ';
            $parameters[]=$edad_minima;
        }
        if($edad_maxima!='')
        {  
            $wheres[]=' TIMESTAMPDIFF(YEAR,`tbl_persona`.`fecha_nacimiento`,NOW())<=? ';
            $parameters[]=$edad_maxima;
        }
        if($sexo!='')
        {
            $wheres[]=' `tbl_persona`.`sexo` = ?';
            $parameters[]=$sexo;
        }
        if($municipio!='')
        {
            $wheres[]=' `tbl_municipios`.`id_municipio` = ?';
            $parameters[]=$municipio;
        }
        if($departamento!='')
        {
            $wheres[]=' `tbl_municipios`.`id_departamento` = ?';
            $parameters[]=$departamento;
        }
        $where=(count($wheres)>0)?' WHERE '.implode(' AND ', $wheres):'';
        $sql = 'SELECT 
              count(*) as y,
              COALESCE(`tbl_regimen`.`descripcion`,"-") as name
            FROM
              `tbl_persona`
              LEFT OUTER JOIN `tbl_regimen` ON (`tbl_persona`.`id_regimen` = `tbl_regimen`.`id_regimen`)
              INNER JOIN `tbl_tarjeta_familiar` ON (`tbl_persona`.`id_tarjeta_familiar` = `tbl_tarjeta_familiar`.`id_tarjeta_familiar`)
              INNER JOIN `tbl_municipios` ON (`tbl_tarjeta_familiar`.`id_municipio` = `tbl_municipios`.`id_municipio`)
              '.$where.'
              GROUP BY
              `tbl_regimen`.`id_regimen`

            ORDER BY
              `tbl_regimen`.`descripcion`';
        $Res = model::Records($sql, $parameters);
        return $Res;
    }
    private function EPS($edad_minima='',$edad_maxima='',$sexo='',$departamento='',$municipio='')
    {
        $wheres=[];
        $parameters=[];
        if($edad_minima!='')
        {  
            $wheres[]=' TIMESTAMPDIFF(YEAR,`tbl_persona`.`fecha_nacimiento`,NOW())>=? ';
            $parameters[]=$edad_minima;
        }
        if($edad_maxima!='')
        {  
            $wheres[]=' TIMESTAMPDIFF(YEAR,`tbl_persona`.`fecha_nacimiento`,NOW())<=? ';
            $parameters[]=$edad_maxima;
        }
        if($sexo!='')
        {
            $wheres[]=' `tbl_persona`.`sexo` = ?';
            $parameters[]=$sexo;
        }
        if($municipio!='')
        {
            $wheres[]=' `tbl_municipios`.`id_municipio` = ?';
            $parameters[]=$municipio;
        }
        if($departamento!='')
        {
            $wheres[]=' `tbl_municipios`.`id_departamento` = ?';
            $parameters[]=$departamento;
        }
        $where=(count($wheres)>0)?' WHERE '.implode(' AND ', $wheres):'';
        $sql = 'SELECT 
              count(*) AS `y`,
              `tbl_asegurador`.`descripcion` as name
            FROM
              `tbl_persona`
              INNER JOIN `tbl_tarjeta_familiar` ON (`tbl_persona`.`id_tarjeta_familiar` = `tbl_tarjeta_familiar`.`id_tarjeta_familiar`)
              INNER JOIN `tbl_municipios` ON (`tbl_tarjeta_familiar`.`id_municipio` = `tbl_municipios`.`id_municipio`)
              INNER JOIN `tbl_asegurador` ON (`tbl_persona`.`id_asegurador` = `tbl_asegurador`.`id_asegurador`)
            '.$where.'
            GROUP BY
              `tbl_asegurador`.`id_asegurador`
            ORDER BY
              `tbl_asegurador`.`id_asegurador`';
        $Res = model::Records($sql, $parameters);
        return $Res;
    }
    private function RIESGOS_FAMILIARES($edad_minima='',$edad_maxima='',$sexo='',$departamento='',$municipio='')
    {
        $wheres=[];
        $parameters=[];
        if($edad_minima!='')
        {  
            $wheres[]=' TIMESTAMPDIFF(YEAR,`tbl_persona`.`fecha_nacimiento`,NOW())>=? ';
            $parameters[]=$edad_minima;
        }
        if($edad_maxima!='')
        {  
            $wheres[]=' TIMESTAMPDIFF(YEAR,`tbl_persona`.`fecha_nacimiento`,NOW())<=? ';
            $parameters[]=$edad_maxima;
        }
        if($sexo!='')
        {
            $wheres[]=' `tbl_persona`.`sexo` = ?';
            $parameters[]=$sexo;
        }
        if($municipio!='')
        {
            $wheres[]=' `tbl_municipios`.`id_municipio` = ?';
            $parameters[]=$municipio;
        }
        if($departamento!='')
        {
            $wheres[]=' `tbl_municipios`.`id_departamento` = ?';
            $parameters[]=$departamento;
        }
        $where=(count($wheres)>0)?' WHERE '.implode(' AND ', $wheres):'';
        $sql = 'SELECT 
              count(*) as y,
              COALESCE(`tbl_regimen`.`descripcion`,"-") as name
            FROM
              `tbl_persona`
              LEFT OUTER JOIN `tbl_regimen` ON (`tbl_persona`.`id_regimen` = `tbl_regimen`.`id_regimen`)
              INNER JOIN `tbl_tarjeta_familiar` ON (`tbl_persona`.`id_tarjeta_familiar` = `tbl_tarjeta_familiar`.`id_tarjeta_familiar`)
              INNER JOIN `tbl_municipios` ON (`tbl_tarjeta_familiar`.`id_municipio` = `tbl_municipios`.`id_municipio`)
              '.$where.'
              GROUP BY
              `tbl_regimen`.`id_regimen`

            ORDER BY
              `tbl_regimen`.`descripcion`';
        $Res = model::Records($sql, $parameters);
        return $Res;
    }
    private function RIESGOS_AMBIENTALES($edad_minima='',$edad_maxima='',$sexo='',$departamento='',$municipio='')
    {
                $wheres=[];
        $parameters=[];
        if($edad_minima!='')
        {  
            $wheres[]=' TIMESTAMPDIFF(YEAR,`tbl_persona`.`fecha_nacimiento`,NOW())>=? ';
            $parameters[]=$edad_minima;
        }
        if($edad_maxima!='')
        {  
            $wheres[]=' TIMESTAMPDIFF(YEAR,`tbl_persona`.`fecha_nacimiento`,NOW())<=? ';
            $parameters[]=$edad_maxima;
        }
        if($sexo!='')
        {
            $wheres[]=' `tbl_persona`.`sexo` = ?';
            $parameters[]=$sexo;
        }
        if($municipio!='')
        {
            $wheres[]=' `tbl_municipios`.`id_municipio` = ?';
            $parameters[]=$municipio;
        }
        if($departamento!='')
        {
            $wheres[]=' `tbl_municipios`.`id_departamento` = ?';
            $parameters[]=$departamento;
        }
        $where=(count($wheres)>0)?' WHERE '.implode(' AND ', $wheres):'';
        $sql = 'SELECT 
                  trim(`tbl_car_registro`.`value`) as value
                FROM
                  `tbl_tarjeta_familiar`
                INNER JOIN `tbl_car_registro` ON (`tbl_tarjeta_familiar`.`id_tarjeta_familiar` = `tbl_car_registro`.`id_tarjeta_familiar`)
                INNER JOIN `tbl_municipios` ON (`tbl_tarjeta_familiar`.`id_municipio` = `tbl_municipios`.`id_municipio`)
  ';
        $Res = model::Records($sql, $parameters);
        $Res = $this->format_data($Res);
        return $Res;
    }
    private function format_data($data_value)
    {
        $Res=[];
        foreach($data_value as $data)
        {
            $data=$data["value"];
            foreach(json_decode($data,true) as $temp)
            {
                switch ($temp['id_tipo_data'])
                {
                    case '4':
                    $Res[$temp['id']]
                            =
                            (isset($Res[$temp['id']]))
                                ?
                            $Res[$temp['id']]+$temp['value']
                                :
                            $temp['value'];
                        break;
                    case '1':
                    $Res[$temp['id']]
                            =
                            ($temp['value']!='no')
                                ?
                            (
                                isset($Res[$temp['id']])
                                    ?
                                $Res[$temp['id']]+1
                                    :
                                1
                            )
                                :
                            0;
                        break;
                }
            }
        }
        $Res=$this->orderData($Res);
        return $Res;
    }
    private function name($key)
    {
        $sql = 'SELECT 
              UPPER(`tbl_car_variables`.`descripcion`) as name
            FROM
              `tbl_car_variables`
              WHERE
                `tbl_car_variables`.`id_car_variables`=?';
        $Res = model::Record($sql, $key);
        return $Res['name'];
    }
    private function orderData($data)
    {
        $Res=[];
        foreach($data as $key=>$temp)
        {
            if($temp!='0')
            {
                $temp2['y']=(int)$temp;
                $temp2['name']=$this->name($key);
                $Res[]=$temp2;
            }
        }
        return $Res;
    }
    private function RIESGOS_INDIVIDUALES($edad_minima='',$edad_maxima='',$sexo='',$departamento='',$municipio='')
    {
             $wheres=[];
        $parameters=[];
        if($edad_minima!='')
        {  
            $wheres[]=' TIMESTAMPDIFF(YEAR,`tbl_persona`.`fecha_nacimiento`,NOW())>=? ';
            $parameters[]=$edad_minima;
        }
        if($edad_maxima!='')
        {  
            $wheres[]=' TIMESTAMPDIFF(YEAR,`tbl_persona`.`fecha_nacimiento`,NOW())<=? ';
            $parameters[]=$edad_maxima;
        }
        if($sexo!='')
        {
            $wheres[]=' `tbl_persona`.`sexo` = ?';
            $parameters[]=$sexo;
        }
        if($municipio!='')
        {
            $wheres[]=' `tbl_municipios`.`id_municipio` = ?';
            $parameters[]=$municipio;
        }
        if($departamento!='')
        {
            $wheres[]=' `tbl_municipios`.`id_departamento` = ?';
            $parameters[]=$departamento;
        }
        $where=(count($wheres)>0)?implode(' AND ', $wheres):'';
        $sql = 'SELECT 
              count(*) as y,
              COALESCE(`tbl_regimen`.`descripcion`,"-") as name
            FROM
              `tbl_persona`
              LEFT OUTER JOIN `tbl_regimen` ON (`tbl_persona`.`id_regimen` = `tbl_regimen`.`id_regimen`)
              INNER JOIN `tbl_tarjeta_familiar` ON (`tbl_persona`.`id_tarjeta_familiar` = `tbl_tarjeta_familiar`.`id_tarjeta_familiar`)
              INNER JOIN `tbl_municipios` ON (`tbl_tarjeta_familiar`.`id_municipio` = `tbl_municipios`.`id_municipio`)
              '.$where.'
              GROUP BY
              `tbl_regimen`.`id_regimen`

            ORDER BY
              `tbl_regimen`.`descripcion`';
        $Res = model::Records($sql, $parameters);
        return $Res;   
    }

    public function Postgraficos2()
    {
        $data=NULL;
        switch($_POST["categoria"])
        {
            case '1' : $data = $this->regimen_afiliacion($_POST['edad_minima'],$_POST['edad_maxima'],$_POST['sexo'],$_POST['departamento'],$_POST['municipio']); break;
            case '2' : $data = $this->EPS($_POST['edad_minima'],$_POST['edad_maxima'],$_POST['sexo'],$_POST['departamento'],$_POST['municipio']); break;
            case '3' : $data = $this->RIESGOS_FAMILIARES($_POST['edad_minima'],$_POST['edad_maxima'],$_POST['sexo'],$_POST['departamento'],$_POST['municipio']); break;
            case '4' : $data = $this->RIESGOS_AMBIENTALES($_POST['edad_minima'],$_POST['edad_maxima'],$_POST['sexo'],$_POST['departamento'],$_POST['municipio']); break;
            case '5' : $data = $this->RIESGOS_INDIVIDUALES($_POST['edad_minima'],$_POST['edad_maxima'],$_POST['sexo'],$_POST['departamento'],$_POST['municipio']); break;     
        }
        $Res=[];
        if(!is_null($data))
        {
            foreach($data as $temp)
            {
                $temp2['y']     = (int)$temp['y'];
                $temp2['name']  = $temp['name'];
                $Res[]          = $temp2;
            }
        }
        echo json_encode(['registros'=>$Res],128);
    }

}
