<?php

use src\CLI;

require_once './Autoloader.php';

$cli = new CLI();

$typeResource = readline('Введите идентификатор источника (' . CLI::URL_PARSER . ' - url, ' . CLI::FILE_PARSER . ' - файл): ');

if ($typeResource == CLI::URL_PARSER) {
    $url = readline('Введите url: ');
    $parser = $cli->createUrlParser($url);
} else if ($typeResource == CLI::FILE_PARSER) {
    $file = readline('Введите путь до файла: ');
    $parser = $cli->createFileParser($file);
} else {
    exit('Неопознанный идентификатор - ' . $typeResource . PHP_EOL);
}

$parser->processContent();

echo($parser->outputData());
