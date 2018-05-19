<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 19.05.2018
 * Time: 22:32
 */

$sessionDestroyConstant = 5;
$url = "http://localhost:63342/PHPCourse/wrapper/generator/index.php?";

require 'index.html';
session_start();
if (isset($_SESSION['auth']) and isset($_SESSION['message'])) {
//    echo $_SESSION['message'] . "1111";
//    session_destroy();
    $params = array('message' => $_SESSION['message']);
    $_SESSION['auth']++;


    $parsedUrl = parse_url($_SERVER['REQUEST_URI']);

    $url .= $parsedUrl['query'];

    if ($curl = curl_init()) {
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 600);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        $out = curl_exec($curl);
        echo $out;
        curl_close($curl);
    }

} else {
    $_SESSION['auth'] = 0;
    if (isset($_POST['message'])) {
        $_SESSION['message'] = $_POST['message'];
        echo $_SESSION['message'];
    }
}

if ($_SESSION['auth'] >= $sessionDestroyConstant) {
    $_SESSION['auth'] = 0;
    session_destroy();
}