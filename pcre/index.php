<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 25.03.2018
 * Time: 11:52
 */

include "passwordCheck.php";

require "index.html";

$password = "";
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    echo "Ваш пароль: " . $password . "</br>" . "</br>";
    $check = check_password($password);
    if (is_array($check)) {
        echo "Ошибки: " . "</br>";
        foreach ($check as $item) {
            echo $item . "</br>";
        }
    } else {
        echo "Отличный пароль!";
    }
}
