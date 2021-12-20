<?php

namespace Blog\Domain;

interface LeadCommandHandler
{
    public function add(string $email): int;
}
