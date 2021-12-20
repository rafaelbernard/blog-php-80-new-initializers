<?php

namespace Blog\Domain;

interface LeadQueryService
{
    public function getAll(): array;

    public function getByEmail(string $email): array|false;
}
