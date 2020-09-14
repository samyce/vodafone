<?php


namespace app;

use app\parser\Parser;
use app\resolver\FileResolver;
use app\resolver\CsvResolver;
use app\mapper\CsvRowMapper;

/**
 * Class Container
 * @package app
 *
 * Simulation of Container for DI
 */
class Container
{
    const METHOD_PREFIX_GET = 'get';

    /**
     * @var array
     */
    private $register;


    public function getHandler()
    {
        return new Handler(
            $this->getService('FileResolver'),
            $this->getService('Parser')
        );
    }

    public function getFileResolver()
    {
        return new FileResolver();
    }

    public function getParser()
    {
        return new Parser(
            $this->getService('CsvRowMapper'),
            $this->getService('CsvResolver')
        );
    }

    public function getCsvRowMapper()
    {
        return new CsvRowMapper();
    }

    public function getCsvResolver()
    {
        return new CsvResolver();
    }

    /**
     * Get (or create) instance of service
     * @param string $name
     * @return mixed
     */
    public function getService(string $name)
    {
        if (empty($this->register[$name])) {
            $this->register[$name] = $this->createService($name);
        }
        return $this->register[$name];
    }

    /**
     * Create new instance of service
     * @param string $name
     * @return mixed
     */
    public function createService(string $name)
    {
        return call_user_func([$this, $this::METHOD_PREFIX_GET . $name]);
    }
}
