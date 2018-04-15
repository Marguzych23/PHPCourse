<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 15.04.2018
 * Time: 0:21
 */

abstract class Logger
{

    /**
     * Logger constructor.
     */
    public function __construct()
    {
    }

    public abstract function write(array $data);

}