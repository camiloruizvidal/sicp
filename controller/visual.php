<?php

class visual
{

    public function EliminarColumna($Datos, $Col)
    {
        $Res = array();
        foreach ($Datos as $temp)
        {
            $temp2 = array();
            for ($i = 0; isset($temp[$i]); $i++)
            {
                if ($Col != $i)
                {
                    $temp2[] = $temp[$i];
                }
            }
            if (count($temp2) > 0)
            {
                $Res[] = $temp2;
            }
        }
        return $Res;
    }

    public function input($type, $class, $id, $name, $value, $label, $sexo, $values = '')
    {
        switch ($sexo)
        {
            case NULL: $sexo = '';
                break;
            case '1': $sexo = 'men ';
                break;
            case '2': $sexo = 'women ';
                break;
        }

        $html = '';
        if ($class != '')
        {
            
        }
        if ($id != '')
        {
            $id = ' id="' . $id . '" ';
        }
        if ($type == 'text' || $type == 'textarea' || $type == 'datos_json')
        {
            $html .= '<div class="' . $sexo . 'form form-group col-lg-12">' . "\n";
        }
        else
        {
            $html .= '<div class="' . $sexo . ' form form-group col-md-3">' . "\n";
        }
        if ($type == 'checkbox')
        {
            $html .= '    <input ' . $id . ' type="' . $type . '" name="' . $name . '" style="opacity: inherit !important;" class="' . $class . '" value="1">' . "\n";
            $html .= '    <label style="margin-left: 20px;">' . $label . '</label>' . "\n";
            $html .= '</div>' . "\n";
        }
        else
        {
            if ($type == 'datos_json')
            {
                $html .= '    <div class="element-select">
        <label class="title">' . $label . '</label>
            <div class="item-cont">
                <div class="large">
                    <span>
                        <select ' . $id . ' name="' . $name . '" >
';
                $values = json_decode($values);
                foreach ($values->values as $key => $value)
                {
                    $html .= '                            <option value="' . $key . '">' . $value . '</option>' . "\n";
                }

                $html .= '                        </select>
                    <i></i>   
                </span>
            </div>
        </div>
    </div>
</div>' . "\n";
            }
            else
            {
                $placeholder = '';
                if ($type == 'date')
                {
                    $placeholder = ' placeholder="YYYY-MM-DD" ';
                    $class       = 'fecha ' . $class;
                }
                $html .= '    <label>' . $label . '</label>' . "\n";
                $html .= '    <input ' . $id . $placeholder . ' type="text" name="' . $name . '"  class="' . $class . '" value="' . $value . '">' . "\n";
                $html .= '</div>' . "\n";
            }
        }
        return $html;
    }

    public function Total($Datos, $id)
    {

        $Res = 0;
        if (!is_null($Datos))
        {
            foreach ($Datos as $Temp)
            {
                $Temp[$id] = str_replace(',', '', $Temp[$id]);
                $Temp[$id] = str_replace('$', '', $Temp[$id]);
                $Res       = $Res + $Temp[$id];
            }
        }
        return $Res;
    }

    public function FunctionTableBoton2($Datos, $id, $function, $NameComponent, $type)
    {
        for ($i = 0; $i < count($Datos); $i++)
        {
            foreach ($Datos[$i] as $key => $Temp)
            {
                if ($key == $id)
                {
                    @$html            = '<button class="btn btn-' . $type . '" type="button" onclick="' . $function . '(\'' . $Datos[$i][$key] . '\')' . '"><span class="' . $NameComponent . '"></span></button>';
                    $Datos[$i][$key] = $html;
                }
            }
        }
        return $Datos;
    }

    public function FunctionTableBotonLinkPrint($Datos, $id, $url, $NameComponent, $type)
    {
        for ($i = 0; $i < count($Datos); $i++)
        {
            foreach ($Datos[$i] as $key => $Temp)
            {
                if ($key == $id)
                {
                    @$html            = '<a href="' . $url . $Datos[$i][$key] . '" class="btnPrint2"><button class="btn btn-' . $type . '" type="button" ><span class="' . $NameComponent . '"></span></button></a>';
                    $Datos[$i][$key] = $html;
                }
            }
        }
        return $Datos;
    }

