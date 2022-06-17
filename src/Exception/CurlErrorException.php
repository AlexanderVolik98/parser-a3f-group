<?php

namespace src\Exception;

use RuntimeException;

class CurlErrorException extends RuntimeException
{
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }

    public function getCurlMessageError(): string
    {
        return 'Ошибка переданного ресурса: ' . $this->getMessage() . ' Код ошибки: ' . $this->getCode() . PHP_EOL;
    }
}
