<?php

session_start();
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


require_once __DIR__ . '/../vendor/autoload.php';

use Bee\Config\CoreConfig;
use Bee\Config\RouterConfig;

 CoreConfig::loadEnvs();

if (getenv('APP_ENV') != 'production') {
    ini_set('ignore_repeated_errors', 'On');
    ini_set('html_errors', 'On');
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
}


RouterConfig::get();