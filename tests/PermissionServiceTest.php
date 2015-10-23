<?php

namespace MidnightTest\Permissions;

use Interop\Container\ContainerInterface;
use Midnight\Permissions\PermissionInterface;
use Midnight\Permissions\PermissionService;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * Class PermissionServiceTest
 * @package MidnightTest\Permissions
 */
class PermissionServiceTest extends PHPUnit_Framework_TestCase
{
    /** @var ContainerInterface|PHPUnit_Framework_MockObject_MockObject */
    private $container;
    /** @var PermissionService */
    private $service;

    public function setUp()
    {
        $this->container = $this->getMock(ContainerInterface::class);
        $this->service = new PermissionService($this->container);
    }

    public function testIsAllowed()
    {
        $user = new stdClass;
        $permissionName = 'can_do_something';
        $resource = new stdClass;

        $permission = $this->getMock(PermissionInterface::class);
        $permission
            ->expects($this->any())
            ->method('isAllowed')
            ->with($user, $resource)
            ->willReturn(true);

        $this->container->method('has')->willReturn(true);
        $this->container->method('get')->willReturn($permission);

        $this->service->isAllowed($user, $permissionName, $resource);
    }

    /**
     * @expectedException \Midnight\Permissions\Exception\UnknownPermissionException
     */
    public function testUnknownPermission()
    {
        $this->container->method('has')->willReturn(false);

        $this->service->isAllowed(new stdClass, 'some_unknown_permission', new stdClass);
    }

    /**
     * @expectedException \Midnight\Permissions\Exception\InvalidPermissionException
     */
    public function testInvalidPermission()
    {
        $this->container->method('has')->willReturn(true);
        $this->container->method('get')->willReturn(new stdClass);

        $this->service->isAllowed(new stdClass, 'some_unknown_permission', new stdClass);
    }
}