    public function hrefTableBoton($Datos, $id, $Name, $NameComponent, $type)
    {
        for ($i = 0; $i < count($Datos); $i++)
        {
            foreach ($Datos[$i] as $key => $Temp)
            {
                if ($key == $id)
                {
                    @$html            = '<a href="' . $Name . $Datos[$i][$key] . '"><button style="width: auto !important;height: auto !important;" class="btn btn-' . $type . '" type="button" "><span class="' . $NameComponent . '"></span></button></a>';
                    $Datos[$i][$key] = $html;
                }
            }
        }
        return $Datos;
    }

    public function FormatoMoneda($Datos, $id, $Simbolo = '', $Decimal = '')
    {

        $Res = array();
        if (!is_null($Datos))
        {
            foreach ($Datos as $Temp)
            {
                if ($Decimal === '')
                {
                    if (is_float($Temp[$id]))
                    {
                        $Temp[$id] = $Simbolo . (number_format($Temp[$id], 2, ',', '.'));
                    }
                    else
                    {
                        $Temp[$id] = $Simbolo . (number_format($Temp[$id], 0, ',', '.'));
                    }
                }
                else
                {
                    $Temp[$id] = $Simbolo . (number_format($Temp[$id], $Decimal, ',', '.'));
                }
                $Res[] = $Temp;
            }
        }
        return $Res;
    }

    public function FormatoNumerico($Datos, $id, $Decimal = '', $Decenas = '')
    {
        $Res = array();
        if (!is_null($Datos))
        {
            foreach ($Datos as $Temp)
            {
                if (is_float($Temp[$id]))
                {
                    $Temp[$id] = (number_format($Temp[$id], 2, $Decimal, $Decenas));
                }
                else
                {
                    $Temp[$id] = (number_format($Temp[$id], 0, $Decimal, $Decenas));
                }
                $Res[] = $Temp;
            }
        }
        return $Res;
    }

    public function FunctionTable($Datos, $id, $function, $image)
    {
        for ($i = 0; $i < count($Datos); $i++)
        {
            foreach ($Datos[$i] as $key => $Temp)
            {
                if ($key == $id)
                {
                    @$html            = '<a href="javascript:' . $function . '(' . $Temp . ')"><img src="' . $image . '"></a>';
                    $Datos[$i][$key] = $html;
                }
            }
        }
        return $Datos;
    }

    public function Paginar($Tabla, $PaginaActual = '1', $NumeroPaginas = '0', $function = '', $Clase = 'pagination', $Agrupar = 10)
    {
        $NumeroPaginas = $NumeroPaginas + 1;

        $Datos  = '<nav align="center"><ul class="' . $Clase . '"><li>';
        if ($PaginaActual > 1)
            $Datos .= '<a href="javascript:' . $function . '(' . ($PaginaActual - 1) . ')" aria-label="Previous">';
        $Datos .= '<span aria-hidden="true">&laquo;</span></a></li>';
        $inicio = 0;

        ##INI CODIGO DE LARA
        $Group             = $Agrupar;
        $inicio            = $PaginaActual - 4;
        $pages_for_consult = $NumeroPaginas;

        if ($inicio < 1)
        {
            $inicio = 1;
        }
        $fin = $inicio + $Group;
        if ($fin > $pages_for_consult)
        {
            $fin    = $pages_for_consult + 1;
            $inicio = $fin - $Group;
        }
        if ($inicio < 1)
        {
            $inicio = 1;
        }
        $html = '<ul class="pagination  pagination-lg">';
        if ($inicio > 1)
        {
            $html .= '<li><a href="pacientes_' . ($inicio - 2) . '.html">&laquo;     </a></li>';
        }
        ##FIN CODIGO DE LARA

        for ($i = $inicio; $i < $fin; $i++)
        {
            $Class = '';
            $p     = $i;
            if ($p == $PaginaActual)
                $Class = ' Class="active" ';
            $Datos .= '<li' . $Class . '><a href="javascript:' . $function . '(' . $p . ')">' . $p . '</a></li>';
        }
        $Datos .= '<li>';
        if (($PaginaActual) < $NumeroPaginas)
        {
            $Datos .= '<a href="javascript:' . $function . '(' . ($PaginaActual + 1) . ')" aria-label="Next">';
        }
        $Datos .= '<span aria-hidden="true">&raquo;</span></a></li></ul></nav>';
        return $Tabla . $Datos;
    }

