<?php


namespace app\mapper;

use app\entity\CsvRowEntity;
use app\exception\CsvRowException;

/**
 * Class CsvRowMapper
 * @package app\mapper
 *
 * Map array to entity
 */
class CsvRowMapper
{
    /**
     * Map array to entity
     * @param array $row
     * @return CsvRowEntity
     * @throws CsvRowException
     */
    public function map(array $row) : CsvRowEntity
    {
        if (empty($row[0]) || empty($row[1]) || empty($row[2])) {
            throw new CsvRowException();
        }
        [$name, $credit, $date] = $row;

        $name = trim($name);
        $credit = trim($credit);
        $date = trim($date);

        $date = \DateTime::createFromFormat('j.n.Y', $date);

        if (!$date) {
            throw new CsvRowException();
        }

        $row = new CsvRowEntity($name, $credit, $date);

        return $row;
    }
}
