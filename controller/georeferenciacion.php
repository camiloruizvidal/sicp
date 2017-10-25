<?php

include_once dirname(__FILE__) . '../../base.php';

class georeferenciacion
{

    public function Postdatos()
    {
        include_once '..' . DIRECTORY_SEPARATOR . 'base.php';
        include Config::$model . 'modelficha.php';
        $Data              = modelficha::geodatos($_POST);
        $url               = '../../../controller/anico_ajax.php?control=export&function=pdf&c=';
        $Res               = array();
        $promedio_longitud = 0;
        $promedio_latitud  = 0;
        foreach ($Data as $temp)
        {
            $promedio_latitud += (double) $temp['posicion_latitud'];
            $promedio_longitud += (double) $temp['posicion_longitud'];
            $Res[] = array(
                'nombre'    => $temp['persona'],
                'edad'      => $temp['edad'],
                'url_ficha' => $url . $temp['id_tarjeta_familiar'],
                'sexo'      => $temp['sexo'],
                'longitud'  => $temp['posicion_longitud'],
                'latitud'   => $temp['posicion_latitud']
            );
        }
        $promedio_latitud  = ($promedio_latitud / count($Data));
        $promedio_longitud = ($promedio_longitud / count($Data));
        foreach ($Res as $key => $temp)
        {
            $text   = '<span class="title">' . $temp['nombre'] . '</span>' .
                    '<ul class="data_maps">' .
                    '<li><strong>Edad </strong><i>' . $temp['edad'] . '</i></li>' .
                    '<li><strong>Sexo </strong><i>' . $temp['sexo'] . '</i></li>' .
                    '<li><a href="' . $temp['url_ficha'] . '"><i class="fa fa-cloud-download" aria-hidden="true"></i> Ficha familiar</a></li>' .
                    '</ul>';
            $data[] = array($text, $temp['longitud'], $temp['latitud']);
        }
        echo json_encode(array('success' => true, 'data' => $data, 'longitud' => $promedio_longitud, 'latitud' => $promedio_latitud, 'zoom' => 15));
    }

    public function Getsaveexcel()
    {
        include_once Config::$Controller . 'export.php';
        $exl  = new export();
        $data = array(
            array(rand(1, 30), rand(1, 30), rand(1, 30), rand(1, 30), rand(1, 30)),
            array(rand(1, 30), rand(1, 30), rand(1, 30), rand(1, 30), rand(1, 30)),
            array(rand(1, 30), rand(1, 30), rand(1, 30), rand(1, 30), rand(1, 30)),
            array(rand(1, 30), rand(1, 30), rand(1, 30), rand(1, 30), rand(1, 30)),
            array(rand(1, 30), rand(1, 30), rand(1, 30), rand(1, 30), rand(1, 30)),
            array(rand(1, 30), rand(1, 30), rand(1, 30), rand(1, 30), rand(1, 30)),
            array(rand(1, 30), rand(1, 30), rand(1, 30), rand(1, 30), rand(1, 30))
        );
        $img  = '';
        $exl->generarexcel($data, '', 'imagen.xlsx', 'https://maps.googleapis.com/maps/api/staticmap?center=2.4590389,-76.6364065&zoom=15&size=500x400&maptype=hybrid&markers=color:red%7Clabel:o%7C2.4590389,-76.63640649999999&key=AIzaSyD1Jc53ZYuZgWMNoYHTBbXVQQdc8V0F6Eo');
    }

}
