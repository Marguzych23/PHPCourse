<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 19.05.2018
 * Time: 19:00
 */

namespace Models;


interface Number
{

    public function add(Number $number);

    public function sub(Number $number);

    public function mult(Number $number);

    public function div(Number $number);

    public function abs();
}