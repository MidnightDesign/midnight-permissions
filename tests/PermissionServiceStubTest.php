<?php

declare(strict_types=1);

namespace MidnightTest\Permissions;

use Midnight\Permissions\PermissionServiceStub;
use PHPUnit\Framework\TestCase;

class PermissionServiceStubTest extends TestCase
{
    /** @var PermissionServiceStub */
    private $service;

    protected function setUp()
    {
        parent::setUp();

        $this->service = new PermissionServiceStub();
    }

    public function testIsAllowedDefaultsToTrue()
    {
        $this->assertTrue($this->service->isAllowed(null, 'some_permission'));
    }

    public function testSetIsAllowed()
    {
        $this->service->setIsAllowed(false);

        $this->assertFalse($this->service->isAllowed(null, 'some_permission'));
    }
}
