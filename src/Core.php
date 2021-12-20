<?php

namespace Blog;

use Doctrine\DBAL\Connection;

class Core
{
    public static function getConnection(string $databaseLocation = '/tmp/temp.db'): Connection
    {
        $config = new \Doctrine\DBAL\Configuration();
        $connectionParams = [
            'url' => "sqlite:///$databaseLocation",
        ];
        return \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
    }
}
