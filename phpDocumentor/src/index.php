<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 28.04.2018
 * Time: 23:33
 */
//
//$date = new DateTime();
//$date->setDate(2018, 1, 0);
//echo $date->format(DateTime::RSS); // Fri, 01 Jan 2016 00:00:00 +0000
spl_autoload_register(function ($class_name) {
    include_once $class_name . '.php';
});


use utils\Month;

$month = new Month(5, 2018);
//print $month->getWeekDay(29) . "\n";

$data = "";
foreach ($month->getIterator() as $day) {
    $data .= $day . "&nbsp";
}
echo nl2br($data);