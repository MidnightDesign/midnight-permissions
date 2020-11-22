<?php

declare(strict_types=1);

namespace MidnightTest\Permissions;

use Midnight\Permissions\PermissionServiceStub;
use PHPUnit\Framework\TestCase;

class PermissionServiceStubTest extends TestCase
{
    private PermissionServiceStub $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new PermissionServiceStub();
    }

    public function testIsAllowedDefaultsToTrue(): void
    {
        self::assertTrue($this->service->isAllowed(null, 'some_permission'));
    }

    public function testSetIsAllowed(): void
    {
        $this->service->setIsAllowed(false);

        self::assertFalse($this->service->isAllowed(null, 'some_permission'));
    }
}
