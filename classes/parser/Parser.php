<?php


namespace app\parser;

use app\exception\CsvRowException;
use app\mapper\CsvRowMapper;
use app\resolver\CsvResolver;

/**
 * Class Parser
 * @package app\parser
 *
 * Parsing data for api result
 */
class Parser
{
    /**
     * @var CsvRowMapper
     */
    private $csvRowMapper;

    /**
     * @var CsvResolver
     */
    private $csvResolver;

    public function __construct(
        CsvRowMapper $csvRowMapper,
        CsvResolver $csvResolver
    ) {
        $this->csvRowMapper = $csvRowMapper;
        $this->csvResolver = $csvResolver;
    }

    /**
     * @param array $data
     * @return array
     * @throws CsvRowException
     */
    public function parse(array $data) : array
    {
        if (empty($data) || !is_array($data)) {
            return false;
        }
        $returnData = [];

        foreach ($data as $row) {
            if (!is_array($row)) {
                throw new CsvRowException();
            }
            try {
                $csvRow = $this->csvRowMapper->map($row);
                $returnData[] = $this->csvResolver->resolveAction($csvRow);
            } catch (CsvRowException $e) {
                $returnData[] = $e->getMessage();
            }
        }
        $returnData['stats'] = $this->csvResolver->resolveStats($returnData);

        return $returnData;
    }
}
