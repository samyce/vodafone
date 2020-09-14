<?php


namespace app\entity;

/**
 * Class CsvRowEntity
 * @package app\entity
 *
 * Csv row entity
 */
class CsvRowEntity
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $credit;

    /**
     * @var \DateTime
     */
    private $date;

    public function __construct($name, $credit, $date)
    {
        $this->name = $name;
        $this->credit = $credit;
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
