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
    } elseif ($upper == "false") {
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
            } elseif ($direction == "-") {
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
    $rule_number = 0;

    $file = $config["main"]["filename"];

    foreach ($config as $rule) {
        if (isset($rule["filename"])) {
            $rule_number++;
            continue;
        } elseif (isset($rule["upper"])) {
            if ($rule["upper"] != "true" and $rule["upper"] != "false") {
                array_push($errors, $rule_number . ". Invalid character for the first rule - " . $rule["upper"]);
            } else {
                $symbols_and_rules[] = array(
                    "symbol" => $rule["symbol"],
                    "rule" => 1,
                    "char" => $rule["upper"],
                );
            }
        } elseif (isset($rule["direction"])) {
            if ($rule["direction"] != "+" and $rule["direction"] != "-") {
                array_push($errors, $rule_number . ". Invalid character for the second rule - " . $rule["direction"]);
            } else {
                $symbols_and_rules[] = array(
                    "symbol" => $rule["symbol"],
                    "rule" => 2,
                    "char" => $rule["direction"],
                );
            }
        } elseif (isset($rule["delete"])) {
            if (strlen($rule["delete"]) != 1) {
                array_push($errors, $rule_number . ". Invalid character for the third rule - " . $rule["delete"] . " because length" . strlen($rule["delete"]) . " != 1");
            } else {
                $symbols_and_rules[] = array(
                    "symbol" => $rule["symbol"],
                    "rule" => 3,
                    "char" => $rule["delete"],
                );
            }
        } else {
            array_push($errors, $rule_number . ". Invalid rule");
        }
        $rule_number++;
    }

    if (!empty($errors)) {
        print_r($errors);
    }

    return $symbols_and_rules;
}

function decode_data_from_file($file, array $rules)
{
    $data = file($file, FILE_IGNORE_NEW_LINES);

    foreach ($rules as $rule) {
        $first_symbols_length = strlen($rule["symbol"]);
        for ($i = 0; $i < count($data); $i++) {
            $line = $data[$i];
            if (substr($line, 0, $first_symbols_length) == $rule["symbol"]) {
                switch ($rule["rule"]) {
                    case 1:
                        $data[$i] = decode_by_first_rules($rule["char"], $line);
                        break;
                    case 2:
                        $data[$i] = decode_by_second_rules($rule["char"], $line);
                        break;
                    case 3:
                        $data[$i] = decode_by_third_rules($rule["char"], $line);
                        break;
                    default:
//                        $data[$i] = $line;
                        break;
                }
            }
        }
    }

    return $data;
}

function echo_array_data(array $data)
{
    foreach ($data as $line) {
        echo $line . "<br>";
    }
}

$rules = get_rules($config);

echo_array_data(decode_data_from_file($file, $rules));

?>