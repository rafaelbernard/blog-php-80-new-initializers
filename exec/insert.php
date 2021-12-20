<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/bootstrap.php';

$faker = Faker\Factory::create();

$commandHandler = new \Blog\Infrastructure\DbalLeadCommandHandler();

$commandHandler->add($email = $faker->email());

$queryService = new \Blog\Infrastructure\DbalLeadQueryService();

$allLeads = $queryService->getAll();

echo PHP_EOL . "All" . PHP_EOL;
var_dump($allLeads);

echo PHP_EOL . "Recently added" . PHP_EOL;
var_dump($queryService->getByEmail($email));
