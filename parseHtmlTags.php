<?php

use src\Parser;

require_once './src/Parser.php';
require_once './src/Exception/CurlErrorException.php';
require_once './src/Exception/CurlInvalidArgumentException.php';

$parser = new Parser($argv[1]);

$parser->processContent();

echo($parser->outputData());
