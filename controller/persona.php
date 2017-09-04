<?php

include_once dirname(__FILE__) . '/../base.php';
include_once Config::$model . 'modelpersona.php';
include_once Config::$model . 'modelficha.php';

class persona
{

    private function id_tarjeta_familiar($codigo)
    {
        $tarjeta = new modelficha();
        $data    = $tarjeta->tarjeta_familiar($codigo);
        return $data['id_tarjeta_familiar'];
    }

    public function Postguardarpersona()
    {
        $_POST['es_cabeza_familia']       = (trim($_POST['es_cabeza_familia']) === '') ? 'no' : 'si';
        $_POST['id_persona_familiaridad'] = (isset($_POST['id_persona_familiaridad'])) ? ($_POST['id_persona_familiaridad']) : '-1';
        $Person                           = new modelpersona();
        $data                             = array();
        $Res                              = $this->id_tarjeta_familiar($_POST['codigo']);
        if (!is_null($Res))
        {
            $_POST['id_tarjeta_familiar'] = $Res;
            $data['id']                   = $Person->SavePersona($_POST);
            if (!is_null($data['id']))
            {
                $data['success'] = true;
            }
            else
            {
                $data['success'] = false;
            }
        }
        else
        {
            $data['id']      = null;
            $data['success'] = false;
        }
        echo other::echo_json($data);
    }

    public function Postverrpersona()
    {
        $Person = new modelpersona();
        echo other::echo_json($Person->verpersona($_POST['documento']));
    }

}
