<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 20.03.2018
 * Time: 21:21
 * @param string $password
 */

function check_password(string &$password)
{
    $errors = [];

    $patterns = array(
        0 => ["[A-Z]", "латинских прописных букв"],
        1 => ["[a-z]", "латинских строчных букв"],
        2 => ["[0-9]", "цифр"],
        3 => ["[\\*%$#_]", "специальных символов"],
    );

//    $specials = "^(?=.*[A-Z])(?=.*[%$#_*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z]).*$";

    if (strlen($password) < 2) {
        array_push($errors, "в пароле содержится менее 10 символов");
    } else {
        foreach ($patterns as $item) {
            $pattern = "/(.*" . $item[0] . "+.*){2,}/";
//            echo "<tt>" . htmlspecialchars($pattern) . "</tt></br>";
            if (!preg_match($pattern, $password)) {
                array_push($errors, "в пароле содержится менее 2 " . $item[1]);
            }
            $pattern = "/" . $item[0] . "{3,}/";
//            echo "<tt>" . htmlspecialchars($pattern) . "</tt></br>";
            if (preg_match($pattern, $password)) {
                array_push($errors, "пароль содержит более 3 " . $item[1] . " подряд");
            }
        }
    }

    if (empty($errors)) {
        return true;
    }

    return $errors;
}
