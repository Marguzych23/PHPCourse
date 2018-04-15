<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 15.04.2018
 * Time: 0:23
 */

class FileLogger extends Logger
{

    private $filename;
    private $fp;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        parent::__construct();
    }


    function __destruct()
    {
        fclose($this->fp);
    }

    public function write(array $data)
    {
        $this->fp = fopen($this->filename, "a+");
        foreach ($data as $item) {
            $fw = fwrite($this->fp, $item."\n");
            if (!$fw) {
//                Error
            }
        }
    }

    /**
     * @param $filename
     */
    public function setFile($filename): void
    {
        $this->filename = $filename;
    }



}