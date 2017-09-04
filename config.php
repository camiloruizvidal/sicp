<?php

class Config
{

    public static $ds         = DIRECTORY_SEPARATOR;
    public static $url        = '';
    public static $con        = null;
    public static $host       = '127.0.0.1';
    public static $base       = 'sicp';
    public static $user       = 'root';
    public static $pass       = '';
    public static $home       = '';
    public static $model      = '';
    public static $debug      = FALSE;   //depurar base
    public static $driver     = 'mysql';
    public static $home_lib   = '';
    public static $home_bin   = '';
    public static $Controller = '';
    public static $Plantilla  = '';
    public static $files      = '';

}

$pageURL = 'http';
if (isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on")
{
    $pageURL .= "s";
}

$pageURL .= "://";
$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
Config::$files      = dirname(__FILE__) . Config::$ds . 'view' . Config::$ds . 'files' . Config::$ds;
Config::$url        = $pageURL;
Config::$home       = dirname(__FILE__);
Config::$model      = dirname(__FILE__) . Config::$ds . 'model' . Config::$ds;
Config::$home_lib   = Config::$home . Config::$ds . 'lib' . Config::$ds;
Config::$home_bin   = Config::$home . Config::$ds . 'bin' . Config::$ds;
Config::$Controller = dirname(__FILE__) . Config::$ds . 'controller' . Config::$ds;
Config::$Plantilla  = dirname(__FILE__) . Config::$ds . 'view' . Config::$ds . 'form' . Config::$ds . '_plantillas' . Config::$ds;
?>
