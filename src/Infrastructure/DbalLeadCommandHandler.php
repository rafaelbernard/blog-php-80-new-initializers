<?php

namespace Blog\Infrastructure;

use Blog\Core;
use Blog\Domain\LeadCommandHandler;
use Doctrine\DBAL\Connection;

class DbalLeadCommandHandler implements LeadCommandHandler
{
    public function __construct(private ?Connection $connection = null)
    {
        // waiting when `new initializers` feature allows static function as default parameters
        if (!$this->connection) {
            $this->connection = Core::getConnection();
        }
    }

    public function add(string $email): int
    {
        return $this->connection->createQueryBuilder()
            ->insert('leads')
            ->setValue('email', ':email')
            ->setParameter('email', $email)
            ->executeStatement();
    }
}
