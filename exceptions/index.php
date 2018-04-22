<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 22.04.2018
 * Time: 15:31
 */

use myNameSpace\MyClass;

spl_autoload_register(function ($class_name) {
    include_once $class_name . '.php';
});

$myClass = new MyClass();

try {
    $myClass->firstMethod(true);
} catch (\myExceptions\MyFirstException $e) {
    print $e->getMessage();
} catch (\myExceptions\MySecondException $e) {
    print $e->getMessage();
} finally {
    print " on called firstMethod()." . "\n";
}

try {
    $myClass->secondMethod(false);
} catch (\myExceptions\MySecondException $e) {
    print $e->getMessage();
} catch (\myExceptions\MyThirdException $e) {
    print $e->getMessage();
} finally {
    print " on called secondMethod()." . "\n";
}

try {
    $myClass->thirdMethod(true);
} catch (\myExceptions\MyFourthException $e) {
    print $e->getMessage();
} catch (\myExceptions\MyThirdException $e) {
    print $e->getMessage();
} finally {
    print " on called thirdMethod()." . "\n";
}

try {
    $myClass->fourthMethod(false);
} catch (\myExceptions\MyFifthException $e) {
    print $e->getMessage();
} catch (\myExceptions\MyFourthException $e) {
    print $e->getMessage();
} finally {
    print " on called fourthMethod()." . "\n";
}
