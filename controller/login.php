<?php

date_default_timezone_set('America/Bogota');
include_once dirname(__FILE__) . '/../base.php';
include_once Config::$model . 'modellogin.php';
include_once Config::$Controller . 'visual.php';

class login
{

    public function Postguardarlogin()
    {
        $valida = true;
        $msj    = '';
        extract($_POST);
        if ($pass_new_1 === $pass_new_2)
        {
            $Model = new modellogin();
            $data  = $Model->ValidarUsuario($login, $pass);
            if (count($data) > 0)
            {
                $id_usuario = $data['id_usuario'];
                try
                {
                    $valida = $Model->EditUser($id_usuario, $login, $pass_new_1, $nombre, $apellido, $documento);
                    if ($valida)
                    {
                        $msj = 'La contraseña ha sido modificada con éxito';
                    }
                    else
                    {
                        $msj = 'Error desconocido';
                    }
                }
                catch (Exception $e)
                {
                    $valida = false;
                    $msj    = 'Codigo:' . $e->getCode();
                }
            }
            else
            {
                $valida = false;
                $msj    = 'No se ha podido cambiar la contraseña';
            }
        }
        else
        {
            $valida = false;
            $msj    = 'Las contraseñas no coinciden';
        }
        echo json_encode(array('valido' => $valida, 'msj' => $msj));
    }

    public function Postguardarcodigo()
    {
        @session_start();
        $_POST['id_usuario'] = $_SESSION['id_usuario'];
        $Res                 = modellogin::Guardarcodigo($_POST);
        echo $Res;
    }

    public static function vercodigosuser()
    {
        $l      = new login();
        $Render = new visual();
        $data   = $l->vercodigos();
        echo $Render->Tabla($data, '1', array('Codigo inico', 'Codigo fin', 'Codigo actual', 'Activo'));
    }

    public function vercodigos()
    {
        @session_start();
        $id_user = $_SESSION['id_usuario'];
        return modellogin::VerCodigos($id_user);
    }

    public function VerUsuario()
    {
        return $this->SessionActiva();
    }

    public function detalle_usuario($id_usuario)
    {
        return modellogin::detalle_usuario($id_usuario);
    }

    public function SessionActiva()
    {

        @session_start();
        if (count($_SESSION) === 0)
            return false;
        else
            return $_SESSION;
    }

    public function CerrarSession()
    {
        @session_start();
        $_SESSION = array();
        unset($_SESSION);
        $_SESSION = FALSE;
    }

    public function RedireccionarPerfilUsuario()
    {
        if (isset($_SESSION['id_perfil']))
        {
            @session_start();
            extract($_SESSION);
            switch ($id_perfil)
            {
                case '1':
                    $_SESSION['url'] = ('../new/afiliados');
                    break;
                case '2':
                    $_SESSION['url'] = ('../new/afiliados');
                    break;
                case '3':
                    $_SESSION['url'] = ('../list/pagos');
                    break;
                default :
                    $_SESSION['url'] = ('../sicp/login_ini');
                    break;
            }
        }
        else
        {
            echo '';
            header('Location: ../sicp/login_ini');
        }
    }

    public function UsuarioCorrecto($ArrayPerfilesUsuario)
    {
        $Datos = $this->VerUsuario();
        $Tipo  = ($Datos['tipo_perfil']);
        $Res   = false;
        if (!in_array($Tipo, $ArrayPerfilesUsuario))
        {
            $this->CerrarSession();
            $this->RedireccionarPerfilUsuario();
        }
    }

    private function generateUser($data)
    {
        @session_start();
        $data['ini'] = date('Y-m-d H:i:s A');
        $_SESSION    = $data;
    }

    private function Loginsrc()
    {
        $url = '';
        @session_start();
        switch ($_SESSION['id_perfil_tipo'])
        {
            case '1': $url = '../ficha/registrar.php';
                break;
            case '2': $url = '../admin/importar.php';
                break;
        }
        return $url;
    }

    public function Postvalidate()
    {
        $Model = new modellogin();
        $data  = $Model->ValidarUsuario($_POST['login'], $_POST['pass']);
        $Res   = array();
        if (count($data) > 0)
        {
            $this->generateUser($data);
            $Res['validate'] = true;
            $Res['url']      = $this->Loginsrc();
        }
        else
        {
            $Res['validate'] = false;
            $Res['url']      = NULL;
        }
        echo other::echo_json($Res);
    }

}
