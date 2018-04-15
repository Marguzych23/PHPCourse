<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 15.04.2018
 * Time: 0:21
 */

abstract class Logger
{

    protected $data;
    protected $checkedData;

    /**
     * Logger constructor.
     * @param $data
     */
    public function __construct($data)
    {
        if (is_string($data)) {
            $this->data = array($data);
        } elseif (is_array($data)) {
            $this->data = $data;
        }
    }

    public function checkData()
    {
        $checkedStringStart = "Строка ";
        $checkedStringFalse = " не";
        $checkedStringEnd = " содержит заглавные буквы";
        $emptyArray = [];
        foreach ($this->data as $item) {
            $emptyString = strtolower($item);
            $checkedString = "";
            $checkedString .= $checkedStringStart . "'" . $item . "'";
            if ($item === $emptyString) {
                $checkedString .= $checkedStringFalse;
            }
            $checkedString .= $checkedStringEnd;
            array_push($emptyArray, $checkedString);
        }
        /** @var TYPE_NAME $emptyArray */
        $this->checkedData = $emptyArray;
    }

    public abstract function writeCheckedData();

    /**
     * @return mixed
     */
    public function getCheckedData()
    {
        return $this->checkedData;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

}