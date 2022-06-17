<?php

namespace src\Model;

use src\Exception\CurlErrorException;
use src\Exception\CurlInvalidArgumentException;

class Url extends Parser
{
    public function __construct($url)
    {
        try {
            $content = $this->prepareContent($url);
        } catch (CurlErrorException $e) {
            exit ($e->getCurlMessageError());
        } catch (CurlInvalidArgumentException $e) {
            exit ($e->getCurlMessageError());
        }

        parent::__construct($content, $url);
    }

    protected function prepareContent(string $source): string
    {
        if ((int)$source != 0) {
            throw new CurlInvalidArgumentException($source);
        }

        $ch = curl_init($source);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new CurlErrorException(curl_error($ch), curl_errno($ch));
        }

        curl_close($ch);

        return $content;
    }
}
