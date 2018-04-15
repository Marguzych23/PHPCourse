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
     * @param int $dateConst
     */
    public function __construct(int $dateConst)
    {
        $this->dateConst = $dateConst;
        parent::__construct();
    }


    public function write(array $data)
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
        foreach ($data as $item) {
            echo $item . "<br>";
        }
    }

    /**
     * @return int
     */
    public function getDateConst(): int
    {
        return $this->dateConst;
    }

    /**
     * @param int $dateConst
     */
    public function setDateConst(int $dateConst): void
    {
        $this->dateConst = $dateConst;
    }

}