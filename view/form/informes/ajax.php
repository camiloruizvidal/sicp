<?php

$url = '../../../controller/anico_ajax.php?control=export&function=pdf&c=1';
$sex = array('Masculino', 'Femenino');
$Res = array(
    array('nombre' => 'Prueba 1', 'edad' => rand(19, 39), 'url_ficha' => $url, 'sexo' => $sex[rand(0, 1)], 'longitud' => -30.9450198, 'latitud' => 151.259302),
    array('nombre' => 'Prueba 2', 'edad' => rand(19, 39), 'url_ficha' => $url, 'sexo' => $sex[rand(0, 1)], 'longitud' => -30.80010128657071, 'latitud' => 151.28747820854187),
    array('nombre' => 'Prueba 3', 'edad' => rand(19, 39), 'url_ficha' => $url, 'sexo' => $sex[rand(0, 1)], 'longitud' => -30.828249, 'latitud' => 151.157507),
    array('nombre' => 'Prueba 4', 'edad' => rand(19, 39), 'url_ficha' => $url, 'sexo' => $sex[rand(0, 1)], 'longitud' => -30.890542, 'latitud' => 151.274856),
    array('nombre' => 'Prueba 5', 'edad' => rand(19, 39), 'url_ficha' => $url, 'sexo' => $sex[rand(0, 1)], 'longitud' => -30.923036, 'latitud' => 151.259052),
    array('nombre' => 'Prueba 6', 'edad' => rand(19, 39), 'url_ficha' => $url, 'sexo' => $sex[rand(0, 1)], 'longitud' => -30.950198, 'latitud' => 151.59302)
);
foreach ($Res as $key => $temp)
{
    $text   = '<span class="title">' . $temp['nombre'] . '</span>' .
            '<ul class="data_maps">' .
            '<li><strong>Edad </strong><i>' . $temp['edad'] . '</i></li>' .
            '<li><strong>Sexo </strong><i>' . $temp['sexo'] . '</i></li>' .
            '<li><a href="' . $temp['url_ficha'] . '"><i class="fa fa-cloud-download" aria-hidden="true"></i> Ficha familiar</a></li>' .
            '</ul>';
    $data[] = array
        (
        $text,
        $temp['longitud'],
        $temp['latitud']
    );
}
echo json_encode(array('success' => true, 'data' => $data, 'longitud' => -30.92, 'latitud' => 151.40, 'zoom' => 10));
?>