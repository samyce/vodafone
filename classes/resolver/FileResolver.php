<?php


namespace app\resolver;

/**
 * Class FileResolver
 * @package app\resolver
 *
 * Get data file form request
 */
class FileResolver
{
    const CELL_NUMBER = 3;

    /**
     * Prepare data
     * @return array
     */
    public function resolve() : array
    {
        $data = [];
        $fileData = $this->getFile();

        foreach ($fileData as $line) {
            $data[] = str_getcsv($line);
        }

        return $data;
    }

    /**
     * Get raw file from request
     * @return false|string[]
     */
    private function getFile()
    {
        $data = file_get_contents('php://input');

        return explode(PHP_EOL, $data);
    }
}
