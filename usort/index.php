<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 10.03.2018
 * Time: 12:42
 * @param $str1
 * @param $str2
 */

function myStringsSortBySecondWord(string $str1, string $str2)
{

    $word_number = 1;
    $str1_words_array = explode(" ", $str1);
    $str2_words_array = explode(" ", $str2);

    if (isset($str1_words_array[$word_number]) && isset($str2_words_array[$word_number])) {
        $result = strcmp($str1_words_array[$word_number], $str2_words_array[$word_number]);
        return $result;
    }

    return 0;
}

function shuffleString(string &$string)
{
    $emptyString = "";
    $string_words_array = explode(" ", $string);
    shuffle($string_words_array);
    for ($i = 0; $i < count($string_words_array); $i++) {
        $emptyString .= $string_words_array[$i];
        if ($i + 1 != count($string_words_array)) {
            $emptyString .= " ";
        }
    }
    return $emptyString;
}

function mainFunction(array &$strings_array)
{
    $new_strings_array = [];
    for ($i = 0; $i < count($strings_array); $i++) {
        array_push($new_strings_array, $strings_array[$i]);
        array_push($new_strings_array, shuffleString($strings_array[$i]));
    }

    usort($new_strings_array, "myStringsSortBySecondWord");
    return $new_strings_array;
}

function echoArray(array $array)
{
    foreach ($array as $item) {
        echo $item . "<br/>";
    }
}


require "index.html";

$message = "";
if (isset($_POST['message'])) {
    $message = $_POST['message'];
}

$strings_array = explode("\n", $message);

$result = mainFunction($strings_array);

echoArray($result);
?>