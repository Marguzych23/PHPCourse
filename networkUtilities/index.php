<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 07.04.2018
 * Time: 22:50
 */

include "network_utils.php";

require 'index.html';

if (isset($_POST['message']) and isset($_POST['type'])) {
    $address = trim($_POST['message']);
    $type = $_POST['type'];
    echo "Результат: <br>" . check_connection($address, $type);
}