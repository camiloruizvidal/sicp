<?php

class formulario
{

    public $col_md;

    public function __construct()
    {
        //$this->col_md = 'col-md-4';
    }

    private function si_no($data)
    {
        $name = 'input_' . $data['id_car_variables'];
        $html = '<label>
                <input value="no" type="hidden" name="' . $name . '">
                <input value="si" type="checkbox" name="' . $name . '" id="' . $name . '">
                 ' . $data['descripcion'] . '
                </label>';
        return $html;
    }

    private function Texto_corto($data)
    {
        $name = 'input_' . $data['id_car_variables'];
        $html = '';
        $html = '<label>' . $data['descripcion'] . '</label><input type = "text" id = "' . $name . '" name = "' . $name . '" class = "form form-control"/>';
        return $html;
    }

    private function Texto_Largo_Enriquecido($data)
    {
        //$this->col_md = 'col-md-12';
        $name = 'input_' . $data['id_car_variables'];
        $html = '';
        $html = '<label>' . $data['descripcion'] . '</label><textarea id = "' . $name . '" name = "' . $name . '" class = "form form-control"></textarea>';
        return $html;
    }

    private function Lista_valores($data)
    {
        $res  = json_decode($data['list_values'], TRUE);
        $name = 'input_' . $data['id_car_variables'];
        $html = '<label>' . $data['descripcion'] . '</label>';
        $html.='<select class = "form form-control" id = "' . $name . '" name = "' . $name . '">';
        foreach ($res as $temp)
        {
            $html.='<option value = "' . $temp['id'] . '">' . $temp['value'] . '</option>';
        }
        $html.='</select>';
        return $html;
    }

    private function Entero($data)
    {
        $name = 'input_' . $data['id_car_variables'];
        $html = '<label>' . $data['descripcion'] . '</label><input type = "number" id = "' . $name . '" name = "' . $name . '" class = "form form-control"/>';
        return $html;
    }

    private function Double($data)
    {
        $name = 'input_' . $data['id_car_variables'];
        $html = '<label>' . $data['descripcion'] . '</label><input type = "number" id = "' . $name . '" name = "' . $name . '" class = "form form-control"/>';
        return $html;
    }

    private function Fecha($data)
    {
        $name = 'input_' . $data['id_car_variables'];
        $html = '<label>' . $data['descripcion'] . '</label><input type = "text" id = "' . $name . '" name = "' . $name . '" class = "form form-control fecha"/>';
        return $html;
    }

    private function Hora($data)
    {
        
    }

