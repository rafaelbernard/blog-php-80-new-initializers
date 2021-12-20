<?php

namespace Test;

use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected const VALID_COD_EVENTO = '100';
    protected const VALID_CPF = '56283453341';
    protected const IP_LOCALHOST = '127.0.0.1';

    public function testIsTrue()
    {
        $this->assertTrue(true);
    }
}
