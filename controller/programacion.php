<?php

include_once dirname(__FILE__) . '/../base.php';
include_once Config::$model . 'modelprogramacion.php';
include_once Config::$model . 'modelpersona.php';

class programacion
{

    private function VerProgramas($temp, $Edad)
    {
        $Pro  = new modelprogramacion();
        $Data = $Pro->VariablesPrograma($temp['id_car_programas'], $_POST['sexo'], $Edad);
        $Res  = NULL;
        if (count($Data) > 0)
        {
            $Res = array('name' => $temp['descripcion'], 'value' => $Data);
        }
        return $Res;
    }

    private function RenderProgramas($data)
    {
        echo '<pre>';
        echo '<table border="1" width="100%">';
        echo '<tr>';
        echo '<td>';
        echo '<strong>PROGRAMA</strong>';
        echo '</td>';
        echo '<td>';
        echo '<strong>DESCRIPCION</strong>';
        echo '</td>';
        echo '</tr>';
        foreach ($data as $temp)
        {
            echo '<td>';
            echo $temp['name'];
            echo '</td>';
            echo '<td>';
            echo '<table border="1" width="100%">';
            echo '<tr>';
            echo '<td><strong>Actividad</strong></td>';
            echo '<td><strong>Edad</strong></td>';
            echo '<td><strong>Dosis</strong></td>';
            echo '<td><strong>Intervalo</strong></td>';
            echo '</tr>';
            foreach ($temp['value'] as $temp2)
            {
                echo '<tr>';
                echo '<td width="61%">';
                echo $temp2['descripcion'];
                echo '</td>';
                echo '<td width="13%">';
                if ($temp2['rango_inicio'] == $temp2['rango_fin'])
                {
                    echo $temp2['rango_inicio'];
                }
                else
                {
                    echo $temp2['rango_inicio'] . ' a ' . $temp2['rango_fin'];
                }
                echo ' ' . $temp2['rango_tipo'];
                echo '</td>';
                echo '<td width="13%">';
                echo $temp2['dosis'];
                echo '</td>';
                echo '<td width="13%">';
                echo $temp2['intervalo'] . ' al ';
                echo $temp2['intervalo_tipo'];
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    public function Postverdetalles()
    {
        $Pro       = new modelprogramacion();
        $cal       = new other();
        $persona   = modelpersona::verpersona_id($_POST['id_persona']);
        $Edad      = $cal->calcularedad_fecha($persona['fecha_nacimiento']);
        $Programas = $Pro->VerProgramas();
        $data      = array();
        foreach ($Programas as $key => $temp)
        {
            $temp1 = $this->VerProgramas($temp, $Edad);
            if (!is_null($temp1))
            {
                $data[] = $temp1;
            }
        }
        echo $this->RenderProgramas($data);
    }

}

?>