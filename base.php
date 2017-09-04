<?php

include('config.php');
include(Config::$model . 'adodb5' . Config::$ds . 'adodb.inc.php');
require_once(Config::$model . 'adodb5' . Config::$ds . 'adodb-active-record.inc.php');
Config::$con        = ADONewConnection(Config::$driver); # eg 'mysql' o 'postgres'
Config::$con->debug = Config::$debug;
Config::$con->Connect(Config::$host, Config::$user, Config::$pass, Config::$base);
Config::$con->EXECUTE("set names 'utf8'");
include(Config::$model . 'model.php');
include(Config::$Controller . 'other.php');
?>