    public function GenerardorLink($Url, $Click = '', $image = '', $texto = '')
    {
        $Script = '';
        if ($Click != '')
        {
            $Script = '<input src="' . $image . '" type="image" onclick="' . $Click . ';">';
        }
        else
        {
            if ($image != '')
                $Script = "<a href=\"$Url\"><img src=\"$image\"></a>";
            else
                $Script = "<a href=\"$Url\">$texto</a>";
        }
        return $Script;
    }

    public function Panel($datos, $class = '')
    {

        $Res = '<ul class="' . $class . '">';
        foreach ($datos as $Temp)
        {
            $Res .= '<li><a href="' . $Temp['url'] . '">' . $Temp['Text'] . '</a></li>';
        }
        $Res .= '</ul>';
        return $Res;
    }

    public function CambiarDatos($Datos, $Valores)
    {
        $Valor = "<table border=1>\n";
        for ($i = 0; $i < count($Datos); $i++)
        {
            $Valor .= "<tr>";
            $Valor .= "<td>$Datos[$i]</td><td>$Valores[$i]</td>\n";
            $Valor .= "</tr>";
        }
        $Valor .= "</table>\n";
        return $Valor;
    }

    public function TextBox($nombre, $Valor = '', $id = '', $Class = '', $Type = 'Text')
    {
        if ($id != '')
        {
            $id = "id=\"$id\"";
        }
        if ($Class != '')
        {
            $Class = "class=\"$Class\"";
        }
        if ($Valor != '')
        {
            $Valor = " value=\"$Valor\" ";
        }
        return "<input name=\"$nombre\"	$id $Valor$Class type=\"$Type\" />";
    }

    private function CombinarColumnas($Datos, $ColumnasCombinar)//No usar, no esta funcionando como se debe
    {

        $tabla        = '';
        $Duplicado    = '';
        $DatosFinales = '';
        $Nombre       = array();
        $Cant         = array();
        $Anterior     = '';
        if ($ColumnasCombinar !== NULL && $ColumnasCombinar !== '')
        {
            foreach ($Datos as $Temp1)
            {
                $Temp2 = '';
                for ($i = 0; !empty($Temp1[$i]); $i++)
                {
                    if (in_array($i, $ColumnasCombinar))
                    {
                        $Temp2[$i] = $Temp1[$i];
                        $Cant[$i]  = 1;
                    }
                }
                $Nombre[] = $Temp2;
            }
        }
        for ($j = 0; $j < count($Datos); $j++)
        {
            $Temp3 = $Datos[$j];
            $tabla .= '<tr>';
            for ($i = 0; !empty($Temp3[$i]); $i++)
            {
                if ($ColumnasCombinar !== NULL && $ColumnasCombinar !== '')
                {

                    if (in_array($i, $ColumnasCombinar))
                    {
                        if ($j == 0)
                        {
                            $Anterior[$i] = $Nombre[$j][$i];
                        }
                        if (!empty($Anterior[$i]) && $Anterior[$i] == $Nombre[$j][$i])
                        {
                            $Cant[$i]      = $Cant[$i] + 1;
                            $Duplicado[$i] = '<td   rowspan="' . $Cant[$i] . '" VALIGN="MIDDLE" align="center">' . $Temp3[$i] . '</td>';
                        }
                        else
                        {
                            $Anterior[$i]  = $Nombre[$j][$i];
                            $Cant[$i]      = 1;
                            $tabla .= $Duplicado[$i];
                            $Duplicado[$i] = '<td VALIGN="MIDDLE" align="center">' . $Temp3[$i] . '</td>';
                        }
                    }
                    else
                    {
                        $tabla .= '<td VALIGN="MIDDLE" align="center">' . $Temp3[$i] . '</td>';
                    }
                }
                else
                {
                    $tabla .= '<td VALIGN="MIDDLE" align="center">' . $Temp3[$i] . '</td>';
                }
            }
            $tabla .= '</tr>';
        }
        $tabla .= "</table>";
        return $tabla;
    }

