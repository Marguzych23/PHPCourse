<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 15.04.2018
 * Time: 0:23
 */

class BrowserLogger extends Logger
{

    const BROWSER_LOGGER_WITHOUT_DATE = 0;
    const BROWSER_LOGGER_ONLY_TIME = 1;
    const BROWSER_LOGGER_TIME_AND_DATE = 2;

    private $dateConst;

    /**
     * BrowserLogger constructor.
     */
    public function __construct()
    {

        $arguments = func_get_args();
        $argumentsNumber = func_num_args();

        $data = [];

        switch ($argumentsNumber) {
            case 1:
                {
                    if (is_numeric($arguments[0])) {
                        $this->dateConst = $arguments[0];
                    } else {
                        $data = $arguments[0];
                        $this->dateConst = 0;
                    }
                    break;
                }
            case 2:
                {
                    foreach ($arguments as $item) {
                        if (is_numeric($item)) {
                            $this->dateConst = $item;
                            break;
                        } else {
                            $data = $item;
                        }
                    }
                    if (empty($data)) {
                        $data = $arguments[1];
                    }
                    break;
                }
            default:
                {
//                    Error
                }
        }

        parent::__construct($data);
    }



    public function writeCheckedData()
    {
        switch ($this->dateConst) {
            case 1:
                {
                    echo date("H:i:s"). "<br>";
                    break;
                }
            case 2:
                {
                    echo date("d.m.y H:i:s"). "<br>";
                    break;
                }
        }
        $this->checkData();
        foreach ($this->checkedData as $item) {
            echo $item . "<br>";
        }
    }
}