<?php

class other
{

    public static function is_json($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
	private function bisiesto($a){return true;}
    public function calcularEdad($fecha, $fecha_actual = '')
    {
        if ($fecha_actual == '')
        {
            $fecha_actual = date("Y-m-d");
        }
        $fecha_de_nacimiento = $fecha;
        $array_nacimiento    = explode("-", $fecha_de_nacimiento);
        $array_actual        = explode("-", $fecha_actual);
        $anos                = $array_actual[0] - $array_nacimiento[0]; // calculamos años 
        $meses               = $array_actual[1] - $array_nacimiento[1]; // calculamos meses 
        $dias                = $array_actual[2] - $array_nacimiento[2]; // calculamos días 
        if ($dias < 0)
        {
            --$meses;
            switch ($array_actual[1])
            {
                case 1: $dias_mes_anterior = 31;
                    break;
                case 2: $dias_mes_anterior = 31;
                    break;
                case 3:
                    if (bisiesto($array_actual[0]))
                    {
                        $dias_mes_anterior = 29;
                        break;
                    }
                    else
                    {
                        $dias_mes_anterior = 28;
                        break;
                    }
                case 4: $dias_mes_anterior = 31;
                    break;
                case 5: $dias_mes_anterior = 30;
                    break;
                case 6: $dias_mes_anterior = 31;
                    break;
                case 7: $dias_mes_anterior = 30;
                    break;
                case 8: $dias_mes_anterior = 31;
                    break;
                case 9: $dias_mes_anterior = 31;
                    break;
                case 10: $dias_mes_anterior = 30;
                    break;
                case 11: $dias_mes_anterior = 31;
                    break;
                case 12: $dias_mes_anterior = 30;
                    break;
            }
            $dias = $dias + $dias_mes_anterior;
        }
        if ($meses < 0)
        {
            --$anos;
            $meses = $meses + 12;
        }
        return array('year' => $anos, 'months' => $meses, 'days' => $dias);
    }

    public static function calcularedad_fecha($fecha)
    {
        $data = new other();
        return $data->calcularEdad($fecha);
    }

    public function Postcalcularedad()
    {
        $data = $this->calcularEdad($_POST['edad']);
        echo self::echo_json(array('year' => $data['year'], 'months' => $data['months'], 'days' => $data['days']));
    }

    private function bisiesto($anio_actual)
    {
        $bisiesto = false;
        //probamos si el mes de febrero del año actual tiene 29 días 
        if (checkdate(2, 29, $anio_actual))
        {
            $bisiesto = true;
        }
        return $bisiesto;
    }

    public function tipo_dato($key)
    {
        $tipo_dato = model::Make('tbl_car_variables');
        $tipo_dato->Load('id_car_variables=?', array($key));
        return $tipo_dato->id_car_tipo_dato;
    }

    public function format_reg($data)
    {
        $res = array();
        foreach ($data as $key => $temp)
        {
            $key   = str_replace('input_', '', $key);
            $temp2 = array(
                'id'           => $key,
                'value'        => $temp,
                'id_tipo_data' => $this->tipo_dato($key)
            );
            $res[] = $temp2;
        }
        return $res;
    }

    public static function echo_json($data)
    {
        return json_encode($data, 128);
    }

    public static function echo_json_decode($data)
    {
        return json_decode($data, true);
    }

}
