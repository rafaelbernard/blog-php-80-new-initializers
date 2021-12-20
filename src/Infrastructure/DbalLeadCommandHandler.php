<?php

namespace Blog\Infrastructure;

use Blog\Core;
use Blog\Domain\LeadCommandHandler;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class DbalLeadCommandHandler implements LeadCommandHandler
{
    private QueryBuilder $builder;

    public function __construct(?Connection $connection = null)
    {
        // waiting when `new initializers` feature allows static function as default parameters
        if (!$connection) {
            $connection = Core::getConnection();
        }

        $this->builder = $connection->createQueryBuilder();
    }

    public function add(string $email): int
    {
        return $this->builder
            ->insert('leads')
            ->setValue('email', ':email')
            ->setParameter('email', $email)
            ->executeStatement();
    }
}
