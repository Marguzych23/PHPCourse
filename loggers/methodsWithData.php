<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 15.04.2018
 * Time: 22:42
 * @param array $data
 * @return array
 */

function checkData(array $data)
{
    $checkedStringStart = "Строка ";
    $checkedStringFalse = " не";
    $checkedStringEnd = " содержит заглавные буквы";
    $emptyArray = [];
    foreach ($data as $item) {
        $emptyString = strtolower($item);
        $checkedString = "";
        $checkedString .= $checkedStringStart . "'" . trim($item) . "'";
        if ($item === $emptyString) {
            $checkedString .= $checkedStringFalse;
        }
        $checkedString .= $checkedStringEnd;
        array_push($emptyArray, $checkedString);
    }
    return $emptyArray;
}