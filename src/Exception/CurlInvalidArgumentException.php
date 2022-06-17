<?php

namespace src\Exception;

use InvalidArgumentException;

class CurlInvalidArgumentException extends InvalidArgumentException
{
    private string $url;

    public function __construct(string $url)
    {
        parent::__construct();

        $this->url = $url;
    }

    public function getCurlMessageError(): string
    {
        return 'Передан некорректный url: ' . $this->url . PHP_EOL;
    }
}
