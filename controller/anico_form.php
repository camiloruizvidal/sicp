<?php

class anico_form
{

    private $content;
    private $url_error;
    private $url_no_valido_user;
    private $url_file;
    public $plantilla;
    public $ruta;
    public $parametros;
    public $sesiones;

    private function prepocesar($data)
    {
        ob_start();
        eval("?> $data <?php ");
        $salida = ob_get_clean();
        return $salida;
    }

    private function read_content()
    {
        $linea   = '';
        $copiar  = true;
        $iniciar = FALSE;
        $url     = $this->url_file;
        $fp      = (fopen($url, 'r'));
        while (!feof($fp))
        {
            $txt = fgets($fp);
            if (is_numeric(strpos($txt, '<#--content_fin--#>')))
            {
                $iniciar = FALSE;
            }
            if ($iniciar)
            {
                $linea .= $txt;
            }
            if (is_numeric(strpos($txt, '<#--content_ini--#>')))
            {
                $iniciar = TRUE;
            }
        }
        return $this->prepocesar($linea);
    }

    private function leer_plantilla($plantilla)
    {
        if (file_exists($plantilla))
        {
            $fp    = fopen($plantilla, "r");
            $linea = '';
            while (!feof($fp))
            {
                $linea .= fgets($fp);
            }
            $linea = str_replace('<#--contenido--#>', $this->content, $linea);
            return $linea;
        }
        else
        {
            echo 'Error, la ruta <strong>"' . getcwd() . '\\' . str_replace(array('/'), array('\\'), $plantilla) . '"</strong> no existe';
            exit();
        }
    }

    private function css($data)
    {
        $res = "";
        if (is_array($data))
        {
            foreach ($data as $temp)
            {
                $x   = new DateTime();
                $res .= '<link rel = "stylesheet" type = "text/css" href = "' . $temp . '?v=' . ($x->format('YmdHisu')) . '" media = "screen">' . "\n";
            }
        }
        else
        {
            $x   = new DateTime();
            $res = '<link rel = "stylesheet" type = "text/css" href = "' . $data . '?v=' . ($x->format('YmdHisu')) . '" media = "screen">' . "\n";
        }
        $res .= '';
        return $res;
    }

    private function js($data)
    {
        $res = '';
        if (is_array($data))
        {
            foreach ($data as $temp)
            {
                $x   = new DateTime();
                $res .= '<script type="text/javascript" src="' . $temp . '?v=' . ($x->format('YmdHisu')) . '"></script>' . "\n";
            }
        }
        else
        {
            $x   = new DateTime();
            $res = '<script type="text/javascript" src="' . $data . '?v=' . ($x->format('YmdHisu')) . '"></script>' . "\n";
        }
        $res .= '';
        return $res;
    }

    private function ValidarSesiones($sesiones)
    {
        if ($sesiones != '')
        {
            @session_start();
            if (isset($_SESSION['perfil']))
            {
                if (in_array($_SESSION['perfil'], $sesiones))
                {
                    
                }
                else
                {
                    exit('Redireccionar');
                    //Redireccionar
                }
            }
            else
            {
                exit('Redireccionar');
            }
        }
    }

    public function create($ruta)
    {
        $this->url_file = $ruta;
        $plantilla      = $this->plantilla;
        $parametros     = $this->parametros;
        $sesiones       = $this->sesiones;

        $this->ValidarSesiones($sesiones);
        $this->content = $this->read_content();
        if (is_null($this->content))
        {
            echo '<h1>Error</h1>';
            exit();
        }
        $plantilla  = $this->ruta . '/' . $plantilla;
        $Formulario = $this->leer_plantilla($plantilla);
        if ($parametros != '')
        {
            foreach ($parametros as $key => $reg)
            {
                switch ($key)
                {
                    case 'css':$reg = $this->css($reg);
                        break;
                    case 'js':$reg = $this->js($reg);
                        break;
                    default :$reg = $reg;
                        break;
                }
                $Formulario = str_replace('<#--' . $key . '--#>', $reg, $Formulario);
            }
        }
        $Formulario = str_replace(array('<#--js--#>', '<#--titulo--#>', '<#--css--#>'), array('', '', ''), $Formulario);
        echo $this->prepocesar($Formulario);
        exit();
    }

}

$form = new anico_form();
