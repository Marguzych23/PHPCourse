<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 15.04.2018
 * Time: 20:06
 */

require "index.html";

include_once "Logger.php";
include_once "BrowserLogger.php";
include_once "FileLogger.php";

if (isset($_POST['message']) and isset($_POST['loggerType'])) {
    $message = $_POST['message'];
    $loggerType = $_POST['loggerType'];


    $message = explode("\n", $message);

    $logger;

    switch ($loggerType) {
        case "file":
            {
                $filename = "data.txt";

                if (isset($_POST['filename'])) {
                    $browserDate = $_POST['filename'];
                }
                $logger = new FileLogger($message, $filename);
                break;
            }
        case "browser":
            {
                $browserDate = 0;
                if (isset($_POST['browserDate'])) {
                    $browserDate = $_POST['browserDate'];
                }
                $logger = new BrowserLogger($message, $browserDate);
                break;
            }
        default:
            {
//
            }
    }

    if ($logger instanceof Logger) {
        $logger->checkData();
        $logger->writeCheckedData();
    }
}