<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 19.05.2018
 * Time: 17:03
 */

namespace myLog;

use models\Entry;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class JSONLogger implements LoggerInterface
{

    private $filename;
    private $fp;

    private $count = 0;
    const DELIMITER = ",";

    public function __construct()
    {
        $this->filename = "data.json";
        $this->fp = fopen($this->filename, "w+");
        $fw = fwrite($this->fp, "[");

        if (!$fw) {
            print_r("Error");
        }
    }


    function __destruct()
    {
        $fw = fwrite($this->fp, "]");

        if (!$fw) {
            print_r("Error");
        }
        fclose($this->fp);
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function emergency($message, array $context = array())
    {
        $this->logg(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function alert($message, array $context = array())
    {
        $this->logg(LogLevel::ALERT, $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function critical($message, array $context = array())
    {
        $this->logg(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function error($message, array $context = array())
    {
        $this->logg(LogLevel::ERROR, $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function warning($message, array $context = array())
    {
        $this->logg(LogLevel::WARNING, $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function notice($message, array $context = array())
    {
        $this->logg(LogLevel::NOTICE, $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function info($message, array $context = array())
    {
        $this->logg(LogLevel::INFO, $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function debug($message, array $context = array())
    {
        $this->logg(LogLevel::DEBUG, $message, $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        $this->logg($level, $message, $context);
    }

    private function logg($level, $message, array $context = array())
    {
        if (!empty($context)) {
            $message = $this->interpolate($message, $context);
        }

        $data = $this->createJSONData($level, $message);

        if ($this->count) {
            $data = JSONLogger::DELIMITER . $data;
        }

        $fw = fwrite($this->fp, $data);

        $this->count++;

        if (!$fw) {
            print_r("Error");
        }

    }

    private function createJSONData($level, $data)
    {
        $model = new Entry($level, date("d.m.y H:i:s"), $data);
        return json_encode($model);
    }

    /*
    * Подстановка значений в плейсхолдеры сообщения.
    */
    private function interpolate($message, array $context = array())
    {
        // Построение массива подстановки с фигурными скобками
        // вокруг значений ключей массива context.
        $replace = array();
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }

        // Подстановка значений в сообщение и возврат результата.
        return strtr($message, $replace);
    }
}