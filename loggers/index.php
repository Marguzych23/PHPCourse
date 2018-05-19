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
include_once "methodsWithData.php";

if (isset($_POST['message']) and isset($_POST['loggerType'])) {
    $message = $_POST['message'];
    $loggerType = $_POST['loggerType'];


    $message = explode("\n", $message);

    $logger = null;

    switch ($loggerType) {
        case "file":
            {
                $filename = "data.txt";

                if (isset($_POST['filename'])) {
                    $browserDate = $_POST['filename'];
                }
                $logger = new FileLogger($filename);
                break;
            }
        case "browser":
            {
                $browserDate = 0;
                if (isset($_POST['browserDate'])) {
                    $browserDate = $_POST['browserDate'];
                }
                $logger = new BrowserLogger($browserDate);
                break;
            }
        default:
            {
//
            }
    }

    $data = checkData($message);

    if ($logger instanceof Logger) {
        $logger->write($data);
    }
}