    public function Tabla2($Datos, $Border = '1', $Encabezado = '', $Class = '', $Id = '', $Contar = FALSE, $ColumnasCombinar = '', $Paginas = '', $NumPag = '', $color = '', $WIDTH = "100%")
    {
        if ((count($Datos) > 0 && $Datos[0] !== '' && $Datos !== NULL))
        {

            $count = 0;
            if ($Id != '')
            {
                $Id = " id=\"$Id\" ";
            }
            if ($Class != "")
            {
                $Class = " class=\"$Class\" ";
            }
            if ($Border != '')
            {
                $Border = " border=\"$Border\" ";
            }
            $WIDTH = 'WIDTH="' . $WIDTH . '"';
            $tabla = "<table$Border$Id$Class $WIDTH>\n";
            if ($Encabezado != '')
            {
                foreach ($Encabezado as $Temp)
                {
                    $tabla .= "<th><center>$Temp</center></th>";
                }
            }
            foreach ($Datos as $Temp1)
            {
                $colores = '';
                if ($color != '')
                {
                    $colores = ' style="background-color: ' . $Temp1[$color] . ';" ';
                }
                $tabla .= '<tr valign="top"' . $colores . '>';

                if ($Contar)
                {
                    $count++;
                    $tabla .= "<td valign=top align=\"center\">$count</td>";
                }
                foreach ($Temp1 as $Temp2)
                {

                    if ($color !== $i)
                    {
                        $tabla .= "<td valign=top align=\"center\">$Temp2</td>";
                    }
                }
                $tabla .= '</tr>';
            }
            $tabla .= "</table>";
            return $tabla;
        }
    }

    public function FunctionTableBoton($Datos, $id, $function, $NameComponent, $type)
    {
        for ($i = 0; $i < count($Datos); $i++)
        {
            foreach ($Datos[$i] as $key => $Temp)
            {
                if ($key == $id)
                {
                    @$html            = '<button class="btn btn-' . $type . '" type="button" onclick="' . $function . '(' . $Datos[$i][$key] . ')' . '"><span class="' . $NameComponent . '"></span></button>';
                    $Datos[$i][$key] = $html;
                }
            }
        }
        return $Datos;
    }

    public function FormatoJsonTable($Datos)
    {
        $Res = array();
        if (gettype($Datos) === 'array')
        {
            foreach ($Datos as $Temp1)
            {
                $TempArray = array();
                foreach ($Temp1 as $Temp2)
                {
                    $TempArray[] = $Temp2;
                }
                $Res[] = $TempArray;
            }
            return $Res;
        }
    }

    private function EncabezadoTable($ArrayEncabezado, $id)
    {
        $html  = '<style>
            @media 
            only screen and (max-width: 1090px),
            (min-device-width: 768px) and (max-device-width: 1090px)  {
                #' . $id . ' tr.disable{display:none;}
                /* Force table to not be like tables anymore */
                #' . $id . ' table, #' . $id . ' thead, #' . $id . ' tbody, #' . $id . ' th, #' . $id . ' td, #' . $id . ' tr { 
                    display: block; 
                }

                /* Hide table headers (but not display: none;, for accessibility) */
                #' . $id . ' thead tr { 
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }

                #' . $id . ' tr { border: 1px solid #ccc; }

