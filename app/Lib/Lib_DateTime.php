<?php
/**
 * This is simply a wrapper around the standard DateTime class
 * @version: 20160510
 * @author: Md Fahim Uddin
 */

class Lib_DateTime
{
    /**
     * instance of the standard DateTime class
     * @var object
     */
    public $dateTime;

    /**
     * class constructor
     */
    public function __construct()
    {
        $this->setDateTime(date('Y-m-d H:i:s'));
    }

    /**
     * @param datetime $time
     * @return object (of the DataTime class)
     */
    public function setDateTime($time)
    {
        $this->dateTime = new DateTime($time);
        $this->dateTime->setTimezone(new DateTimeZone('Europe/London'));

        return $this->dateTime;
    }
}