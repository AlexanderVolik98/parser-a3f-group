<?php

namespace src;

use DOMDocument;
use DOMElement;
use DOMXPath;
use src\Exception\CurlErrorException;
use src\Exception\CurlInvalidArgumentException;

class Parser
{
    private string $content;
    private array $tags = [];

    public function __construct($url)
    {
        try {
            $this->checkUrl($url);
        } catch (CurlErrorException $e) {
            exit ($e->getCurlMessageError());
        } catch (CurlInvalidArgumentException $e) {
            exit ($e->getCurlMessageError());
        }
    }

    public function processContent()
    {
        $dom = new DOMDocument();
        @$dom->loadHtml($this->content);

        $domNodeList = (new DOMXPath($dom))->query('//*');

        foreach ($domNodeList as $element) {
            /** @var DOMElement $element */
            isset ($this->tags[$element->tagName])
                ? $this->tags[$element->tagName] += 1
                : $this->tags += [$element->tagName => 1];
        }
    }

    private function checkUrl(string $url): void
    {
        if ((int)$url != 0) {
            throw new CurlInvalidArgumentException($url);
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new CurlErrorException(curl_error($ch), curl_errno($ch));
        }

        curl_close($ch);

        $this->content = $content;
    }

    public function outputData(): string
    {
        return json_encode($this->tags);
    }
}
