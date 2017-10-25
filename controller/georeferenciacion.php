<?php

include_once dirname(__FILE__) . '../../base.php';

class georeferenciacion
{

    private function datos_filter($post)
    {
        include_once '..' . DIRECTORY_SEPARATOR . 'base.php';
        include Config::$model . 'modelficha.php';
        $Resutado          = array('longitud' => '', 'latitud' => '', 'data' => false);
        $Data              = modelficha::geodatos($post);
        $url               = '../../../controller/anico_ajax.php?control=export&function=pdf&c=';
        $Res               = array();
        $promedio_longitud = 0;
        $promedio_latitud  = 0;
        if (count($Data) > 0)
        {
            foreach ($Data as $temp)
            {
                $promedio_latitud += (isset($temp['posicion_latitud'])) ? (double) $temp['posicion_latitud'] : null;
                $promedio_longitud += (isset($temp['posicion_longitud'])) ? (double) $temp['posicion_longitud'] : null;
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
            $Resutado['longitud'] = $promedio_longitud;
            $Resutado['latitud']  = $promedio_latitud;
            $Resutado['data']     = $data;
        }
        return $Resutado;
    }

    public function Postdatos()
    {
        $data = $this->datos_filter($_POST);
        echo json_encode(array('success' => ($data['data'] === FALSE) ? false : true, 'data' => $data['data'], 'longitud' => $data['longitud'], 'latitud' => $data['latitud'], 'zoom' => 15), 128);
    }

    public function Getsaveexcel()
    {
        $Res = array();
        foreach ($_GET['data'] as $key => $temp)
        {
            if ($key != 'url')
            {
                $Res[] = ($key . '=' . $temp);
            }
        }
        $img  = $_GET['data']['url'] . '?' . implode('&', $Res);
        include_once Config::$Controller . 'export.php';
        $exl  = new export();
        $data = modelficha::geodatosgeo($_GET);
        $exl->generarexcel($data, array('Ubicacion', 'Nombre', 'Edad', 'Genero'), 'imagen.xlsx', $img);
    }

}
