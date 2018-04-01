<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 01.04.2018
 * Time: 17:39
 */
$config = parse_ini_file('index.ini', true, INI_SCANNER_TYPED);

$file = null;

function decode_by_first_rules(string $upper, string &$string)
{
    if ($upper == "true") {
        return strtoupper($string);
//        return mb_strtoupper($string);
    } else if ($upper == "false") {
        return strtolower($string);
//        return mb_strtolower($string);
    }
    return $string;
}

function decode_by_second_rules(string $direction, string &$string)
{
    $empty_string = "";
    for ($i = 0; $i < strlen($string); $i++) {
        $char = $string[$i];
        if (is_numeric($char)) {
            if ($direction == "+") {
                if ($char != 9) {
                    $char++;
                } else {
                    $char = 0;
                }
            } else if ($direction == "-") {
                if ($char != 0) {
                    $char--;
                } else {
                    $char = 9;
                }
            } else {
                return "Error";
            }
        }
        $empty_string .= $char;
    }
    return $empty_string;
}

function decode_by_third_rules(string $delete, string &$string)
{
    return str_replace($delete, "", $string);
}

function get_rules(array $config)
{

    global $file;

    $errors = [];

    $symbols_and_rules = Array();

    $file = $config["main"]["filename"];

    $first_rule = $config["first_rule"];
    $second_rule = $config["second_rule"];
    $third_rule = $config["third_rule"];

    if ($first_rule["upper"] != "true" and $first_rule["upper"] != "false") {
        array_push($errors, "Invalid character for the first rule - " . $first_rule["upper"]);
    } else {
        $symbols_and_rules[$first_rule["symbol"]] = array(
            "rule" => 1,
            "char" => $first_rule["upper"],
        );
    }

    if ($second_rule["direction"] != "+" and $second_rule["direction"] != "-") {
        array_push($errors, "Invalid character for the second rule - " . $second_rule["direction"]);
    } else {

        $symbols_and_rules[$second_rule["symbol"]] = array(
            "rule" => 2,
            "char" => $second_rule["direction"],
        );
    }

    if (strlen($third_rule["delete"]) != 1) {
        array_push($errors, "Invalid character for the third rule - " . $third_rule["delete"] . " because length" . strlen($third_rule["delete"]) . " != 1");
    } else {
        $symbols_and_rules[$third_rule["symbol"]] = array(
            "rule" => 3,
            "char" => $third_rule["delete"],
        );
    }

    if (!empty($errors)) {
        print_r($errors);
    }

    return $symbols_and_rules;
}

function echo_decode_data_from_file($file, array $rules)
{
    $data = file($file, FILE_IGNORE_NEW_LINES);

    foreach ($data as $line) {
        $char = $line[0];
        if (isset($rules[$char])) {
            switch ($rules[$char]["rule"]) {
                case 1:
                    echo decode_by_first_rules($rules[$char]["char"], $line);
                    break;
                case 2:
                    echo decode_by_second_rules($rules[$char]["char"], $line);
                    break;
                case 3:
                    echo decode_by_third_rules($rules[$char]["char"], $line);
                    break;
                default:
                    echo $line;
                    break;
            }
        } else {
            echo $line;
        }
        echo "<br>";
    }
}

$rules = get_rules($config);

echo_decode_data_from_file($file, $rules);

?>