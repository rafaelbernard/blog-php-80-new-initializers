<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/bootstrap.php';

$connection = \Blog\Core::getConnection();

$queryService = new \Blog\Infrastructure\DbalLeadQueryService();

$unsortedLeads = $queryService->getAll();

echo PHP_EOL . "Unsorted" . PHP_EOL . PHP_EOL;
var_dump($unsortedLeads);

$service = new \Blog\Application\DefaultLeadRecordService();

$service->add('will-not-repeat@email.com');

$sortedLeads = $service->getAll();

echo PHP_EOL . "Sorted" . PHP_EOL . PHP_EOL;
var_dump($sortedLeads);
