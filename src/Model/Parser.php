<?php

namespace src\Model;

abstract class Parser
{
    protected array $tags = [];

    protected string $content;

    protected string $source;

    public function __construct($content, $source)
    {
        $this->content = $content;
        $this->source = $source;
    }

    abstract protected function prepareContent(string $source): string;

    public function processContent(): void
    {
        preg_match_all('/(?<=<)\w+\b(?=[^>]*>)/', $this->content, $matches);

        foreach ($matches as $tags) {
            foreach ($tags as $tag) {
                isset ($this->tags[$tag])
                    ? $this->tags[$tag] += 1
                    : $this->tags += [$tag => 1];
            }
        }
    }

    public function outputData(): string
    {
        return json_encode($this->tags) . PHP_EOL;
    }
}