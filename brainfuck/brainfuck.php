<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 19.02.2018
 * Time: 16:04
 */

function getArray()
{
    $parametersString = $_POST['parameters'];
    $parametersArray = [];
    for ($i = 0; $i < strlen($parametersString); $i++) {
        $parametersArray[$i] = ord($parametersString[$i]);
    }
    return $parametersArray;
}

function compile($code, $parameters)
{
    $parametersIndex = 0;
    $myParameters = [];
    $myParametersLastIndex = -1;
    $result = "";
    $openBrackets = [];
    if (empty($parameters)) {
        array_push($myParameters, 0);
        $myParametersLastIndex++;
    }
    for ($i = 0; $i < strlen($code);) {
        switch ($code{$i}) {
            case ">":
                if (count($myParameters) == $myParametersLastIndex + 1) {
                    array_push($myParameters, 0);
                }
                $myParametersLastIndex++;
                $i++;
                break;
            case "<":
                $myParametersLastIndex--;
                $i++;
                break;
            case "+":
                if ($myParameters[$myParametersLastIndex] == 255) {
                    $myParameters[$myParametersLastIndex] = 0;
                } else {
                    $myParameters[$myParametersLastIndex]++;
                }
                $i++;
                break;
            case "-":
                if ($myParameters[$myParametersLastIndex] == 0) {
                    $myParameters[$myParametersLastIndex] = 255;
                } else {
                    $myParameters[$myParametersLastIndex]--;
                }
                $i++;
                break;
            case ".":
                $result .= chr($myParameters[$myParametersLastIndex]);
                $i++;
                break;
            case ",":
                if ($myParametersLastIndex == -1) {
                    $myParametersLastIndex++;
                }
                $myParameters[$myParametersLastIndex] = $parameters[$parametersIndex];
                $parametersIndex++;
                $i++;
                break;
            case "[":
                if ($myParameters[$myParametersLastIndex] == 0) {
                    do {
                        $i++;
                    } while ($code[$i] != "]");
                } else {
                    array_push($openBrackets, $i);
                    $i++;
                }

                break;
            case "]":
                if ($myParameters[$myParametersLastIndex] != 0) {
                    $i = $openBrackets[count($openBrackets) - 1];
                } else {
                    array_pop($openBrackets);
                    $i++;
                }
                break;
            default:
                $i++;
                break;
        }
    }
    return $result;
}

$code = $_POST['code'];
$parameters = getArray();

echo compile($code, $parameters);
?>

