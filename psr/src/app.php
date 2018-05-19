<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 19.05.2018
 * Time: 17:35
 */

use myLog\JSONLogger;


$loader = require '../vendor/autoload.php';
$loader->add('psr\\', __DIR__ . '/src/');

spl_autoload_register(function ($class_name) {
    if (file_exists($class_name . '.php')) {
        include_once $class_name . '.php';
    }
});

$logger = new JSONLogger();

$logger->log("1", "Qwe");
$logger->info("Day");
$logger->warning("Faf");
$logger->error("Rubin is {what}", array("what" => "champion!"));

