<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 22.04.2018
 * Time: 15:28
 */

namespace myNameSpace;


use myExceptions\MyFifthException;
use myExceptions\MyFirstException;
use myExceptions\MyFourthException;
use myExceptions\MySecondException;
use myExceptions\MyThirdException;

class MyClass
{

    /**
     * @param bool $b
     * @throws MySecondException
     * @throws MyFirstException
     */
    public function firstMethod(bool $b)
    {
        if ($b) {
            throw new MyFirstException("Caught first exception");
        }
        throw new MySecondException("Caught second exception");
    }

    /**
     * @param bool $b
     * @throws MySecondException
     * @throws MyThirdException
     */
    public function secondMethod(bool $b)
    {
        if ($b) {
            throw new MySecondException("Caught second exception");
        }
        throw new MyThirdException("Caught third exception");
    }

    /**
     * @param bool $b
     * @throws MyFourthException
     * @throws MyThirdException
     */
    public function thirdMethod(bool $b)
    {
        if ($b) {
            throw new MyThirdException("Caught third exception");
        }
        throw new MyFourthException("Caught fourth exception");
    }

    /**
     * @param bool $b
     * @throws MyFifthException
     * @throws MyFourthException
     */
    public function fourthMethod(bool $b)
    {
        if ($b) {
            throw new MyFourthException("Caught fourth exception");
        }
        throw new MyFifthException("Caught fifth exception");
    }

}