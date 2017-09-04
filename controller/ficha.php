<?php

include_once dirname(__FILE__) . '/../base.php';
include_once Config::$Controller . 'formulario.php';
include_once Config::$Controller . 'caracteristicas.php';
include_once Config::$model . 'modelficha.php';
include_once Config::$model . 'modelcategorias.php';
include_once Config::$model . 'modelpersona.php';

class ficha
{
    #Importar

    private function CrearRegistroTarjetaFamiliar($id_tarjeta_familiar, $registro)
    {
        $mCategorias = new modelcategorias();
        $mCategorias->SaveRegistro(null, $registro["value"], $id_tarjeta_familiar);
    }

    private function CrearTarjetaFamiliar($Data)
    {
        $mFicha              = new modelficha();
        $id_tarjeta_familiar = $mFicha->savetarjetafamiliar($Data);
        return $id_tarjeta_familiar;
    }

    private function saveRegistroPersona($id_persona, $registro)
    {
        $mCategorias = new modelcategorias();
        $mCategorias->SaveRegistro($id_persona, $registro["value"]);
    }

    private function personas($people, $id_tarjeta_familiar)
    {
        $mPerson = new modelpersona();
        foreach ($people as $temp)
        {
            $temp['id_tarjeta_familiar'] = $id_tarjeta_familiar;
            $id_persona                  = $mPerson->SavePersona($temp);
            if (count($temp['registro']) > 0)
            {
                $this->saveRegistroPersona($id_persona, $temp['registro']);
            }
        }
    }

    public function importardata()
    {
        $Data = other::echo_json_decode(file_get_contents($_FILES ["archivo1"]['tmp_name']));
        foreach ($Data as $temp)
        {
            $id_tarjeta_familiar = $this->CrearTarjetaFamiliar($temp);
            $this->CrearRegistroTarjetaFamiliar($id_tarjeta_familiar, $temp['registro']);
            $this->Personas($temp["people"], $id_tarjeta_familiar);
        }
    }

#Importar
#Exportar

    private function generate_data_registro_ficha($id_tarjeta_familiar)
    {
        return modelficha::generate_data_registro_ficha($id_tarjeta_familiar);
    }

    private function generate_data_registro_person($id_persona)
    {
        return modelficha::generate_data_registro_person($id_persona);
    }

    private function generate_data_person($id_tarjeta_familiar)
    {
        $data = modelficha::generate_data_person($id_tarjeta_familiar);
        foreach ($data as $key => $temp)
        {
            $data[$key]['registro'] = $this->generate_data_registro_person($temp['id_persona']);
            unset($data[$key]['id_persona']);
        }
        return $data;
    }

    private function generate_data_expot()
    {
        $Res = modelficha::generate_data_ficha();
        foreach ($Res as $key => $temp)
        {
            $Res[$key]['registro'] = $this->generate_data_registro_ficha($temp['id_tarjeta_familiar']);
            $Res[$key]['people']   = $this->generate_data_person($temp['id_tarjeta_familiar']);


            unset($Res[$key]['id_tarjeta_familiar']);
        }
        $Res = other::echo_json($Res);
        return $Res;
    }

    public function exportar_data()
    {
        $name    = 'export.json';
        $archivo = Config::$files . $name;
        $fp      = fopen($archivo, "w+");
        $texts   = $this->generate_data_expot();
        fputs($fp, $texts);
        fclose($fp);
        echo $name;
    }

#Exportar

    public static function codigotarjetaFamiliar()
    {
        @session_start();
        $id = null;
        if (isset($_SESSION['codigo_next_value']))
        {
            $id = $_SESSION['codigo_next_value'];
        }
        return $id;
    }

    public static function datosIngreso($panel = true)
    {
        $form = new formulario();
        $Cat  = new modelcategorias();
        $Data = $Cat->VerCategorias('ficha');
        $Res  = array();
        foreach ($Data as $temp)
        {
            $temp1                          = array(
                'descripcion' => $temp['descripcion'],
                'value'       => $Cat->VerVariablexcategoria($temp['id_car_categoria'])
            );
            $Res[$temp['id_car_categoria']] = $temp1;
        }
        $form->col_md = 'col-md-4';
        $Resultado    = $form->CrearCampos($Res, $panel);
        return $Resultado;
    }

    private function format_data_9($data)
    {
        $Res = array();
        foreach ($data as $temp)
        {
            $Res[] = $temp;
        }
        $data = json_encode($Res, 128);
        $data = str_replace(array('data_', 'option_'), array('data ', 'option '), $data);
        return($data);
    }

    private function saveCaracteristicas($Post, $id_tarjeta_familiar)
    {
        $Cat       = new modelcategorias();
        $Data      = $Cat->VerCategorias('ficha');
        $Res       = array();
        $SaveArray = array();
        foreach ($Data as $temp)
        {
            $temp1 = $Cat->VerVariablexcategoria($temp['id_car_categoria']);
            foreach ($temp1 as $temp2)
            {
                $Res[] = $temp2;
            }
        }
        foreach ($Post as $key => $temp)
        {
            $nombre = 'input_';
            if (strpos($key, $nombre) !== FALSE)
            {
                $temp2          = array();
                $temp2['value'] = $temp;
                $temp2['id']    = str_replace($nombre, '', $key);

                $found_key = array_search($temp2['id'], array_column($Res, 'id_car_variables'));
                if ($Res[$found_key]["id_car_tipo_dato"] == '9')
                {
                    $temp2['value'] = $this->format_data_9($temp);
                }
                $SaveArray[] = array(
                    'id'           => $temp2['id'],
                    'value'        => $temp2['value'],
                    'id_tipo_data' => $Res[$found_key]["id_car_tipo_dato"]
                );
            }
        }
        $SaveArray = other::echo_json($SaveArray);
        return $Cat->SaveRegistro(NULL, $SaveArray, $id_tarjeta_familiar);
    }

    public function Postsavetarjetafamiliar()
    {
        $Res = array();
        try
        {
            @session_start();
            $id_usuario = null;
            if (isset($_SESSION['id_usuario']))
            {
                $id_usuario = $_SESSION['id_usuario'];
            }
            $_POST['responsable'] = $_SESSION["encuestador"];
            $_POST['documento_responsable'] = $_SESSION["documento_responsable"];
            $tarjeta_familiar     = new modelficha();
            $id_tarjeta           = $tarjeta_familiar->savetarjetafamiliar($_POST);
            $this->saveCaracteristicas($_POST, $id_tarjeta);
            $id                   = $tarjeta_familiar->codigonextvalue($id_usuario);
            if (!is_null($id))
            {

                $_SESSION['codigo_next_value'] = $id;
                $Res                           = array('success' => true, 'id' => $id_tarjeta, 'mesage' => 'Se ha guardado la tarjeta familiar', 'next_id' => $_SESSION['codigo_next_value']);
            }
            else
            {
                $Res = array('success' => false, 'mesage' => 'Error desconocido', 'id' => null, 'next_id' => null);
            }
        }
        catch (Exception $e)
        {
            $Res = array('success' => false, 'mesage' => $e->message(), 'id' => null, 'next_id' => null);
        }
        echo other::echo_json($Res);
    }

}
