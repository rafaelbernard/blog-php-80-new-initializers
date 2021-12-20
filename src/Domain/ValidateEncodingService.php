<?php

namespace Blog\Domain;

interface ValidateEncodingService
{
    public function validate(string $filePath): bool;
}
