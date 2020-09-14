<?php

namespace app;

use app\exception\LoginException;
use app\parser\Parser;
use app\resolver\FileResolver;

/**
 * Class Handler
 * @package app
 *
 * Request handler
 */
class Handler
{
    const USER_LOGIN = 'test';
    const USER_PASSWORD = 'test';

    /**
     * @var FileResolver
     */
    private $fileResolver;

    /**
     * @var Parser
     */
    private $parser;

    public function __construct(
        FileResolver $fileResolver,
        Parser $parser
    ) {
        $this->fileResolver = $fileResolver;
        $this->parser = $parser;
    }

    /**
     * Handle request
     */
    public function handle() : void
    {
        try {
            $this->checkLogin();
            $data = $this->fileResolver->resolve();
            $result = $this->parser->parse($data);
            $this->jsonResponse($result);
        } catch (\Exception $e) {
            $this->jsonResponse([$e->getMessage()]);
        }
    }

    /**
     * Create json response
     * @param array $result
     */
    private function jsonResponse(array $result) : void
    {
        echo json_encode($result);
        die;
    }

    /**
     * Check authentication
     * @throws LoginException
     */
    private function checkLogin() : void
    {
        $user = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];

        if ($user !== $this::USER_LOGIN || $password !== $this::USER_PASSWORD) {
            throw new LoginException();
        }
    }
}
