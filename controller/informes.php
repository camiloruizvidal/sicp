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

}
