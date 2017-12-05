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

}
