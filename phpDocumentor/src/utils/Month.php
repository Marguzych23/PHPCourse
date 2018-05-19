<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 28.04.2018
 * Time: 23:13
 */

namespace utils;

use IteratorAggregate;

class Month implements IteratorAggregate
{

    private $month;
    private $year;

    /**
     * Month constructor.
     * @param $month
     * @param $year
     */
    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return MonthIterator
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        $monthDays = array();

        $date = new \DateTime();
        $date->setDate($this->year, $this->month, 1);
        while (true) {
            if ($date->format("m") != $this->month) {
                break;
            }
            array_push($monthDays, $this->reformCode($date));
            try {
                $date->add(new \DateInterval("P1D"));
            } catch (\Exception $e) {
                print "sad";
            }
        }
        return new MonthIterator($monthDays);
    }

    /**
     * По дню месяца выводится его день недели.
     * @param int $day
     * @return string
     */
    public function getWeekDay(int $day)
    {
        $date = new \DateTime();
        $date->setDate($this->year, $this->month, $day);
        if ($date->format("d") != $day) {
            throw new \ArgumentCountError("Wrong day number!");
        }
        return $date->format("D");
    }

    /**
     * @param \DateTime $date
     * @param bool $bool default = false
     * @return string
     */
    private function reformCode(\DateTime $date, $bool = false)
    {
        $day = $date->format("d");
        $weekDay = $date->format("D");
        $start = "";
        $end = "";
        if ($weekDay == "Sun") {
            $end .= "<br>";
        }
        if ($date->format("d") == 1) {
            $count = 7;
            while (true) {
                if ($date->format("D") == "Sun") {
                    break;
                }
                $count--;
                try {
                    $date->add(new \DateInterval("P1D"));
                } catch (\Exception $e) {
                }
            }
            if ($count != 7) {
                for ($i = 0; $i < $count; $i++) {
                    $start .= "&nbsp";
                }
            }
        }
        if ($bool) {
            return $start . $weekDay . $end;
        }
        return $start . $day . $end;
    }
}