<?php


namespace app\exception;

use Throwable;

/**
 * Class CsvRowException
 * @package app\exception
 *
 * Authentication exception
 */
class LoginException extends \Exception
{
    const MESSAGE = 'Bad authentication';

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($this::MESSAGE, $code, $previous);
    }
}
