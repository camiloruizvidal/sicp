<?php

include_once dirname(__FILE__) . '/../base.php';
include_once Config::$model . 'modeldatos.php';

class datos
{

    public static function tipoafiliado()
    {
        $select = new datos();
        $html   = '';
        $html .= '<option value="COTIZANTE">COTIZANTE</option>' . "\n";
        $html .= '<option value="BENEFIACIARIO">BENEFIACIARIO</option>' . "\n";

        echo $html;
    }

    public static function regimen()
    {
        $data = modeldatos::regimen();
        $html = '';
        $html .= '<option value="-1">Seleccione</option>' . "\n";
        foreach ($data as $temp)
        {
            $html .= '<option value="' . $temp['id_regimen'] . '">' . $temp['descripcion'] . '</option>' . "\n";
        }
        echo $html;
    }

    public static function departamento()
    {
        $select = new datos();
        $data   = modeldatos::departamento();
        $html   = '';
        $html .= '<option value="-1">Seleccione</option>' . "\n";
        foreach ($data as $temp)
        {
            $html .= '<option value="' . $temp['id_departamentos'] . '">' . $temp['descripcion'] . '</option>' . "\n";
        }
        echo $html;
    }

    public static function Postmunicipios()
    {
        $id     = (isset($_POST['id'])) ? $_POST['id'] : '';
        $select = new datos();
        $data   = modeldatos::municipios($id);
        $html   = '';
        foreach ($data as $temp)
        {
            $html .= '<option value="' . $temp['id_municipio'] . '" >' . $temp['descripcion'] . '</option>' . "\n";
        }
        echo $html;
    }

    public static function Postveredas()
    {
        $id   = (isset($_POST['id'])) ? $_POST['id'] : '';
        $html = '<option value="-1">Vacio</option>';
        $data = modeldatos::veredas($id);
        foreach ($data as $temp)
        {
            $html .= '<option value="' . $temp['id_vereda'] . '" >' . $temp['descripcion'] . '</option>' . "\n";
        }
        echo $html;
    }

    private function corregimientos($id)
    {
        $data = modeldatos::corregimientos($id);
        $html = '<option value="-1">Vacio</option>';
        foreach ($data as $temp)
        {
            $html .= '<option value="' . $temp['id_corregimiento'] . '">' . $temp['descripcion'] . '</option>' . "\n";
        }
        echo $html;
    }

    public static function Postcorregimientos()
    {
        $datos = new datos();
        try
        {
            $datos->corregimientos($_POST['id']);
        }
        catch (Exception $e)
        {
            echo '';
        }
    }

    public function Postsaveeps()
    {
        echo modeldatos::neweps($_POST['name']);
    }

    public static function familiaridad()
    {
        $select = new datos();
        $data   = modeldatos::familiaridad();
        $html   = '';
        $html .= '<option value="-1" >Seleccione</option>' . "\n";
        foreach ($data as $temp)
        {
            $html .= '<option value="' . $temp['id_persona_familiaridad'] . '" data-sexo="' . $temp['sexo'] . '">' . $temp['descripcion'] . '</option>' . "\n";
        }
        echo $html;
    }

    public static function select($data)
    {
        $html = '';
        foreach ($data as $temp)
        {
            $html.='<option value="' . current($temp) . '">' . next($temp) . '</option>' . "\n";
        }
        return $html;
    }

    public static function tipodocumento()
    {
        $select = new datos();
        $data   = modeldatos::tipodocumento();
        echo $select->select($data);
    }

    public static function zona()
    {
        $select = new datos();
        $data   = modeldatos::zona();
        echo $select->select($data);
    }

    public static function estadocivil()
    {
        $select = new datos();
        $data   = modeldatos::estadocivil();
        echo $select->select($data);
    }

    public function aseguradores()
    {
        $select = new datos();
        $data   = modeldatos::asegurador();
        echo $select->select($data);
    }

    public static function asegurador()
    {
        $select = new datos();
        $select->aseguradores();
    }

    public static function niveleducativo()
    {
        $select = new datos();
        $data   = modeldatos::niveleducativo();
        echo $select->select($data);
    }

}
