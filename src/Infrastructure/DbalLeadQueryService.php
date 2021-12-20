<?php

namespace Blog\Infrastructure;

use Blog\Core;
use Blog\Domain\LeadQueryService;
use Doctrine\DBAL\Connection;

class DbalLeadQueryService implements LeadQueryService
{
    public function __construct(private ?Connection $connection = null)
    {
        // waiting when `new initializers` feature allows static function as default parameters
        if (!$this->connection) {
            $this->connection = Core::getConnection();
        }
    }

    public function getAll(): array
    {
        return $this->connection->createQueryBuilder()
            ->select('*')
            ->from('leads')
            ->fetchAllAssociative();
    }

    public function getByEmail(string $email): array|false
    {
        return $this->connection->createQueryBuilder()
            ->select('*')
            ->from('leads')
            ->where('email = ?')
            ->setParameter(0, $email)
            ->fetchAssociative();
    }
}
