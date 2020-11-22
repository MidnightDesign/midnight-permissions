<?php

declare(strict_types=1);

namespace MidnightTest\Permissions;

use Interop\Container\ContainerInterface;
use Midnight\Permissions\Exception\InvalidPermissionException;
use Midnight\Permissions\Exception\UnknownPermissionException;
use Midnight\Permissions\PermissionInterface;
use Midnight\Permissions\PermissionService;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use stdClass;

class PermissionServiceTest extends TestCase
{
    /** @var ContainerInterface|PHPUnit_Framework_MockObject_MockObject */
    private $container;
    /** @var PermissionService */
    private $service;

    public function setUp()
    {
        $this->container = $this->createMock(ContainerInterface::class);
        $this->service = new PermissionService($this->container);
    }

    public function testIsAllowed()
    {
        $user = new stdClass();
        $permissionName = 'can_do_something';
        $resource = new stdClass();

        $permission = $this->createMock(PermissionInterface::class);
        $permission
            ->expects($this->any())
            ->method('isAllowed')
            ->with($user, $resource)
            ->willReturn(true);

        $this->container->method('has')->willReturn(true);
        $this->container->method('get')->willReturn($permission);

        $this->assertTrue($this->service->isAllowed($user, $permissionName, $resource));
    }

    public function testUnknownPermission()
    {
        $this->container->method('has')->willReturn(false);

        $this->expectException(UnknownPermissionException::class);

        $this->service->isAllowed(new stdClass(), 'some_unknown_permission', new stdClass());
    }

    public function testInvalidPermission()
    {
        $this->container->method('has')->willReturn(true);
        $this->container->method('get')->willReturn(new stdClass());

        $this->expectException(InvalidPermissionException::class);

        $this->service->isAllowed(new stdClass(), 'some_unknown_permission', new stdClass());
    }
}
