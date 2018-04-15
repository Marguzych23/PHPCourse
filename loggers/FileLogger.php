<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 15.04.2018
 * Time: 0:23
 */

class FileLogger extends Logger
{

    private $file;
    private $fp;

    public function __construct()
    {
        $arguments = func_get_args();
        $argumentsNumber = func_num_args();

        $data = [];

        switch ($argumentsNumber) {
            case 1:
                {
                    if (file_exists($arguments[0])) {
                        $this->file = $arguments[0];
                    }
                    break;
                }
            case 2:
                {
                    foreach ($arguments as $item) {
                        if (is_string($item)) {
                            if (file_exists($item)) {
                                $this->file = $item;
                                break;
                            }
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


    function __destruct()
    {
//        fclose($this->fp);
    }

    public function writeCheckedData()
    {
        $this->checkData();
        $this->fp = fopen($this->file, "a+");
        foreach ($this->checkedData as $item) {
            $fw = fwrite($this->fp, $item."\n");
            if (!$fw) {
//                Error
            }
        }
        fclose($this->fp);
    }


}