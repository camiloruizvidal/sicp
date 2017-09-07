<?php

function delete_vars()
{
    unset($_GET['function']);
    unset($_GET['control']);
    unset($_REQUEST['function']);
    unset($_REQUEST['control']);
}

function validate_vars()
{
    if (isset($_GET['control']) && isset($_GET['function']))
    {
        $control  = strtolower($_GET['control']);
        $function = strtolower($_GET['function']);
        config_variables();
        if (count($_POST) > 0)
        {
            $function = 'Post' . $function;
        }
        if (count($_GET) > 2)
        {
            $function = 'Get' . $function;
        }

        return (object) array('control' => $control, 'function' => $function);
    }
    else
    {
        header('HTTP/1.1 500 Internal Server Error.');
    }
}

function config_variables()//Limpiamos las variables para que tengan ni funcion ni control, para en un var_dump no salgan. Ademas retornamos las variables control y function. Por ultimo, si selecciona un metodo get, el sistema asigna las llaves y valores, ya que el htacces no los deja leer
{
    delete_vars();
    $res = explode('?', $_SERVER['REQUEST_URI']);
    if (isset($res[1]))
    {
        $res = explode('&', $res[1]);
        foreach ($res as $temp)
        {
            $temp2 = explode('=', $temp);
            if (count($temp2) === 2)
            {
                $_GET[$temp2[0]]     = urldecode($temp2[1]);
                $_REQUEST[$temp2[0]] = urldecode($temp2[1]);
            }
        }
    }
}

function init_control()//Validamos que existan las funciones y la clase que el browser ha mandado a llamar. 
{
    $variables   = validate_vars();
    $url_control = dirname(__FILE__) . DIRECTORY_SEPARATOR . $variables->control . '.php';
    if (file_exists($url_control))
    {
        include_once $url_control;
        if (method_exists($variables->control, $variables->function))
        {
            eval('$control = new ' . $variables->control . '();'); // seria mas o menos asi "$control = new control();"
            eval('$control->' . $variables->function . '();'); //seria mas o menos asi "$control->funcion();"
        }
        else
        {
            header('HTTP/1.1 500 Fatal error: Call to undefined method ' . $variables->control . '::' . $variables->function . '()');
        }
    }
    else
    {
        header('HTTP/1.1 500 Internal Server Error');
    }
}

init_control();