    private function Si_multiple($data)
    {
        $Res       = json_decode($data['list_values'], true);
        $option    = ($Res['option']);
        $values    = ($Res['data']);
        $inputname = 'input_' . $data['id_car_variables'];
        $html      = '<div class="container-alt">' . "\n"
                . '<table border="1" width="100%">' . "\n";
        $html.='<tr>' . "\n";
        $html.='<td>' . "\n";
        $html.='</td>' . "\n";
        foreach ($option as $temp)
        {
            $html.='<td>' . "\n";
            $html.=$temp['name'];
            $html.='</td>' . "\n";
        }
        $html.='</tr>' . "\n";
        foreach ($values as $temp)
        {
            $html.='<tr>' . "\n";
            $html.='<td>' . "\n";
            $html.='<label>' . "\n";
            $html.=$temp["name"] . "\n";
            $name1 = $inputname . '[' . $temp['id'] . ']';
            $html.='<input data-id = "' . $temp['id'] . '" type = "checkbox" value = "si" class = "check_multiple" name = "' . $name1 . '"></label>' . "\n";
            $html.='</label>' . "\n";
            $html.='<input type = "hidden" value = "no" name = "' . $name1 . '">' . "\n";
            $html.='</td>' . "\n";
            foreach ($option as $temp1)
            {
                $html.='<td>' . "\n";
                if ($temp1["name"] == '¿vacunas?')
                {
                    if (is_null($temp['list']))
                    {
                        $inputname2 = $name1 . '[data_' . $temp['id'] . '][option_' . $temp1['id'] . ']';
                        $html.='<div class="checkbox"><input data-id = "' . $temp['id'] . '" data-option = "' . $temp1['id'] . '" class="form form-control" type="text" id="data' . $temp['id'] . '_option' . $temp1['id'] . '" name="' . $inputname2 . '">' . "\n</div>";
                    }
                    else
                    {
                        if (isset($temp['list']) && is_array($temp['list']))
                        {
                            foreach ($temp['list'] as $temp2)
                            {
                                $inputname2 = $name1 . '[data_' . $temp['id'] . '][option_' . $temp1['id'] . ']';
                                $html.='<label><input type="checkbox" data-id = "' . $temp['id'] . '" data-option = "' . $temp1['id'] . '"  id="data' . $temp['id'] . '_option' . $temp1['id'] . '" name="'.$inputname2.'[list][]" value="' . $temp2 . '">' . $temp2 . '</label><br/>' . "\n";
                            }
                        }
                    }
                }
                else
                {
                    $inputname2 = $name1 . '[data_' . $temp['id'] . '][option_' . $temp1['id'] . ']';
                    $html.='<input data-id = "' . $temp['id'] . '" data-option = "' . $temp1['id'] . '" class = "form form-control" type = "text" id = "data' . $temp['id'] . '_option' . $temp1['id'] . '" placeholder = "' . $temp1['name'] . '" name = "' . $inputname2 . '">' . "\n";
                }
                $html.='</td>' . "\n";
            }
            $html.='</tr>' . "\n";
        }
        $html.='</table>' . "\n";
        $html.='</div>' . "\n";
        $this->col_md = 'col-md-4';
        return $html;
    }

    private function Si_No_otro($data)
    {
        
    }

    private function TipoDatohtml($data)
    {
        if ($data['id_car_variables'] == '90')
        {
            $this->col_md = 'col-md-12';
        }
        $html = '';
        switch ($data['id_car_tipo_dato'])
        {
            case '1': $html = $this->si_no($data);
                break;
            case '2': $html = $this->Texto_corto($data);
                break;
            case '3': $html = $this->Texto_Largo_Enriquecido($data);
                break;
            case '4': $html = $this->Lista_valores($data);
                break;
            case '5': $html = $this->Entero($data);
                break;
            case '6': $html = $this->Double($data);
                break;
            case '7': $html = $this->Fecha($data);
                break;
            case '8': $html = $this->Hora($data);
                break;
            case '9':
                $html = $this->Si_multiple($data);

                break;
            case '10': $html = $this->Si_No_otro($data);
                break;
        }
        return $html;
    }

    private function TipoDato($Datos, $key, $panel = true)
    {
        $html = '';
        if ($panel)
        {
            $html.=' <div class = "panel panel-other">' . "\n";
            $html.='<div class = "panel-heading">
            <h4 class = "panel-title">
            <a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse' . $key . '">' . $Datos['descripcion'] . '</a>
            </h4>
            </div>
            <div id = "collapse' . $key . '" class = "panel-collapse collapse">
            <div class = "panel-body">' . "\n";
        }
        foreach ($Datos['value'] as $temp)
        {
            $html.= '<div class = "' . $this->col_md . '">' . "\n";
            $html.= $this->TipoDatohtml($temp) . "\n";
            $html.='</div>' . "\n";
        }
        if ($panel)
        {
            $html.='</div>
            </div>
            </div>';
        }
        return $html;
    }

    public function CrearCampos($Datos, $panel = true)
    {
        $html = '';
        if ($panel)
        {
            $html = '<div class = "panel-group" id = "accordion">' . "\n";
        }
        foreach ($Datos as $key => $temp)
        {
            $html.= $this->TipoDato($temp, $key, $panel);
        }
        if ($panel)
        {
            $html.='</div>';
        }
        return $html;
    }

}
