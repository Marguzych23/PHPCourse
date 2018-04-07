<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 07.04.2018
 * Time: 22:50
 */


$ip_regex = "#\d{1,3}(\.\d{1,3}){3}#";
$percent_regex = "#\d{1,3}%#";
$host_regex = "##";

/**
 * @param string $address
 * @param string $connection_type
 * @return string trace
 */
function check_connection(string $address, string $connection_type)
{
    switch ($connection_type) {
        case "ping":
            {
                return ping($address);
            }
        case "tracert":
            {
                return tracert($address);
            }
        default:
            {
                return "Неизвествий тип соединения";
            }
    }
}

/**
 * @param string $address
 * @return string
 */
function tracert(string $address)
{
    global $ip_regex;

    $address = check_and_escape_address($address);
    if ($address == null) {
        return "Не правильно введён адрес сайта";
    }

    $formatted_output = "tracert ";

    $command = "tracert " . $address;
    $output = [];
    $o = exec($command, $output);

    foreach ($output as $line) {
        $o .= "\n" . $line;
    }

    $matches = [];
    if (preg_match($ip_regex, $o, $matches)) {
        $formatted_output .= "<b>" . $matches[0] . "</b><br>";
        foreach ($matches as $ip) {
            $formatted_output .= "<b>" . $ip . "</b>" . " ";
        }
    } else {
        return "Отправка не удалась";
    }

    return $formatted_output;
}

/**
 * @param string $address
 * @return string
 */
function ping(string $address)
{
    global $percent_regex, $ip_regex;

    $address = check_and_escape_address($address);
    if ($address == null) {
        return "Не правильно введён адрес сайта";
    }

    $formatted_output = "ping ";

    $command = "ping " . $address;
    $output = [];
    $o = exec($command, $output);

    foreach ($output as $line) {
        $o .= "\n" . $line;
    }

    $ip_matches = [];
    $percent_matches = [];
    if (preg_match($ip_regex, $o, $ip_matches) and preg_match($percent_regex, $o, $percent_matches)) {
        $percent = 100 - (int)$percent_matches[0];

        $formatted_output .=
            "<b>" . $ip_matches[0] . "</b><br>"
            . $percent . "% успешно";
    } else {
        return "Отправка не удалась";
    }

    return $formatted_output;
}

/**
 * @param string $address
 * @return null|string
 * Не совсем понял, почему, при введении чисто хоста, parse_url($address) находит его как путь
 */
function check_and_escape_address(string $address)
{
    $url = parse_url($address);
    if (isset($url["path"])) {
        if (strlen($address) != 0 and $url["path"] == $address) {
            return escapeshellarg($address);
        }
    }

    return null;
}