<?php

namespace Test\Unit\Blog\Application;

use Blog\Application\DefaultLeadRecordService;
use Blog\Domain\LeadCommandHandler;
use Blog\Domain\LeadQueryService;
use PHPUnit\Framework\MockObject\MockObject;
use Test\TestCase;

class DefaultLeadRecordServiceTest extends TestCase
{
    private const EMAIL = 'fake@email.com';

    private LeadQueryService|MockObject $leadQueryServiceMock;
    private LeadCommandHandler|MockObject $leadCommandHandlerMock;

    private DefaultLeadRecordService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->leadQueryServiceMock = $this->getMockBuilder(LeadQueryService::class)->getMock();
        $this->leadCommandHandlerMock = $this->getMockBuilder(LeadCommandHandler::class)->getMock();

        $this->service = new DefaultLeadRecordService($this->leadQueryServiceMock, $this->leadCommandHandlerMock);
    }

    public function testCanAdd()
    {
        $email = 'fake@email.com';

        $this->leadQueryServiceMock
            ->expects(self::once())
            ->method('getByEmail')
            ->with(self::EMAIL)
            ->willReturn(false);

        $this->leadCommandHandlerMock
            ->expects(self::once())
            ->method('add')
            ->with(self::EMAIL)
            ->willReturn(1);

        $result = $this->service->add(self::EMAIL);

        self::assertEquals(1, $result);
    }

    public function testAddExistentReturnsFalse()
    {
        $this->leadQueryServiceMock
            ->expects(self::once())
            ->method('getByEmail')
            ->with(self::EMAIL)
            ->willReturn(['email' => self::EMAIL]);

        $this->leadCommandHandlerMock
            ->expects(self::never())
            ->method('add');

        $result = $this->service->add(self::EMAIL);

        self::assertFalse($result);
    }

    public function testCanGetAll()
    {
        $unsorted = [
            ['email' => 'z@email.com'],
            ['email' => 'a@email.com'],
            ['email' => 'b@email.com'],
        ];

        $this->leadQueryServiceMock
            ->expects(self::once())
            ->method('getAll')
            ->willReturn($unsorted);

        $fetched = $this->service->getAll();

        $expected = $unsorted;
        asort($expected);

        self::assertEquals($expected, $fetched);
    }
}
