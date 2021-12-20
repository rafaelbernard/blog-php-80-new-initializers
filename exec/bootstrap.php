<?php
require_once __DIR__ . '/../vendor/autoload.php';

if (!file_exists(DB_FILE)) {
    $connection = \Blog\Core::getConnection(DB_FILE);
    $connection->executeQuery('CREATE TABLE IF NOT EXISTS leads ( email VARCHAR )');
}