                #' . $id . ' td { 
                    /* Behave  like a "row" */
                    text-align: -webkit-right;
                    border: none;
                    border-bottom: 1px solid #eee; 
                    position: relative;
                    padding-left: 50%; 
                }

                #' . $id . ' td:before { 
                    position: absolute;
                    top: 6px;
                    left: 6px;
                    width: 45%; 
                    padding-right: 10px; 
                    white-space: nowrap;
                }

                /*
                Label the data
                */';
        $total = count($ArrayEncabezado);
        for ($i = 0; $i < $total; $i++)
        {
            $name = str_replace(array('<br>', '<br/>'), array(' ', ' '), $ArrayEncabezado[$i]);
            $html .= '#' . $id . ' td:nth-of-type(' . ($i + 1) . '):before { content: "' . $name . '"; }';
        }
        $html .= '</style>';
        return $html;
    }

    public function Tabla($Datos, $Border = '1', $Encabezado = '', $Class = '', $Id = '', $Contar = FALSE, $ColumnasCombinar = '', $Paginas = '', $NumPag = '', $color = '', $WIDTH = "100%", $Aling = 'center', $aling = '')
    {
        $encresp = '';
        if ($Encabezado != '')
        {
            if ($Id === '')
            {
                $Id = 'id_table_' . rand(1, 90000000);
            }
            $encresp = $this->EncabezadoTable($Encabezado, $Id);
        }
        if ((count($Datos) > 0 && $Datos[0] !== '' && $Datos !== NULL))
        {

            $count = 0;
            if ($Id != '')
            {
                $Id = " id=\"$Id\" ";
            }
            if ($Class != "")
            {
                $Class = " class=\"$Class\" ";
            }
            if ($Border != '')
            {
                $Border = " border=\"$Border\" ";
            }
            $WIDTH = 'WIDTH="' . $WIDTH . '"';
            $tabla = "<table$Border$Id$Class $WIDTH>\n";
            if ($Encabezado != '')
            {
                $tabla .= '<thead>';
                $tabla .= '<tr class="disable">';
                foreach ($Encabezado as $Temp)
                {
                    $tabla .= "<th><center>$Temp</center></th>";
                }
                $tabla .= '</tr>';
                $tabla .= '</thead>';
            }
            $tabla .='<tbody>';
            foreach ($Datos as $Temp1)
            {
                $colores = '';
                if ($color != '')
                {
                    $colores = ' style="background-color: ' . $Temp1[$color] . ';" ';
                }
                $tabla .=
                        '<tr valign="middle"' . $colores . '>';

                if ($Contar)
                {
                    $count++;
                    $tabla .= "<td valign=\"middle\" align=\"center\">$count</td>";
                }
                $i = 0;
                foreach ($Temp1 as $temp2)
                {
                    if ($color !== $i)
                    {
                        if ($Aling !== -1)
                        {
                            $tabla .= "<td valign=top align=\"{$Aling}\">$temp2</td>";
                        }
                        else
                        {
                            $alg = '';
                            if (isset($aling[$i]))
                            {
                                $alg = ' align="' . $aling[$i] . '" ';
                            }
                            $tabla .= "<td valign=top{$alg}>$temp2</td>";
                        }
                    }
                    $i = $i + 1;
                }
                $tabla .= '</tr>';
            }
            $tabla .='</tbody>';
            $tabla .= "</table>";
            return $tabla . $encresp;
        }
    }

    private function Inciar($Datos, $Value, $Valueid = '')
    {
        if ($Value == NULL && $Valueid == NULL)
        {
            $Valores   = array();
            $temp      = array(0 => '-1', 1 => 'SELECCIONE');
            $Valores[] = $temp;
            for ($i = 0; $i < count($Datos); $i++)
            {
                $Valores[] = $Datos[$i];
            }
            $Datos = $Valores;
        }
        return $Datos;
    }

    public function Select($Datos, $Nombre = '', $Value = '', $id = '', $onchange = '', $Valueid = '', $Style = '', $class = '', $required = '')
    {
        error_reporting(0);
        $Nombre = "name=\"$Nombre\"";
        if ($id != '' && $id != NULL)
        {
            $id = "id=\"$id\"";
        }
        if ($class != '')
        {
            $class = "class=\"$class\"";
        }
        if ($Style != '')
        {
            $Style = "style=\"$Style\"";
        }
        if ($onchange != '')
        {
            $onchange = " onchange=\"$onchange\"";
        }
        if ($required != '')
        {
            $required = ' required="required"';
        }
        $Select = "<select$required $Nombre$id$onchange$class $Style>\n";
        $total  = count($Datos);
        $Datos  = $this->Inciar($Datos, $Value, $Valueid);
        if ($total > 0 && $Datos != '')
        {
            foreach ($Datos as $Temp)
            {
                if ($Value == $Temp[0] || $Valueid == $Temp[1])
                {
                    $Select .= "	<option SELECTED value=\"$Temp[0]\">$Temp[1]</option>\n";
                }
                else
                {
                    $Select .= "	<option value=\"$Temp[0]\">$Temp[1]</option>\n";
                }
            }
        }
        $Select .= '</select>';
        return $Select;
    }

    public function VerDatos($Datos)
    {
        $Res = '';
        for ($i = 0; $i < count($Datos); $i++)
        {
            $Res .= "'$Datos[$i]'";
            if ($i < count($Datos) - 1)
            {
                $Res .= ',';
            }
        }
        return $Res;
    }

}

?>
