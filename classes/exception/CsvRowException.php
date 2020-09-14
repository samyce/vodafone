<?php


namespace app\exception;

use Throwable;

/**
 * Class CsvRowException
 * @package app\exception
 *
 * Custom csv exception
 */
class CsvRowException extends \Exception
{
    const MESSAGE = 'Bad parameter value';

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($this::MESSAGE, $code, $previous);
    }
}
