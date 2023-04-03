<?php session_start(); ob_start();

#SET CONST
define('__VIEW__', __DIR__ . '/../app/Views/');
define('__PUBLIC__', __DIR__ . '/../public');

#Config ENV
if (strtoupper($_ENV['APP_DEBUG']) == 'FALSE') {
    error_reporting(0);
    ini_set('display_errors', 0);
}

#Load timezone
date_default_timezone_set($_ENV['TIME_ZONE']);

#Load Config
$configsConfigArray = ['helpers'];
foreach ($configsConfigArray as $configConfigArray) {
    require_once __DIR__ . '/../config/' . $configConfigArray . '.php';
}

#Load Routes
$routesConfigArray = ['web', 'api'];
foreach ($routesConfigArray as $routeConfigArray) {
    require_once __DIR__ . '/../routes/' . $routeConfigArray . '.php';
}