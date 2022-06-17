<?php

namespace src\Exception;

use InvalidArgumentException;

class FileInvalidArgumentException extends InvalidArgumentException
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        parent::__construct();

        $this->filePath = $filePath;
    }

    public function getFileMessageError(): string
    {
        return 'Передан некорректный файл: ' . $this->filePath . PHP_EOL;
    }
}