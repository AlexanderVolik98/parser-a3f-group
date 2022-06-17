<?php

namespace src;

use src\Model\File;
use src\Model\Url;

class CLI
{
    public const FILE_PARSER = 2;
    public const URL_PARSER = 1;

    public function createUrlParser(string $url): Url
    {
        return new Url($url);
    }

    public function createFileParser(string $filePath): File
    {
        return new File($filePath);
    }
}