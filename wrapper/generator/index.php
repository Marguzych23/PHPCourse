<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 25.03.2018
 * Time: 12:34
 */

include "generator.php";

require 'index.html';

$message = "";
if (isset($_POST['message'])) {
    $message = $_POST['message'];
    echo "Результат: " . string_modifier($message);
}
