<?php

namespace src\Model;

use src\Exception\FileInvalidArgumentException;

class File extends Parser
{
    public function __construct($file)
    {
        try {
            $content = $this->prepareContent($file);
        } catch (FileInvalidArgumentException $e) {
            exit ($e->getFileMessageError());
        }

        parent::__construct($content, $file);
    }

    protected function prepareContent(string $source): string
    {
        $filePath = trim($source);
        @$content = file_get_contents($filePath);

        if (false === $content) {
            throw new FileInvalidArgumentException($filePath);
        }

        return $content;
    }

    public function outputData(): string
    {
        return json_encode($this->tags) . PHP_EOL;
    }
}