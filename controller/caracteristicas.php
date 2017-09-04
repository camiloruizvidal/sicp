<?php

include_once dirname(__FILE__) . '/../base.php';
include_once Config::$model . 'modelcategorias.php';
include_once Config::$Controller . 'formulario.php';

class caracteristicas
{

    public function CargarVariables($id_categoria)
    {
        $cat  = new modelcategorias();
        $data = $cat->VerVariablexcategoria($id_categoria);
        return $data;
    }

    public function CargarCategorias()
    {
        $cat  = new modelcategorias();
        $Data = $cat->VerCategorias();
        return $Data;
    }

    private function CargarCaracteristicas()
    {
        $data = array();
        $Cat  = $this->CargarCategorias();
        foreach ($Cat as $temp)
        {
            $temp1                           = array(
                'descripcion' => $temp['descripcion'],
                'value'       => $this->CargarVariables($temp['id_car_categoria'])
            );
            $data[$temp['id_car_categoria']] = $temp1;
        }
        return $data;
    }

    public function Postguardarregistro()
    {
        $conf            = new other();
        $ficha           = $_POST['id_persona'];
        unset($_POST['id_persona']);
        $value           = json_encode($conf->format_reg($_POST));
        $Cat             = new modelcategorias();
        $data            = array();
        $data['id']      = $Cat->SaveRegistro($ficha, $value);
        $data['success'] = true;
        echo other::echo_json($data);
    }

    public function Postcargarvalores()
    {
        $Data = modelcategorias::VerRegistro($_POST['id_persona']);
        echo $Data;
    }

    public function crearformulario()
    {

        $form = new formulario();
        $data = $this->CargarCaracteristicas();
        $Res  = $form->CrearCampos($data);
        return $Res;
    }

}
