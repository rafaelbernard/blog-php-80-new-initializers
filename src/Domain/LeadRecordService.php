<?php

namespace Blog\Domain;

interface LeadRecordService
{
    public function add(string $email);

    public function getAll(): array;
}
