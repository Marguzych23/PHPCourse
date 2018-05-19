<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 25.03.2018
 * Time: 12:35
 * @param string $string
 * @return string
 */

function string_modifier(string &$string)
{
    function string_generator(string &$string)
    {
        $string_chars_array = str_split($string);
        static $changes = 0;
        foreach ($string_chars_array as $char) {
            switch ($char) {
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
                    yield $char;
                    break;
            }
        }

        return $changes;
    }

    $modifiedString = "";

    $generator = string_generator($string);
    foreach ($generator as $char) {
        $modifiedString .= $char;
    }

    echo "Количество изменений: " . $generator->getReturn() . "</br>";

    return $modifiedString;
}

?>