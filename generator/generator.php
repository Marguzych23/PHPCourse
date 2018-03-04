<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 04.03.2018
 * Time: 19:04
 */

require 'index.html';
function modifyString($example): string
{
    $modifiedExample = "";
    function str_generator($example)
    {
        static $changes = 0;
        for ($i = 0; $i < strlen($example); $i++) {
            switch ($example[$i]) {
                case "h":
                    $changes++;
                    yield "4";
                    break;
                case "l":
                    $changes++;
                    yield "1";
                    break;
                case "e":
                    $changes++;
                    yield "3";
                    break;
                case "o":
                    $changes++;
                    yield "0";
                    break;
                default:
                    yield $example[$i];
                    break;
            }
        }
        return $changes;
    }

    $generator = str_generator($example);
    foreach ($generator as $i) {
        $modifiedExample .= $i;
    }

    echo "Число замен: " . $generator->getReturn() . "<br>";
    return $modifiedExample;
}

$message = "";
if (isset($_POST['message'])) {
    $message = $_POST['message'];
}

echo "Рузультат: " . modifyString($message);
?>