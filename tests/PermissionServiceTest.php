<?php

declare(strict_types=1);

namespace MidnightTest\Permissions;

use Midnight\Permissions\Exception\InvalidPermissionException;
use Midnight\Permissions\Exception\UnknownPermissionException;
use Midnight\Permissions\PermissionInterface;
use Midnight\Permissions\PermissionService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use stdClass;

use function get_class;
use function gettype;
use function is_object;
use function sprintf;

class PermissionServiceTest extends TestCase
{
    /** @var ContainerInterface & MockObject */
    private $container;
    private PermissionService $service;

    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerInterface::class);
        $this->service = new PermissionService($this->container);
    }

    public function testIsAllowed(): void
    {
        $user = new stdClass();
        $permissionName = 'can_do_something';
        $resource = new stdClass();

        $permission = $this->createMock(PermissionInterface::class);
        $permission
            ->expects(self::any())
            ->method('isAllowed')
            ->with($user, $resource)
            ->willReturn(true);

        $this->container->method('has')->willReturn(true);
        $this->container->method('get')->willReturn($permission);

        self::assertTrue($this->service->isAllowed($user, $permissionName, $resource));
    }

    public function testUnknownPermission(): void
    {
        $this->container->method('has')->willReturn(false);

        $this->expectException(UnknownPermissionException::class);

        $this->service->isAllowed(new stdClass(), 'some_unknown_permission', new stdClass());
    }

    public function testInvalidPermission(): void
    {
        $this->container->method('has')->willReturn(true);
        $this->container->method('get')->willReturn(new stdClass());
        $permission = 'some_unknown_permission';

        $permissionObject = $this->container->get($permission);
        $this->expectException(InvalidPermissionException::class);
        $this->expectExceptionMessage(
            sprintf(
                '"%s" is not a permission. Expected an instance of %s, but got %s.',
                $permission,
                PermissionInterface::class,
                is_object($permissionObject) ? get_class($permissionObject) : gettype($permissionObject)
            )
        );

        $this->service->isAllowed(new stdClass(), $permission, new stdClass());
    }
}
