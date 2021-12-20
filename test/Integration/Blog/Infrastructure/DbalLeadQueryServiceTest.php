<?php

namespace Test\Integration\Blog\Infrastructure;

use Blog\Infrastructure\DbalLeadQueryService;
use Doctrine\DBAL\Connection;
use Faker\Factory;
use Faker\Generator;
use Test\TestCase;

class DbalLeadQueryServiceTest extends TestCase
{
    private string $databaseFilePath;

    private Generator $faker;
    private Connection $connection;

    private DbalLeadQueryService $service;

    public function testCanGetAll()
    {
        $this->addEmail($email1 = $this->faker->email());
        $this->addEmail($email2 = $this->faker->email());
        $this->addEmail($email3 = $this->faker->email());

        $expected = [
            ['email' => $email1],
            ['email' => $email2],
            ['email' => $email3],
        ];

        $fetched = $this->service->getAll();

        self::assertEquals($expected, $fetched);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();

        $this->createLeadTable();

        $this->service = new DbalLeadQueryService($this->connection());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->dropDatabase();
    }

    private function connection(): Connection
    {
        if (!isset($this->connection)) {
            $this->databaseFilePath = '/tmp/test-' . time();

            $config = new \Doctrine\DBAL\Configuration();
            $connectionParams = [
                'url' => "sqlite:///{$this->databaseFilePath}",
            ];

            $this->connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
        }

        return $this->connection;
    }

    private function dropDatabase()
    {
        @unlink($this->databaseFilePath);
    }

    private function createLeadTable(): void
    {
        $this->connection()->executeQuery('CREATE TABLE IF NOT EXISTS leads ( email VARCHAR )');
    }

    private function addEmail(string $email): int
    {
        return $this->connection()->insert('leads', ['email' => $email]);
    }
}
