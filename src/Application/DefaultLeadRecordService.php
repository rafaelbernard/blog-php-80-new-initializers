<?php

namespace Blog\Application;

use Blog\Domain\LeadCommandHandler;
use Blog\Domain\LeadQueryService;
use Blog\Domain\LeadRecordService;
use Blog\Infrastructure\DbalLeadCommandHandler;
use Blog\Infrastructure\DbalLeadQueryService;

class DefaultLeadRecordService implements LeadRecordService
{
    public function __construct(
        private LeadQueryService $queryService = new DbalLeadQueryService(),
        private LeadCommandHandler $commandHandler = new DbalLeadCommandHandler()
    ) {
    }

    public function add(string $email): bool|int
    {
        if (empty($this->queryService->getByEmail($email))) {
            return $this->commandHandler->add($email);
        }

        return false;
    }

    public function getAll(): array
    {
        $records = $this->queryService->getAll();

        asort($records);

        return $records;
    }
}
